<?php

namespace Whereabouts\Exception;

use Whereabouts\Exception;

class InvalidFormat extends Exception
{

    /**
     */
    public function __construct()
    {
        parent::__construct(
            "The given query is badly formatted."
        );
    }
}