<?php
        include $this->resolvePath('partials/_navbar.php');
        include $this->resolvePath('partials/_head.php');
?>

<html>

<body>
    <div class="pokemon_list">
        <?php
        foreach ($pokemonArray as $newPokemon) {
            include 'pokemon_render.php';
        }
        ?>
    </div>
</body>

</html>