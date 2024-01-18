<?php

declare(strict_types=1);

use Acme\Framework\TemplateEngine;
use Acme\App\Config\Paths;
use Acme\Framework\utils\Randomizer;
use Acme\App\Services\ValidationService;
use Acme\Framework\Database;

return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    Randomizer::class => fn () => new Randomizer(),
    ValidationService::class => fn () => new ValidationService(),
    Database::class => fn () => new Database(
        $_ENV['DB_DRIVER'],
        [
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT']
        ],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    )
];
