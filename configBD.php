<?php 

$bdd= "mchabanat"; // Base de données
$host= "localhost";
$user= "root";  // Utilisateur 
$pass= ""; // mp 

function getConnection() {
    global $host, $user, $pass, $bdd;
    $link=mysqli_connect($host,$user,$pass,$bdd) or die("Impossible de se connecter à la base de données");
    return $link;
}

?>