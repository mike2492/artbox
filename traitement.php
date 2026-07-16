<?php
$titre = htmlspecialchars(trim($_POST['titre']));
$description = htmlspecialchars(trim($_POST['description'])); 
$artiste = htmlspecialchars(trim($_POST['artiste']));
$image = htmlspecialchars(trim($_POST['image']));

$erreurs = [];

if(empty($titre)){
    $erreurs[] = 'Le titre est obligatoire';
}

if(empty($artiste)){
    $erreurs[] = 'L\'artiste est obligatoire';
}

if(strlen($description) < 3){
    $erreurs[] = 'La description doit faire au moins 3 caractères';
}

if(!filter_var($image, FILTER_VALIDATE_URL) || strpos($image, 'https://') !== 0){
    $erreurs[] = 'Le lien de l\'image doit être une URL valide commençant par https://.';
}

if(!empty($erreurs)){
    foreach($erreurs as $erreur){
        echo '<p>' . $erreur . '</p>';
    }
}