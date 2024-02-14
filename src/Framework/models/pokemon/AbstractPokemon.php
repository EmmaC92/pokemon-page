<?php

namespace Acme\Framework\models\pokemon;

abstract class AbstractPokemon
{
    public function __construct(
        protected string $name,
        protected string $image,
        protected int $pokedexIndex,
        protected ?int $id = null,
    ) {
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): abstractPokemon
    {
        $this->name = $name;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): abstractPokemon
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id): abstractPokemon
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of pokedexIndex
     */
    public function getPokedexIndex()
    {
        return $this->pokedexIndex;
    }

    /**
     * Set the value of pokedexIndex
     *
     * @return  self
     */
    public function setPokedexIndex($pokedexIndex)
    {
        $this->pokedexIndex = $pokedexIndex;

        return $this;
    }
}
