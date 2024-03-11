<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\Exception;

/**
 * @codeCoverageIgnore
 */
class AMQPException extends \Exception
{
    public static function make($message, $code)
    {
        if ($code === 311) {
            return new AMQP\ContentTooLargeException($message, $code);
        } elseif ($code === 313) {
            return new AMQP\NoConsumersException($message, $code);
        } elseif ($code === 320) {
            return new AMQP\ConnectionForcedException($message, $code);
        } elseif ($code === 402) {
            return new AMQP\InvalidPathException($message, $code);
        } elseif ($code === 403) {
            return new AMQP\AccessRefusedException($message, $code);
        } elseif ($code === 404) {
            return new AMQP\NotFoundException($message, $code);
        } elseif ($code === 405) {
            return new AMQP\ResourceLockedException($message, $code);
        } elseif ($code === 406) {
            return new AMQP\PreconditionFailedException($message, $code);
        } elseif ($code === 501) {
            return new AMQP\FrameErrorException($message, $code);
        } elseif ($code === 502) {
            return new AMQP\SyntaxErrorException($message, $code);
        } elseif ($code === 503) {
            return new AMQP\CommandInvalidException($message, $code);
        } elseif ($code === 504) {
            return new AMQP\ChannelErrorException($message, $code);
        } elseif ($code === 505) {
            return new AMQP\UnexpectedFrameException($message, $code);
        } elseif ($code === 506) {
            return new AMQP\ResourceErrorException($message, $code);
        } elseif ($code === 530) {
            return new AMQP\NotAllowedException($message, $code);
        } elseif ($code === 540) {
            return new AMQP\NotImplementedException($message, $code);
        } elseif ($code === 541) {
            return new AMQP\InternalErrorException($message, $code);
        } else {
            return new self($message, $code);
        }
    }
}