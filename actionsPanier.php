<?php
session_start();

$id = $_GET['id'];
$mode = $_GET['mode'];

// On regarde si le tableau est déclaré
if (isset($_SESSION['eltsPanier'])) {
    // On regarde si le tableau est vide
    if (sizeof($_SESSION['eltsPanier']) != 0) {
        // S'il n'est pas vide, on regarde quelle action il faut faire sur l'article en question
        switch($mode) {
            case 1: // On enlève un exemplaire
                if ($_SESSION['eltsPanier'][$id] == 1) {
                    // S'il y est en un seul exemplaire alors on le supprime du panier
                    unset($_SESSION['eltsPanier'][$id]);
                } else {
                    // S'il est en plusieurs exemplaires dans le panier, alors on enlève 1 exemplaire
                    $_SESSION['eltsPanier'][$id]--;
                }
                break;
            case 2: // On ajoute un exemplaire
                $_SESSION['eltsPanier'][$id]++;
                break;
            case 3: // On supprime du panier
                unset($_SESSION['eltsPanier'][$id]);
                break;
            case 4: // On vide le panier
                // Réinitialisation du panier à un tableau vide
                $_SESSION["eltsPanier"] = array();
                break;
        }
        header("Location: panier.php");
    }
} else {
    echo 'Les variables ne sont pas déclarées.'; 
}

?>