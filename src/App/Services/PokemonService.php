<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\App\Repository\PokemonRepository;
use Acme\Framework\models\pokemon\TrainingPokemon;

class PokemonService
{

    public function __construct(
        private PokemonRepository $pokemonRepository
    ) {
    }

    public function savePokemon(TrainingPokemon &$pokemon): TrainingPokemon
    {
        $params = [
            'name' => $pokemon->getName()
        ];
        $pokemonId = $this->pokemonRepository->insertPokemon($params);
        $pokemon->setId($pokemonId);

        return $pokemon;
    }
}
