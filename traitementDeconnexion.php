<?php 
    // On démarre la session 
    session_start(); 
    
    // On détruit les variables de connexion admin de notre session
    unset($_SESSION['login']);
    unset($_SESSION['pwd']);
    
    // On redirige le visiteur vers la page d'accueil 
    header ('location: accueil.php'); 
?>