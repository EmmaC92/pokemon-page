<?php

declare(strict_types=1);

use Acme\Framework\TemplateEngine;
use Acme\App\Config\Paths;
use Acme\Framework\utils\Randomizer;
use Acme\App\Services\ValidationService;

return [
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
    Randomizer::class => fn() => new Randomizer(),
    ValidationService::class => fn () => new ValidationService()
];