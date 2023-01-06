<?php 
session_start();
// récupère les données de la carte de crédit
$numero_carte = $_POST['numero_carte'];
$mois_saisi = $_POST['mois'];
$annee_saisie = $_POST['annee'];

// vérifie la longueur du numéro de carte
if (strlen($numero_carte) != 16) {
    echo '<body onLoad="alert(\'Le numéro de carte doit contenir 16 chiffres.\')">'; 
    // puis on le redirige vers la page de paiement 
    echo '<meta http-equiv="refresh" content="0;URL=paiement.php">'; 
    exit;
}

// vérifie que le dernier chiffre du numéro de carte est identique au premier
if ($numero_carte[0] != $numero_carte[15]) {
    echo '<body onLoad="alert(\'Le dernier chiffre du numéro de carte doit être identique au premier.\')">'; 
    // puis on le redirige vers la page de paiement 
    echo '<meta http-equiv="refresh" content="0;URL=paiement.php">'; 
    exit;
}

// vérifie que la date de validité est supérieure à la date du jour + 3 mois
$date_ajd = date("Y-m-01"); // Utilisez le format "Y-m-d" pour obtenir l'année-mois-jour
$date_saisie = "$annee_saisie-$mois_saisi-01"; // Fixez le jour à "01" car vous ne le connaissez pas
$date_limite = date("Y-m-01", strtotime($date_ajd . " +3 months"));

if ($date_saisie < $date_limite) {
    echo "<body onLoad=\"alert('La date de validité de la carte doit être supérieure à la date du jour + 3 mois.')\">"; 
    // puis on le redirige vers la page de paiement 
    echo '<meta http-equiv="refresh" content="0;URL=paiement.php">'; 
    exit;
}


// On vide le panier
unset($_SESSION['eltsPanier']);

// si on arrive ici, cela signifie que la carte de crédit est valide
echo '<body onLoad="alert(\'Paiement validé !\')">'; 

// puis on redirige vers la page d'accueil 
echo '<meta http-equiv="refresh" content="0;URL=accueil.php">'; 

?>