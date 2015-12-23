<?php

namespace Checkin\Exceptions;

use Exception;

class UnauthenticatedException extends Exception {
	public function __construct($message, $code = 0, Exception $previous = null) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }
}
