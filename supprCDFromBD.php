<?php
session_start();

$idASupprimer = $_GET["id"];

include 'configBD.php';

$link = getConnection();

$nomtable= "CD";

$query = "DELETE FROM $nomtable WHERE id=$idASupprimer";

// Exécution de la requête et vérification du résultat
if (mysqli_query($link, $query)) {
    echo '<body onLoad="alert(\'Suppression réalisée avec succès.\')">'; 
    // puis on le redirige vers la page d'accueil 
    echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
} else {
    echo "Erreur : " . $query . "<br>" . mysqli_error($link);
}

?>