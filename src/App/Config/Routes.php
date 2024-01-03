<?php

declare(strict_types=1);

namespace Acme\App\Config;

use Acme\App\Controllers\{
    HomeController,
    GenerationController,
    ListController,
    MatchController,
    FamilyController
};
use Acme\Framework\App;

class Routes
{
    public static function registerRoutes(App $app): void
    {
        $app->get('/', [HomeController::class, 'home']);
        $app->get('/generation', [GenerationController::class, 'getPokemonByGeneration']);
        $app->get('/check-list', [ListController::class, 'getPokemonList']);
        $app->get('/add-pokemon-list', [ListController::class, 'addPokemonToList']);
        $app->get('/match', [MatchController::class, 'match']);
        $app->get('/family', [FamilyController::class, 'family']);
    }
}
