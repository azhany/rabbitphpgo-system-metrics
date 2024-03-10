<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQController extends Controller
{
    public function publishMessage()
    {
        // RabbitMQ connection parameters
        $host = config('rabbitmq.host');
        $port = config('rabbitmq.port');
        $username = config('rabbitmq.username');
        $password = config('rabbitmq.password');
        $queue = 'system_metrics';

        // Connect to RabbitMQ
        $connection = new AMQPStreamConnection($host, $port, $username, $password);
        $channel = $connection->channel();

        // Declare the queue
        $channel->queue_declare($queue, false, false, false, false);

        // Create a message
        $messageBody = json_encode(['cpu_usage' => 60, 'ram_usage' => 2048, 'disk_space' => '100GB', 'network_stats' => '']);

        $message = new AMQPMessage($messageBody);

        // Publish the message to the queue
        $channel->basic_publish($message, '', $queue);

        // Close the channel and connection
        $channel->close();
        $connection->close();

        return view('message-output', ['message' => "Message published to RabbitMQ queue '{$queue}'"]);
    }
}
