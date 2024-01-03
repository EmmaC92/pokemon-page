<?php

namespace Acme\Framework\exceptions;

class InvalidPokemonIdException extends \InvalidArgumentException
{
    protected $message = "Pokemon id range is not valid, should be between 1 and 381.";
}