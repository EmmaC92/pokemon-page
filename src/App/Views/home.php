{{include('partials/_navbar.php')}}
{{include('partials/_head.php')}}

<html>

<body>
    <div class="pokemon_list">
        {% for pokemon in pokemonArray %}
            {% include 'pokemon_render.php' with {'newPokemon': pokemon} %}
        {% endfor %}
    </div>
</body>

</html>