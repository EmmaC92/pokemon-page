<?php

declare(strict_types=1);

namespace Acme\Framework\utils;

use Acme\Framework\Contracts\TrainingPokemonGeneratorInterface;
use Acme\Framework\interfaces\TraineePokemonInterface;
use Acme\Framework\utils\Randomizer;
use Acme\Framework\models\pokemon\TrainingPokemon;

class TrainingPokemonGenerator extends Randomizer implements TrainingPokemonGeneratorInterface
{
    public function getTrainingPokemon(string|int $slug = null, int $generation = null): TraineePokemonInterface
    {
        $arrayParameters = parent::getPokemonParameters($slug, $generation);

        extract($arrayParameters);

        return new TrainingPokemon(
            name: $name,
            image: $imageUrl,
            pokedexIndex: $id,
            stats: $stats,
            types: $types,
            attacks: $attacks
        );
    }
}
