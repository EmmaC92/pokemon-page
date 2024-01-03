<?php

namespace Acme\Framework\models\pokemon;

use Acme\Framework\utils\Randomizer;

class PokemonIterable implements \Iterator
{
    private array $evolutionChain;

    private int $count = 0;

    private $randomizer;

    public function __construct(
        private int $pokemonId
    ) {
        $this->randomizer = new Randomizer();
        $this->setEvolutionChain();
    }

    private function setEvolutionChain(): void
    {
        $url = $this->randomizer->getPokemonSpecies($this->pokemonId)?->evolution_chain->url;
        $id = explode('/', $url)[6];
        $evolutionChain = (array) $this->randomizer->getPokemonEvolutionChain($id)->chain;
        $this->getSpeciesFromEvolutionChain($evolutionChain);
    }

    private function getSpeciesFromEvolutionChain(array $evolutionChainFromApi): void
    {
        $newId = explode('/', $evolutionChainFromApi['species']->url)[6];
        if ($newId < 381) {
            $this->evolutionChain[] = $newId;
            if (count($evolutionChainFromApi['evolves_to']) > 0) {
                $this->getSpeciesFromEvolutionChain((array)$evolutionChainFromApi['evolves_to'][0]);
            }
        }
    }

    public function current(): NormalPokemon
    {
        $pokemonId = $this->evolutionChain[$this->count];
        return $this->randomizer->getPokemon($pokemonId);
    }

    public function key(): string
    {
        $id = $this->evolutionChain[$this->count];
        return "#{$id}";
    }

    public function next(): void
    {
        $this->count++;
    }

    public function rewind(): void
    {
        $this->count = 0;
    }

    public function valid(): bool
    {
        return isset($this->evolutionChain[$this->count]);
    }
}
