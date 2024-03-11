<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\AMQP091\Framing\Method;

use ButterAMQP\AMQP091\Framing\Frame;
use ButterAMQP\Value;

/**
 * Start a queue consumer.
 *
 * @codeCoverageIgnore
 */
class BasicConsume extends Frame
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
     * @var string
     */
    private $consumerTag;

    /**
     * @var bool
     */
    private $noLocal;

    /**
     * @var bool
     */
    private $noAck;

    /**
     * @var bool
     */
    private $exclusive;

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
     * @param string $consumerTag
     * @param bool   $noLocal
     * @param bool   $noAck
     * @param bool   $exclusive
     * @param bool   $noWait
     * @param array  $arguments
     */
    public function __construct($channel, $reserved1, $queue, $consumerTag, $noLocal, $noAck, $exclusive, $noWait, $arguments)
    {
        $this->reserved1 = $reserved1;
        $this->queue = $queue;
        $this->consumerTag = $consumerTag;
        $this->noLocal = $noLocal;
        $this->noAck = $noAck;
        $this->exclusive = $exclusive;
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
     * ConsumerTag.
     *
     * @return string
     */
    public function getConsumerTag()
    {
        return $this->consumerTag;
    }

    /**
     * NoLocal.
     *
     * @return bool
     */
    public function isNoLocal()
    {
        return $this->noLocal;
    }

    /**
     * NoAck.
     *
     * @return bool
     */
    public function isNoAck()
    {
        return $this->noAck;
    }

    /**
     * Request exclusive access.
     *
     * @return bool
     */
    public function isExclusive()
    {
        return $this->exclusive;
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
        $data = "\x00\x3C\x00\x14".
            Value\ShortValue::encode($this->reserved1).
            Value\ShortStringValue::encode($this->queue).
            Value\ShortStringValue::encode($this->consumerTag).
            Value\OctetValue::encode(($this->noLocal ? 1 : 0) | (($this->noAck ? 1 : 0) << 1) | (($this->exclusive ? 1 : 0) << 2) | (($this->noWait ? 1 : 0) << 3)).
            Value\TableValue::encode($this->arguments);

        return "\x01".pack('nN', $this->channel, strlen($data)).$data."\xCE";
    }
}
