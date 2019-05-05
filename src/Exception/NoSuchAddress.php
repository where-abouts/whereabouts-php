<?php

namespace Whereabouts\Exception;

use Whereabouts\Exception;

class NoSuchAddress extends Exception
{

    /**
     * @var string
     */
    private $addressId;

    /**
     * @param string $addressId
     */
    public function __construct($addressId)
    {
        parent::__construct(
            sprintf(
                "Address with id %s does not exist.",
                $addressId
            )
        );

        $this->addressId = $addressId;
    }

    /**
     * @return string
     */
    public function getAddressId()
    {
        return $this->addressId;
    }
}