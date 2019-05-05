<?php

namespace Whereabouts\Model;

use JsonSerializable;

class GeoPoint implements JsonSerializable
{

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct($latitude, $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type'        => 'Point',
            'coordinates' => [
                $this->longitude,
                $this->latitude,
            ],
        ];
    }
}