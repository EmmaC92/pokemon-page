<?php

declare(strict_types=1);

namespace Acme\App\Middleware;

use Acme\Framework\Contracts\MiddlewareInterface;
use Acme\Framework\exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        // we can perform some additional actions here.
        $next();
    }
}
