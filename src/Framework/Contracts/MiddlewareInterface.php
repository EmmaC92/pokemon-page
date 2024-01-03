<?php

declare(strict_types=1);

namespace Acme\Framework\Contracts;

interface MiddlewareInterface
{
    public function process(callable $next);
}