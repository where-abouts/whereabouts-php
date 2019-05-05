<?php

namespace Whereabouts\Model;

use JsonSerializable;

class Address implements JsonSerializable
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $country;

    /**
     * @var null|string
     */
    private $region;

    /**
     * @var null|string
     */
    private $locality;

    /**
     * @var null|string
     */
    private $postalCode;

    /**
     * @var null|string
     */
    private $streetName;

    /**
     * @var int
     */
    private $houseNumber;

    /**
     * @var null|string
     */
    private $houseNumberAddition;

    /**
     * @var null|GeoPoint
     */
    private $geo;

    /**
     * @var null|AddressMetaData
     */
    private $meta;

    /**
     * @param string               $id
     * @param string               $country
     * @param null|string          $region
     * @param null|string          $locality
     * @param null|string          $postalCode
     * @param null|string          $streetName
     * @param int                  $houseNumber
     * @param null|string          $houseNumberAddition
     * @param null|GeoPoint        $geo
     * @param null|AddressMetaData $meta
     */
    public function __construct(
        $id,
        $country,
        $region,
        $locality,
        $postalCode,
        $streetName,
        $houseNumber,
        $houseNumberAddition,
        GeoPoint $geo,
        AddressMetaData $meta
    ) {
        $this->id                  = $id;
        $this->country             = $country;
        $this->region              = $region;
        $this->locality            = $locality;
        $this->postalCode          = $postalCode;
        $this->streetName          = $streetName;
        $this->houseNumber         = $houseNumber;
        $this->houseNumberAddition = $houseNumberAddition;
        $this->geo                 = $geo;
        $this->meta                = $meta;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return null|string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return null|string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * @return null|string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return null|string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * @return int
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @return null|string
     */
    public function getHouseNumberAddition()
    {
        return $this->houseNumberAddition;
    }

    /**
     * @return null|GeoPoint
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @return null|AddressMetaData
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'                  => $this->id,
            'country'             => $this->country,
            'region'              => $this->region,
            'locality'            => $this->locality,
            'postalCode'          => $this->postalCode,
            'streetName'          => $this->streetName,
            'houseNumber'         => $this->houseNumber,
            'houseNumberAddition' => $this->houseNumberAddition,
            'geo'                 => $this->geo,
            'meta'                => $this->meta,
        ];
    }
}