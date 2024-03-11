# Documentation: Sending System Metrics from Linux VM to PHP Application using RabbitMQ

## Overview

This documentation outlines the steps to send system metrics (including CPU usage, RAM usage, disk space, and network statistics) from a Linux Virtual Machine (VM) to a PHP application running on a Windows host using RabbitMQ messaging broker.

## Requirements

- VirtualBox installed on Windows host.
- Linux VM (e.g., Ubuntu, CentOS) running on VirtualBox.
- Go programming language installed on Linux VM.
- RabbitMQ messaging broker installed on Linux VM.
- PHP installed on Windows host.
- Composer installed on Windows host for PHP package management.

## Instructions

### Go Program (Linux VM)

1. Open a text editor on your Linux VM.
2. Copy and paste the provided Go code into the text editor.
3. Save the file with a `.go` extension (e.g., `send_system_metrics.go`).
4. Replace `"amqp://guest:guest@localhost:5672/"` with the appropriate RabbitMQ connection string.
5. Open a terminal on your Linux VM and navigate to the directory containing the Go file.
6. Compile the Go program using the following command:
   ```bash
   go build send_system_metrics.go
7. Run the compiled executable to send disk space information to RabbitMQ:
   ```bash
    ./send_system_metrics

### PHP Application (Windows Host):

1. Install Butter AMQP library using Composer:
   ```bash
    composer require skolodyazhnyy/butter-amqplib dev-master
2. Open a command prompt on your Windows host and navigate to the directory containing the PHP file (php-api-v2).
3. Run the PHP application using the following command:
    php index.php

### Note:

1. Ensure that RabbitMQ is properly configured and running on the Linux VM before executing the Go program and PHP application.
2. Modify the RabbitMQ connection string in the Go program and PHP application according to your RabbitMQ setup.
3. Make sure that the Linux VM and Windows host can communicate with each other over the network to establish a connection with RabbitMQ.