<?php
    require 'bdd.php';
    require 'header.php';

    $bdd = connexion();
    
    $sqlQuery = 'SELECT id, title, image, artist FROM oeuvres';
    $statement = $bdd->prepare($sqlQuery);
    $statement->execute();
    $oeuvres = $statement->fetchAll();

?>

<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['title']) ?>">
                <h2><?= htmlspecialchars($oeuvre['title']) ?></h2>
                <p class="description"><?= htmlspecialchars($oeuvre['artist']) ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>

<?php require 'footer.php'; ?>
