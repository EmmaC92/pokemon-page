<?php

declare(strict_types=1);

namespace Acme\Framework\Contracts;

use Acme\Framework\interfaces\TraineePokemonInterface;

interface TrainingPokemonGeneratorInterface
{
    public function getPokemon(string|int $slug = null, int $generation = null): TraineePokemonInterface;
}
