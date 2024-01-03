<?php

namespace Acme\Framework\exceptions;

class FileNotFoundException extends \Exception
{
    protected $code = 404;

    protected $message = "Pokemon file doesn't exist, please add it.";
}