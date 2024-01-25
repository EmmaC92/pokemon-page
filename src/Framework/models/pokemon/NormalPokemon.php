<?php

namespace Acme\Framework\models\pokemon;

use Acme\Framework\models\pokemon\AbstractPokemon;

class NormalPokemon extends AbstractPokemon
{
    public function __construct(
        string $name,
        string $image,
        int $pokedexIndex,
        protected array $stats,
        protected array $types,
        protected array $attacks,
        protected ?int $id = null,
    ) {
        parent::__construct(
            id: $id,
            name: $name,
            image: $image,
            pokedexIndex: $pokedexIndex
        );
    }

    /**
     * Get stats of pokemon
     *
     * @return  array
     */
    public function getStats(string $name = null): array|int
    {
        return $name ? $this->stats[$name] : $this->stats;
    }

    /**
     * Set stats of pokemon
     *
     * @param  array  $stats  Stats of pokemon
     *
     * @return  self
     */
    public function setStats(array $stats)
    {
        $this->stats = $stats;

        return $this;
    }

    /**
     * Get the value of types
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Set the value of types
     *
     * @return  self
     */
    public function setTypes($types)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * Get the value of attacks
     */
    public function getAttacks(bool $someAttack = false): array|string
    {
        if ($someAttack) {
            return $this->attacks[rand(0,  count($this->attacks) - 1)];
        }
        return $this->attacks;
    }

    /**
     * Set the value of attacks
     *
     * @return  self
     */
    public function setAttacks($attacks)
    {
        $this->attacks = $attacks;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
