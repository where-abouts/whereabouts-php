<?php

namespace Whereabouts\Mapper;

use DateTimeImmutable;
use Exception;
use RuntimeException;
use Whereabouts\Model;

class AddressMetaData
{

    /**
     * @param array $json
     *
     * @return Model\AddressMetaData
     */
    public static function fromJson(array $json)
    {
        try {
            $lastUpdatedAt = new DateTimeImmutable($json['lastUpdate']);
        } catch (Exception $e) {
            throw new RuntimeException("Invalid DateTime format");
        }

        $source = null;
        if (!empty($json['source'])) {
            $source = new Model\AddressSource(
                $json['source']['type'],
                $json['source']['externalRef']
            );
        }

        return new Model\AddressMetaData(
            $lastUpdatedAt,
            $source
        );
    }
}