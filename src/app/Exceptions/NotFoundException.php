<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = "News Not Found";
    protected $code = 404;
}