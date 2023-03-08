<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = "Forbidden Page";
    protected $code = 403;
}