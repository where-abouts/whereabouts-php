<?php

namespace Whereabouts\Exception;

use Whereabouts\Exception;

class NoResult extends Exception
{

    /**
     */
    public function __construct()
    {
        parent::__construct(
            "The given query yielded no results."
        );
    }
}