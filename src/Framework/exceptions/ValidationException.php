<?php

declare(strict_types=1);

namespace Acme\Framework\exceptions;

use RuntimeException;

class ValidationException extends RuntimeException
{

    public function __construct(public array $errors, int $code = 422)
    {
        parent::__construct(code: $code);
        $this->message = implode($errors);
    }
}
