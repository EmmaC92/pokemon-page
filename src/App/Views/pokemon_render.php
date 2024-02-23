<h1>Pokémon Details</h1>
<h1> #{{ newPokemon.getPokedexIndex }} | {{ newPokemon.getName }} </h1>

<div class="pokemon-details">
    <img src={{newPokemon.getImage}} alt="Pokémon Image" class="pokemon-image" title="<?php echo $newPokemon->getName() ?>">

    <div class="pokemon-statistics">
        <div class="stats">
            <h2>Stats</h2>
            <ul>
                {% for stat, key in newPokemon.getStats %}
                    <li>
                        {{stat}}: {{key}}.
                    </li>
                {% endfor %}
            </ul>
        </div>

        <div class="movements">
            <h2>Movements</h2>
            <ul>
                {% for attack in newPokemon.getAttacks %}
                    <li>
                        {{attack}}
                    </li>
                {% endfor %}
            </ul>
        </div>

        <div class="types">
            <h2>Types</h2>
            <ul>
                {% for type in newPokemon.getTypes %}
                    <li>
                        {{type}}
                    </li>
                {% endfor %}
            </ul>
        </div>
    </div>
</div>