<div>
    <h1>Moves</h1>
    <?php foreach ($attempt as $attack) : ?>
        <strong>
            <?php echo "{$attack['pokemon']}: {$attack['attack']} | {$attack['value']}." ?><br>
        </strong>
    <?php endforeach; ?>
</div>