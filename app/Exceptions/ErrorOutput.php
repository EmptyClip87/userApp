<?php

namespace app\Exceptions;

/**
 * Class ErrorOutput
 *
 * Outputs the error message.
 */
class ErrorOutput
{
    public static function say(\Exception $e) {
        echo $e->getMessage();
    }
}