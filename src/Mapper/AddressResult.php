<?php

namespace Whereabouts\Mapper;

use Whereabouts\Model;

class AddressResult
{

    /**
     * @param array $json
     *
     * @return Model\AddressResult
     */
    public static function fromJson(array $json)
    {
        $addresses = array_map(
            function (array $address) {
                return Address::fromJson($address);
            },
            (array)$json['addresses']
        );

        return new Model\AddressResult(
            $addresses,
            (int)$json['pagination']['limit'],
            (int)$json['pagination']['offset'],
            (int)$json['pagination']['total']
        );
    }
}