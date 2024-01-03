<div class="pokemon_render">
    <h1 class="name_pokemon_render"> <?php echo "#{$newPokemon->getId()} | {$newPokemon->getName()}" ?> </h1>
    <div class="description_pokemon_render">
        <div>
            <img class="image_pokemon_render" height="100" src="<?php echo $newPokemon->getImage() ?>" title="<?php echo $newPokemon->getName() ?>">
        </div>
        <div class="properties_pokemon_render">
            <ul class="stat_pokemon_render">
                <h4>Stats</h4>
                <?php foreach ($newPokemon->getStats() as $key => $stat) : ?>
                    <li>
                        <?php echo "$key: $stat." ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="type_pokemon_render">
                <h4>Types</h4>

                <?php foreach ($newPokemon->getTypes() as $type) : ?>
                    <li>
                        <?php echo $type ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="attack_pokemon_render">
                <h4>Attacks</h4>

                <?php foreach ($newPokemon->getAttacks() as $attack) : ?>
                    <li>
                        <?php echo $attack ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>