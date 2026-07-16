<?php
    require 'bdd.php';
    require 'header.php';

    $id = intval($_GET['id']);

    if(empty($id)){
        header('Location: index.php');
        exit;
    }

    $bdd = connexion();
    $sqlQuery = 'SELECT * FROM oeuvres WHERE id = ?';
    $statement = $bdd->prepare($sqlQuery);
    $statement->execute([$id]);
    $oeuvre = $statement->fetch();
   
    if(!$oeuvre){
        header('Location: index.php');
        exit;
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['title'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['title'] ?></h1>
        <p class="description"><?= $oeuvre['artist'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>