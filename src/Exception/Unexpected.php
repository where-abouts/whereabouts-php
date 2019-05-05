<?php

namespace Whereabouts\Exception;

use Throwable;
use Whereabouts\Exception;

class Unexpected extends Exception
{

    /**
     * @param Throwable $throwable
     *
     * @return Unexpected
     */
    public static function fromPrevious(Throwable $throwable)
    {
        return new static(
            "Unexpected error occurred.",
            0,
            $throwable
        );
    }

    /**
     * @return Unexpected
     */
    public static function fromLastJsonError()
    {
        return new static(
            sprintf(
                "Could not decode JSON from API: %s (%d)",
                json_last_error_msg(),
                json_last_error()
            )
        );
    }
}