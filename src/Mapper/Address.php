<?php

namespace Whereabouts\Mapper;

use Whereabouts\Model;

class Address
{

    /**
     * @param array $json
     *
     * @return Model\Address
     */
    public static function fromJson(array $json)
    {
        $geo = null;
        if (!empty($json['geo'])) {
            $geo = GeoPoint::fromJson($json['geo']);
        }

        $metaData = null;
        if (!empty($json['meta'])) {
            $metaData = AddressMetaData::fromJson($json['meta']);
        }

        return new Model\Address(
            $json['id'],
            $json['country'],
            $json['region'],
            $json['locality'],
            $json['postalCode'],
            $json['streetName'],
            (int)$json['houseNumber'],
            $json['houseNumberAddition'],
            $geo,
            $metaData
        );
    }
}