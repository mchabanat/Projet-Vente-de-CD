<?php
session_start();

$idAAjouter = $_GET["id"];

//Ajouter un CD d'id idAAjouter
if (isset($_SESSION['eltsPanier'])) {
    // D'abord regarder si le cd en question est deja dans le panier. S'il y est deja, incrémenter la quantité.
    if (array_key_exists($idAAjouter, $_SESSION['eltsPanier'])) {
        $_SESSION['eltsPanier'][$idAAjouter]++;
    } else {
        $_SESSION['eltsPanier'][$idAAjouter] = 1;
    }
    header("Location: accueil.php");
} else {
    echo 'Les variables ne sont pas déclarées.';
}

?>