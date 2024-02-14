<?php

declare(strict_types=1);

// utils and framework
use Acme\Framework\utils\Randomizer;
use Acme\App\Config\Paths;
use Acme\Framework\{
    TemplateEngine,
    Container,
    Database
};

// services
use Acme\App\Services\{
    ValidationService,
    MatchService,
    PokemonService,
    ListService
};

// repositories
use Acme\App\Repository\{
    MatchRepository,
    PokemonRepository,
};

/**
 * Utils and Fremework instances
 */
$utils = [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::VIEW),
    Randomizer::class => fn () => new Randomizer(),
    Database::class => fn () => new Database(
        $_ENV['DB_DRIVER'],
        [
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT']
        ],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    ),
];

/**
 * Services instances
 */
$services = [
    ValidationService::class => fn () => new ValidationService(),
    MatchService::class => function (Container $container) {
        $matchRepository = $container->get(MatchRepository::class);
        $randomizer = $container->get(Randomizer::class);
        $pokemonService = $container->get(PokemonService::class);

        return new MatchService($matchRepository, $randomizer, $pokemonService);
    },
    PokemonService::class => function (Container $container) {
        $pokemonRepository = $container->get(PokemonRepository::class);

        return new PokemonService($pokemonRepository);
    },
    ListService::class => function (Container $container) {
        $randomizer = $container->get(Randomizer::class);

        return new ListService($randomizer);
    },
];

/**
 * Repositories instances
 */
$repositories = [
    MatchRepository::class => function (Container $container) {
        $db = $container->get(Database::class);

        return new MatchRepository($db);
    },
    PokemonRepository::class => function (Container $container) {
        $db = $container->get(Database::class);

        return new PokemonRepository($db);
    },
];

$instances = array_merge(
    $utils,
    $services,
    $repositories,
);

return $instances;