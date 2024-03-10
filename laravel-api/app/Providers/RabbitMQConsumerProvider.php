<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQConsumerProvider extends ServiceProvider
{
    public function boot()
    {
        $host = config('rabbitmq.host');
        $port = config('rabbitmq.port');
        $username = config('rabbitmq.username');
        $password = config('rabbitmq.password');

        $connection = new AMQPStreamConnection($host, $port, $username, $password);
        $channel = $connection->channel();

        $channel->queue_declare('system_metrics', false, false, false, false);

        echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

        $callback = function ($msg) {
            $jsonData = $msg->body;
            $systemMetrics = json_decode($jsonData, true);

            if ($systemMetrics !== null) {
                echo " [x] Received System Metrics:\n";
                echo "     CPU Usage: " . $systemMetrics['cpu_usage'] . " cores\n";
                echo "     RAM Usage: " . $systemMetrics['ram_usage'] . " bytes\n";
                echo "     Disk Space: " . $systemMetrics['disk_space'] . "\n";
                echo "     Network Stats:\n" . $systemMetrics['network_stats'] . "\n";
            } else {
                echo " [x] Received Invalid JSON Data\n";
            }
        };

        $channel->basic_consume('system_metrics', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
