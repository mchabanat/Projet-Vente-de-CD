<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;700&display=swap" rel="stylesheet">

    <!-- Titre onglet -->
    <title>CD - Accueil</title>
</head>
<body>
    <?php
    include 'templates/nav.php';
    ?>
    <article class="au-centre">
        <div id="top">
            <h1>Bienvenue sur HappyMusic !</h1>
            <h2>Information CD</h2>
            <a id="info-bouton-ajouter" href="accueil.php">Retour à l'accueil</a>
        </div>
            <?php 
                include 'configBD.php';

                $link = getConnection();

                $nomtable = "CD";

                $idCD = $_GET['id'];

                $query="SELECT * FROM $nomtable WHERE id=$idCD";
                $result=mysqli_query($link,$query);

                $donnees=mysqli_fetch_assoc($result);
                $titre=$donnees["titre"];
                $auteur=$donnees["auteur"];
                $genre=$donnees["genre"];
                $prix=$donnees["prix"];
                $url=$donnees["urlVignette"];

                print "<div class=\"leCDDemande\">";
                print "<div><a href=\"$url\"><img id=\"vignette\" src=\"traitementImage.php?url=$url&width=500&height=500\" alt=\"vignette $titre\"></a></div>";
                print "<div class=\"infosCD-container\">";
                print "<p id=\"titre-du-cd\"><u>Titre</u> : $titre</p>";
                print "<p id=\"auteur-du-cd\"><u>Auteur</u> : $auteur</p>";
                print "<p id=\"genre-du-cd\"><u>Genre</u> : $genre</p>";
                print "<p id=\"prix-du-cd\"><u>Prix</u> : {$prix}€</p>";
                print "<a id=\"info-bouton-ajouter\" href=\"ajouterPanier.php?id=$idCD\">Ajouter au panier</a>";
                print "</div>";
                print "</div>";
            ?> 
            </div>
    </article>
    <?php
    include 'templates/footer.php';
    ?>
</body>
</html>