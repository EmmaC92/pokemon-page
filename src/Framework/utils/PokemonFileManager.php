<?php

declare(strict_types=1);

namespace Acme\Framework\utils;

use Acme\Framework\exceptions\FileNotFoundException;
use Acme\Framework\models\Pokemon\TrainingPokemon;

class PokemonFileManager
{
    private const POKEMON_FILE = "pokemon_list.txt";

    private const POKEMON_FILE_DIRECTORY = __DIR__ . DIRECTORY_SEPARATOR . "pokemon-list";

    private const POKEMON_FILE_FULL_PATH = self::POKEMON_FILE_DIRECTORY . DIRECTORY_SEPARATOR . self::POKEMON_FILE;

    public static function writeNewPokemon(TrainingPokemon $pokemon): void
    {
        self::checkPokemonFile();
        $fileContent = file_get_contents(self::POKEMON_FILE_FULL_PATH) . $pokemon->getName() . "\n";
        file_put_contents(self::POKEMON_FILE_FULL_PATH, $fileContent);
    }

    public static function ReadPokemonFromList(): array
    {
        self::checkPokemonFile();
        $fileContent = trim(file_get_contents(self::POKEMON_FILE_FULL_PATH)) ?: null;
        return $fileContent ? explode("\n", $fileContent) : [];
    }

    private static function checkPokemonFile(bool $createFile = true): void
    {
        if (!file_exists(self::POKEMON_FILE_FULL_PATH)) {

            if (!$createFile) {
                throw new FileNotFoundException;
            }
            file_put_contents(self::POKEMON_FILE_FULL_PATH, '');
        }
    }
}
