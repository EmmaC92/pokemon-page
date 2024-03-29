<?php

namespace Acme\Framework\utils;

use Acme\Framework\models\pokemon\{

    NormalPokemon,
};
use Acme\Framework\client\GuzzleHttpClient;
use Acme\Framework\exceptions\InvalidPokemonIdException;
use Acme\App\Contracts\PokemonGeneratorInterface;

class Randomizer implements PokemonGeneratorInterface
{
    /**
     * Http guzzle client
     * @var 
     */
    public $guzzleHttpClient;

    public function __construct()
    {
        $this->guzzleHttpClient = GuzzleHttpClient::getInstance();
    }

    public function getPokemons(int|string|array ...$pokemonIds): array
    {
        $pokemonIds = is_array($pokemonIds[0]) ? $pokemonIds[0] : $pokemonIds;
        $pokemons = [];
        foreach ($pokemonIds as $pokemonId) {
            $pokemons[] = $this->getPokemon($pokemonId);
        }
        return $pokemons;
    }

    public function getPokemon(string|int $slug = null, int $generation = null): NormalPokemon
    {
        $arrayParameters = $this->getPokemonParameters($slug, $generation);

        extract($arrayParameters);

        return new NormalPokemon(
            name: $name,
            image: $imageUrl,
            pokedexIndex: $id,
            stats: $stats,
            types: $types,
            attacks: $attacks
        );
    }

    protected function getPokemonParameters(string|int $slug = null, int $generation = null): array
    {
        $this->checkRangeId($slug);

        if (!is_null($generation)) {
            $slug = match ($generation) {
                self::FIRST_GENERATION => $this->getRandomFirstGenerationPokemonId(),
                self::SECOND_GENERATION => $this->getRandomSecondGenerationPokemonId(),
                self::THIRD_GENERATION => $this->getRandomThirdGenerationPokemonId(),
                default => $this->getRandomPokemonId(),
            };
        } elseif ($slug === null) {
            $slug = $this->randomPokemonId();
        }

        $pokemonDetails = $this->getPokemonDetails($slug);

        $this->checkRangeId($pokemonDetails?->id);

        return [
            'name' => $pokemonDetails?->species->name,
            'imageUrl' => $pokemonDetails?->sprites->other->dream_world->front_default,
            'id' => $pokemonDetails?->id,
            'stats' => $this->getStats($pokemonDetails),
            'types' => $this->getTypes($pokemonDetails),
            'attacks' => $this->getAttacks($pokemonDetails)
        ];
    }

    private function checkRangeId($id)
    {
        if ($id === '' || (is_numeric($id) && ($id < self::POKEMON_ID_RANGE['first_id'] || $id > self::POKEMON_ID_RANGE['last_id']))) {
            throw new InvalidPokemonIdException;
        }
    }

    private function getStats(Object $pokemonDetails): array
    {
        $statsArray = [];
        array_map(function ($statObject) use (&$statsArray) {
            return $statsArray[$statObject->stat->name] =  $statObject->base_stat;
        }, $pokemonDetails?->stats);

        return $statsArray;
    }

    private function getTypes(Object $pokemonDetails): array
    {
        return array_map(function ($typeObject) {
            return $typeObject->type->name;
        }, $pokemonDetails?->types);
    }

    private function getAttacks(Object $pokemonDetails): array
    {
        $attacks = (array) $pokemonDetails?->moves;
        $availableAttacks = count($attacks) - 1;
        $attacksArray = [];
        while (count($attacksArray) < 4) {
            $randomAttack = rand(0, $availableAttacks);
            $newAttack = $attacks[$randomAttack]->move->name;
            if (in_array($newAttack, $attacksArray))
                continue;
            $attacksArray[] = $attacks[$randomAttack]->move->name;
        }

        return $attacksArray;
    }

    private function randomPokemonId(): int
    {
        $generation = rand(1, 4);
        return $this->getRandomPokemonIdByGeneration($generation);
    }

    private function getRandomPokemonIdByGeneration(int $generation): int
    {
        return match ($generation) {
            self::FIRST_GENERATION => $this->getRandomFirstGenerationPokemonId(),
            self::SECOND_GENERATION => $this->getRandomSecondGenerationPokemonId(),
            self::THIRD_GENERATION => $this->getRandomThirdGenerationPokemonId(),
            default => $this->getRandomPokemonId(),
        };
    }

    private function getRandomFirstGenerationPokemonId(): int
    {
        return $this->getRandomPokemonId(1, 151);
    }

    private function getRandomSecondGenerationPokemonId(): int
    {
        return $this->getRandomPokemonId(152, 251);
    }

    private function getRandomThirdGenerationPokemonId(): int
    {
        return $this->getRandomPokemonId(252, 381);
    }

    public function getRandomPokemonId(int $minId = 1, int $maxId = 381): int
    {
        if ($minId < 1 || $maxId > 381) {
            throw new InvalidPokemonIdException;
        }

        return rand($minId, $maxId);
    }

    public function getPokemonEvolutionChain(string|int $evolucionChainId): mixed
    {
        $response = $this->guzzleHttpClient->request('GET', "evolution-chain/{$evolucionChainId}");
        $evolutionChainFromApi = json_decode($response->getBody()->getContents());

        return $evolutionChainFromApi;
    }

    public function getPokemonSpecies(string|int $pokemonId): mixed
    {
        $response = $this->guzzleHttpClient->request('GET', "pokemon-species/{$pokemonId}");
        $speciesFromApi = json_decode($response->getBody()->getContents());

        return $speciesFromApi;
    }

    private function getPokemonDetails(string|int $pokemonId): mixed
    {
        $response = $this->guzzleHttpClient->request('GET', "pokemon/{$pokemonId}");
        $pokemonFromApi = json_decode($response->getBody()->getContents());

        return $pokemonFromApi;
    }
}
