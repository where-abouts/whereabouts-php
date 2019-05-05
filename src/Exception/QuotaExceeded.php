<?php

namespace Whereabouts\Exception;

use Whereabouts\Exception;

class QuotaExceeded extends Exception
{

    /**
     */
    public function __construct()
    {
        parent::__construct(
            "You have exceeded your request quota. Go to https://dashboard.whereabouts.blue and review your payment settings."
        );
    }
}