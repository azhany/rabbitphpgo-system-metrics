<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\AMQP091\Framing\Method;

use ButterAMQP\AMQP091\Framing\Frame;
use ButterAMQP\Value;

/**
 * Redeliver unacknowledged messages.
 *
 * @codeCoverageIgnore
 */
class BasicRecoverAsync extends Frame
{
    /**
     * @var bool
     */
    private $requeue;

    /**
     * @param int  $channel
     * @param bool $requeue
     */
    public function __construct($channel, $requeue)
    {
        $this->requeue = $requeue;

        parent::__construct($channel);
    }

    /**
     * Requeue the message.
     *
     * @return bool
     */
    public function isRequeue()
    {
        return $this->requeue;
    }

    /**
     * @return string
     */
    public function encode()
    {
        $data = "\x00\x3C\x00\x64".
            Value\BooleanValue::encode($this->requeue);

        return "\x01".pack('nN', $this->channel, strlen($data)).$data."\xCE";
    }
}
