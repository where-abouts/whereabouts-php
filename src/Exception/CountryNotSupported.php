<?php

namespace Whereabouts\Exception;

use Whereabouts\Exception;

class CountryNotSupported extends Exception
{

    /**
     */
    public function __construct()
    {
        parent::__construct(
            "The provided country code is not supported at the moment. Check back in the future."
        );
    }
}