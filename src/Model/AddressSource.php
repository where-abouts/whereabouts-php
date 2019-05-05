<?php

namespace Whereabouts\Model;

use JsonSerializable;

class AddressSource implements JsonSerializable
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var null|string
     */
    private $externalRef;

    /**
     * @param string      $type
     * @param null|string $externalRef
     */
    public function __construct($type, $externalRef)
    {
        $this->type        = $type;
        $this->externalRef = $externalRef;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getExternalRef()
    {
        return $this->externalRef;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type'        => $this->type,
            'externalRef' => $this->externalRef
        ];
    }
}