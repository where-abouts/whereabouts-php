<?php

namespace Whereabouts\Exception;

use Whereabouts\Exception;

class InvalidApiKey extends Exception
{

    /**
     */
    public function __construct()
    {
        parent::__construct(
            "Invalid, disabled or empty API key provided. Check https://dashboard.whereabouts.blue"
        );
    }
}