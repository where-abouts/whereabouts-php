<?php

namespace Whereabouts\Model;

use DateTimeImmutable;
use JsonSerializable;

class AddressMetaData implements JsonSerializable
{

    /**
     * @var DateTimeImmutable
     */
    private $lastUpdatedAt;

    /**
     * @var null|AddressSource
     */
    private $source;

    /**
     * @param DateTimeImmutable  $lastUpdatedAt
     * @param null|AddressSource $source
     */
    public function __construct(DateTimeImmutable $lastUpdatedAt, AddressSource $source)
    {
        $this->lastUpdatedAt = $lastUpdatedAt;
        $this->source        = $source;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getLastUpdatedAt()
    {
        return $this->lastUpdatedAt;
    }

    /**
     * @return null|AddressSource
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'lastUpdate' => $this->lastUpdatedAt->format(DateTimeImmutable::ATOM),
            'source'     => $this->source,
        ];
    }
}