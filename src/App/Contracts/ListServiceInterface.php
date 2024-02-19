<?php

declare(strict_types=1);

namespace Acme\App\Contracts;

interface ListServiceInterface
{
    public function addPokemonToList(array $ids): array;

    public function checkPokemonIds(array $params = null): mixed;

    public function getPokemonList(): array;
}
