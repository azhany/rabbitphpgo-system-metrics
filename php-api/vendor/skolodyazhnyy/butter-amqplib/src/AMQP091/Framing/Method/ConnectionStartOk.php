<?php
/*
 * This file is automatically generated.
 */

namespace ButterAMQP\AMQP091\Framing\Method;

use ButterAMQP\AMQP091\Framing\Frame;
use ButterAMQP\Value;

/**
 * Select security mechanism and locale.
 *
 * @codeCoverageIgnore
 */
class ConnectionStartOk extends Frame
{
    /**
     * @var array
     */
    private $clientProperties = [];

    /**
     * @var string
     */
    private $mechanism;

    /**
     * @var string
     */
    private $response;

    /**
     * @var string
     */
    private $locale;

    /**
     * @param int    $channel
     * @param array  $clientProperties
     * @param string $mechanism
     * @param string $response
     * @param string $locale
     */
    public function __construct($channel, $clientProperties, $mechanism, $response, $locale)
    {
        $this->clientProperties = $clientProperties;
        $this->mechanism = $mechanism;
        $this->response = $response;
        $this->locale = $locale;

        parent::__construct($channel);
    }

    /**
     * Client properties.
     *
     * @return array
     */
    public function getClientProperties()
    {
        return $this->clientProperties;
    }

    /**
     * Selected security mechanism.
     *
     * @return string
     */
    public function getMechanism()
    {
        return $this->mechanism;
    }

    /**
     * Security response data.
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Selected message locale.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function encode()
    {
        $data = "\x00\x0A\x00\x0B".
            Value\TableValue::encode($this->clientProperties).
            Value\ShortStringValue::encode($this->mechanism).
            Value\LongStringValue::encode($this->response).
            Value\ShortStringValue::encode($this->locale);

        return "\x01".pack('nN', $this->channel, strlen($data)).$data."\xCE";
    }
}