<?php
include $this->resolve('partials/_navbar.php');
include $this->resolve('partials/_head.php');
?>

<html>

<body>
    <div class="pokemon_match">
        <?php
        foreach ($pokemonArray as $newPokemon) {
            include 'pokemon_render.php';
        }
        ?>
    </div>
    <?php
    include 'pokemon_moves.php';
    ?>
</body>

</html>