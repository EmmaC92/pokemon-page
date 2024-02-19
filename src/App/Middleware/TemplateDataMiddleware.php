<?php

declare(strict_types=1);

namespace Acme\App\Middleware;

use Acme\Framework\Contracts\MiddlewareInterface;
use Acme\Framework\Contracts\TemplateEngineInterface;

class  TemplateDataMiddleware implements MiddlewareInterface
{

    public function __construct(
        private TemplateEngineInterface $views
    ) {
    }

    public function process(callable $next)
    {
        $this->views->addParam('title', 'Pokemon App');
        $next();
    }
}
