<?php

declare(strict_types=1);

// utils and framework
use Acme\Framework\utils\Randomizer;
use Acme\Framework\utils\TrainingPokemonGenerator;
use Acme\App\Config\Paths;
use Acme\Framework\{
    TemplateEngine,
    Container,
    Database,
};

use Acme\Framework\Contracts\{
    TemplateEngineInterface,
    TrainingPokemonGeneratorInterface
};

// services
use Acme\App\Services\{
    ValidationService,
    MatchService,
    PokemonService,
    ListService
};
use Acme\App\Contracts\{
    ListServiceInterface,
    PokemonGeneratorInterface,
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
    TemplateEngineInterface::class => fn () => new TemplateEngine(Paths::VIEW),
    PokemonGeneratorInterface::class => fn () => new Randomizer(),
    TrainingPokemonGeneratorInterface::class => fn () => new TrainingPokemonGenerator(),
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

        $matchRepository          = $container->get(MatchRepository::class);
        $trainingPokemonGenerator = $container->get(TrainingPokemonGeneratorInterface::class);
        $pokemonService           = $container->get(PokemonService::class);

        return new MatchService(
            matchRepository: $matchRepository,
            pokemonService: $pokemonService,
            trainingPokemonGenerator: $trainingPokemonGenerator
        );
    },
    PokemonService::class => function (Container $container) {
        $pokemonRepository = $container->get(PokemonRepository::class);

        return new PokemonService($pokemonRepository);
    },
    ListServiceInterface::class => function (Container $container) {
        $pokemonGenerator = $container->get(PokemonGeneratorInterface::class);

        return new ListService($pokemonGenerator);
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