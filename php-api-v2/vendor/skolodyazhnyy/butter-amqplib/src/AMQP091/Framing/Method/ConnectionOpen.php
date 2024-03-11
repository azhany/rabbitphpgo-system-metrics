<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\AMQP091\Framing\Method;

use ButterAMQP\AMQP091\Framing\Frame;
use ButterAMQP\Value;

/**
 * Open connection to virtual host.
 *
 * @codeCoverageIgnore
 */
class ConnectionOpen extends Frame
{
    /**
     * @var string
     */
    private $virtualHost;

    /**
     * @var string
     */
    private $reserved1;

    /**
     * @var bool
     */
    private $reserved2;

    /**
     * @param int    $channel
     * @param string $virtualHost
     * @param string $reserved1
     * @param bool   $reserved2
     */
    public function __construct($channel, $virtualHost, $reserved1, $reserved2)
    {
        $this->virtualHost = $virtualHost;
        $this->reserved1 = $reserved1;
        $this->reserved2 = $reserved2;

        parent::__construct($channel);
    }

    /**
     * Virtual host name.
     *
     * @return string
     */
    public function getVirtualHost()
    {
        return $this->virtualHost;
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
     * Reserved2.
     *
     * @return bool
     */
    public function isReserved2()
    {
        return $this->reserved2;
    }

    /**
     * @return string
     */
    public function encode()
    {
        $data = "\x00\x0A\x00\x28".
            Value\ShortStringValue::encode($this->virtualHost).
            Value\ShortStringValue::encode($this->reserved1).
            Value\BooleanValue::encode($this->reserved2);

        return "\x01".pack('nN', $this->channel, strlen($data)).$data."\xCE";
    }
}