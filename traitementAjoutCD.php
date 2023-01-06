<?php

session_start();

include 'configBD.php';

$link = getConnection();

$nomtable= "CD";

// Récupération des données du formulaire
$title = $_POST['titre'];
$author = $_POST['auteur'];
$genre = $_POST['genre'];
if($genre == "autre") {
    $genre = $_POST['genre_autre'];
}
$price = $_POST['prix'];


// Etape 1 On verifie si le titre n'existe pas déjà dans la BD
$sql = "SELECT * FROM $nomtable WHERE titre = '$title'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // Titre déjà présent dans la table "CD"
    echo '<body onLoad="alert(\'Ce titre existe déjà dans la base de données.\')">'; 
    // puis on le redirige vers la page d'accueil 
    echo '<meta http-equiv="refresh" content="0;URL=ajoutSupprCDs.php">'; 
} else {
// Etape 2 Insertion des données dans la BD
    $query = "INSERT INTO $nomtable (titre, auteur, genre, prix) VALUES ('$title', '$author', '$genre', '$price')";

    // Exécution de la requête et vérification du résultat
    if (mysqli_query($link, $query)) {
        echo '<body onLoad="alert(\'Nouvel enregistrement ajouté avec succès.\')">'; 
        // puis on le redirige vers la page d'accueil 
        echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
    } else {
        echo "Erreur : " . $query . "<br>" . mysqli_error($link);
    }
}


?>