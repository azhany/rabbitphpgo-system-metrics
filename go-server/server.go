package main

import (
    "encoding/json"
    "io/ioutil"
    "fmt"
    "log"
    "os/exec"
    "runtime"
    "syscall"

    "github.com/shirou/gopsutil/net"
    "github.com/streadway/amqp"
)

type SystemMetrics struct {
    CPUUsage     int    `json:"cpu_usage"`
    RAMUsage     uint64 `json:"ram_usage"`
    DiskSpace    string `json:"disk_space"`
    NetworkStats string `json:"network_stats"`
}

type RabbitMQConfig struct {
    Host     string `json:"host"`
    Port     int    `json:"port"`
    Username string `json:"username"`
    Password string `json:"password"`
}

func check(err error) {
    if err != nil {
        log.Fatal(err)
    }
}

func main() {
    // Read RabbitMQ configuration
    configData, err := ioutil.ReadFile("../rabbit-config/rabbitmq_config.json")
    check(err)

    var rabbitmqConfig RabbitMQConfig
    err = json.Unmarshal(configData, &rabbitmqConfig)
    check(err)

    // Fetch CPU usage
    cpuUsage := runtime.NumCPU()

    // Fetch RAM usage
    var memInfo syscall.Sysinfo_t
    err := syscall.Sysinfo(&memInfo)
    check(err)
    ramUsage := memInfo.Totalram - memInfo.Freeram

    // Fetch disk space
    diskSpaceCmd := exec.Command("df", "-h")
    diskSpaceOutput, err := diskSpaceCmd.Output()
    check(err)

    // Fetch network statistics
    netStats, err := net.IOCounters(false)
    check(err)
    var networkStats string
    for _, ns := range netStats {
        networkStats += fmt.Sprintf("Interface: %s\n  Bytes Sent: %d\n  Bytes Received: %d\n", ns.Name, ns.BytesSent, ns.BytesRecv)
    }

    // Create system metrics object
    metrics := SystemMetrics{
        CPUUsage:     cpuUsage,
        RAMUsage:     ramUsage,
        DiskSpace:    string(diskSpaceOutput),
        NetworkStats: networkStats,
    }

    // Convert metrics to JSON
    jsonData, err := json.Marshal(metrics)
    check(err)

    // RabbitMQ connection
    // conn, err := amqp.Dial("amqp://guest:guest@localhost:5672/")
    conn, err := amqp.Dial(fmt.Sprintf("amqp://%s:%s@%s:%d/", rabbitmqConfig.Username, rabbitmqConfig.Password, rabbitmqConfig.Host, rabbitmqConfig.Port))
    check(err)
    defer conn.Close()

    ch, err := conn.Channel()
    check(err)
    defer ch.Close()

    // Declare a queue
    q, err := ch.QueueDeclare(
        "system_metrics", // Queue name
        false,           // Durable
        false,           // Delete when unused
        false,           // Exclusive
        false,           // No-wait
        nil,             // Arguments
    )
    check(err)

    // Publish message to RabbitMQ queue
    err = ch.Publish(
        "",     // Exchange
        q.Name, // Routing key
        false,  // Mandatory
        false,  // Immediate
        /* amqp.Publishing{
            ContentType: "text/plain",
            Body:        []byte(fmt.Sprintf("CPU Usage: %d cores\nRAM Usage: %d bytes\nDisk Space: %s\nNetwork Statistics:\n%s", cpuUsage, ramUsage, diskSpaceOutput, networkStats)),
        }) */
        amqp.Publishing{
            ContentType: "application/json",
            Body:        jsonData,
        })
    check(err)

    fmt.Println("System metrics sent to RabbitMQ")
}
