<?php

namespace Acme\Framework\exceptions;

class EmptyListException extends \Exception
{
    protected $message = "Pokemon list is empty. Please add some pokemon."; 
}