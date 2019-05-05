<?php

namespace Whereabouts\Mapper;

use Whereabouts\Model;

class GeoPoint
{

    /**
     * @param array $json
     *
     * @return Model\GeoPoint
     */
    public static function fromJson(array $json)
    {
        return new Model\GeoPoint(
            (float)$json['coordinates'][1],
            (float)$json['coordinates'][0]
        );
    }
}