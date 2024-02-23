{{ include ('partials/_navbar.php') }}
{{ include ('partials/_head.php') }}

<html>
    <body>
        <div class="pokemon_match">
            {% for pokemon in pokemonArray %}
                {% include 'pokemon_render.php' with {'newPokemon': pokemon} %}
            {% endfor %}
        </div>
        {% include 'pokemon_moves.php' with {'attempt': attempt} %}
    </body>
</html>
