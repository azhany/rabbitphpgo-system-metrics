<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\AMQP091\Framing\Method;

use ButterAMQP\AMQP091\Framing\Frame;
use ButterAMQP\Value;

/**
 * Indicate no messages available.
 *
 * @codeCoverageIgnore
 */
class BasicGetEmpty extends Frame
{
    /**
     * @var string
     */
    private $reserved1;

    /**
     * @param int    $channel
     * @param string $reserved1
     */
    public function __construct($channel, $reserved1)
    {
        $this->reserved1 = $reserved1;

        parent::__construct($channel);
    }

    /**
     * Reserved1.
     *
     * @return string
     */
    public function getReserved1()
    {
        return $this->reserved1;
    }

    /**
     * @return string
     */
    public function encode()
    {
        $data = "\x00\x3C\x00\x48".
            Value\ShortStringValue::encode($this->reserved1);

        return "\x01".pack('nN', $this->channel, strlen($data)).$data."\xCE";
    }
}
