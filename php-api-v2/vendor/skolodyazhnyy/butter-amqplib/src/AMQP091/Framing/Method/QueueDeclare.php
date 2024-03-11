<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\AMQP091\Framing\Method;

use ButterAMQP\AMQP091\Framing\Frame;
use ButterAMQP\Value;

/**
 * Declare queue, create if needed.
 *
 * @codeCoverageIgnore
 */
class QueueDeclare extends Frame
{
    /**
     * @var int
     */
    private $reserved1;

    /**
     * @var string
     */
    private $queue;

    /**
     * @var bool
     */
    private $passive;

    /**
     * @var bool
     */
    private $durable;

    /**
     * @var bool
     */
    private $exclusive;

    /**
     * @var bool
     */
    private $autoDelete;

    /**
     * @var bool
     */
    private $noWait;

    /**
     * @var array
     */
    private $arguments = [];

    /**
     * @param int    $channel
     * @param int    $reserved1
     * @param string $queue
     * @param bool   $passive
     * @param bool   $durable
     * @param bool   $exclusive
     * @param bool   $autoDelete
     * @param bool   $noWait
     * @param array  $arguments
     */
    public function __construct($channel, $reserved1, $queue, $passive, $durable, $exclusive, $autoDelete, $noWait, $arguments)
    {
        $this->reserved1 = $reserved1;
        $this->queue = $queue;
        $this->passive = $passive;
        $this->durable = $durable;
        $this->exclusive = $exclusive;
        $this->autoDelete = $autoDelete;
        $this->noWait = $noWait;
        $this->arguments = $arguments;

        parent::__construct($channel);
    }

    /**
     * Reserved1.
     *
     * @return int
     */
    public function getReserved1()
    {
        return $this->reserved1;
    }

    /**
     * Queue.
     *
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Do not create queue.
     *
     * @return bool
     */
    public function isPassive()
    {
        return $this->passive;
    }

    /**
     * Request a durable queue.
     *
     * @return bool
     */
    public function isDurable()
    {
        return $this->durable;
    }

    /**
     * Request an exclusive queue.
     *
     * @return bool
     */
    public function isExclusive()
    {
        return $this->exclusive;
    }

    /**
     * Auto-delete queue when unused.
     *
     * @return bool
     */
    public function isAutoDelete()
    {
        return $this->autoDelete;
    }

    /**
     * NoWait.
     *
     * @return bool
     */
    public function isNoWait()
    {
        return $this->noWait;
    }

    /**
     * Arguments for declaration.
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    public function encode()
    {
        $data = "\x00\x32\x00\x0A".
            Value\ShortValue::encode($this->reserved1).
            Value\ShortStringValue::encode($this->queue).
            Value\OctetValue::encode(($this->passive ? 1 : 0) | (($this->durable ? 1 : 0) << 1) | (($this->exclusive ? 1 : 0) << 2) | (($this->autoDelete ? 1 : 0) << 3) | (($this->noWait ? 1 : 0) << 4)).
            Value\TableValue::encode($this->arguments);

        return "\x01".pack('nN', $this->channel, strlen($data)).$data."\xCE";
    }
}
