<?php

declare(strict_types=1);

namespace Acme\App\Config;

use Acme\Framework\App;
use Acme\App\Middleware\{
    TemplateDataMiddleware,
    ValidationExceptionMiddleware
};

function registerMiddleware(App $app)
{
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(ValidationExceptionMiddleware::class);
}