<?php
$erreurs = [];

if(isset($_POST['titre'])){
    $titre = htmlspecialchars(trim($_POST['titre']));
    if(empty($titre)){
        $erreurs[] = "Le titre doit être saisi.";
    }
} else{
    $titre = null;
    $erreurs[] = "Le champ titre n'existe pas.";
}

if(isset($_POST['description'])){
    $description = htmlspecialchars(trim($_POST['description']));
    if(empty($description) || strlen($description) < 3){
        $erreurs[] = "La description doit faire au moins 3 caractères.";
    }
} else{
    $description = null;
    $erreurs[] = "Le champ description n'existe pas.";
}

if(isset($_POST['image'])){
    $image = htmlspecialchars(trim($_POST['image']));
    if(empty($image) || !filter_var($image, FILTER_VALIDATE_URL) || strpos($image, 'https://') !== 0){
        $erreurs[] = "Le lien de l'image doit commencer par https://.";
    } 
} else{
    $image = null;
    $erreurs[] = "Le champ image n'existe pas.";
}

if(isset($_POST['artiste'])){
    $artiste = htmlspecialchars(trim($_POST['artiste']));
    if(empty($artiste)){
        $erreurs[] = "L'artiste doit être saisi.";
    }
} else{
    $artiste = null;
    $erreurs[] = "Le champ artiste n'existe pas.";
}

if(!empty($erreurs)){
    foreach($erreurs as $erreur){
        echo '<p>' . $erreur . '</p>';
    }
} else{
    require 'bdd.php';
    $bdd = connexion();
    $sqlQuery = 'INSERT INTO oeuvres (title, description, artist, image) VALUES (:title, :description, :artist, :image)';
    $statement = $bdd->prepare($sqlQuery);
    $statement->execute([
        'title' => $titre,
        'description' => $description,
        'artist' => $artiste,
        'image' => $image
    ]);

    header('Location: index.php');
    exit;
}