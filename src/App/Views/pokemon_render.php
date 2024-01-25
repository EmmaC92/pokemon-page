<h1>Pokémon Details</h1>
<h1> <?php echo "#{$newPokemon->getPokedexIndex()} | {$newPokemon->getName()}" ?> </h1>

<div class="pokemon-details">
    <img src="<?php echo $newPokemon->getImage() ?>" alt="Pokémon Image" class="pokemon-image" title="<?php echo $newPokemon->getName() ?>">

    <div class="pokemon-statistics">
        <div class="stats">
            <h2>Stats</h2>
            <ul>
                <?php foreach ($newPokemon->getStats() as $key => $stat) : ?>
                    <li>
                        <?php echo "$key: $stat." ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="movements">
            <h2>Movements</h2>
            <ul>
                <?php foreach ($newPokemon->getAttacks() as $attack) : ?>
                    <li>
                        <?php echo $attack ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="types">
            <h2>Types</h2>
            <ul>
                <?php foreach ($newPokemon->getTypes() as $type) : ?>
                    <li>
                        <?php echo $type ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>