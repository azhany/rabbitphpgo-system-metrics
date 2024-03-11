<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\AMQP091\Framing\Method;

use ButterAMQP\AMQP091\Framing\Frame;

/**
 * @codeCoverageIgnore
 */
class ConfirmSelectOk extends Frame
{
    /**
     * @return string
     */
    public function encode()
    {
        return "\x01".pack('n', $this->channel)."\x00\x00\x00\x04\x00\x55\x00\x0B\xCE";
    }
}
