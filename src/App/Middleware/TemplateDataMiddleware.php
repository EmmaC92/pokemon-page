<?php

declare(strict_types=1);

namespace Acme\App\Middleware;

use Acme\Framework\Contracts\MiddlewareInterface;
use Acme\Framework\TemplateEngine;

class  TemplateDataMiddleware implements MiddlewareInterface
{

    public function __construct(private TemplateEngine $views)
    {
    }

    public function process(callable $next)
    {
        $this->views->addGlobal('title', 'Pokemon App');
        $next();
    }
}
