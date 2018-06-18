<?php

namespace app\Exceptions;

/**
 * Class RoutingException
 *
 * Exception class
 * Thrown when there is a routing related issue
 */
class RoutingException extends \Exception
{
    public function __construct($message) {
        parent::__construct($message);
    }
}