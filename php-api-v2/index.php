<?php

require_once __DIR__ . '/vendor/autoload.php';

use ButterAMQP\ConnectionBuilder;
use ButterAMQP\Delivery;

$connection = ConnectionBuilder::make()
    ->create("//test:test@192.168.0.11/%2f");

$channel = $connection->channel(1);

// Declare consumer
$consumer = $channel->consume('system_metrics', function(Delivery $delivery) {
    echo "Receive a message: " . $delivery->getBody() . PHP_EOL;
    
    // Acknowledge delivery
    $delivery->ack();
});

// Serve connection until consumer is cancelled
while($consumer->isActive()) {
    $connection->serve();
}

$connection->close();

?>