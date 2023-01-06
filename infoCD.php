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
    <nav>
        <a href="accueil.php"><img id="logoSite" src="images/cd.png" alt="logoSite"></a>
        <?php 
        // Verification de si un utilisateur est connecté en admin
        if (!isset($_SESSION['login']) && !isset($_SESSION['pwd'])) {
            // S'il n'est pas connecté, on lui propose un bouton pour se connecter
            print "<a id=\"bouton-nav\" href=\"connexionAdmin.php\">Se connecter en Admin</a>";
        } else {
            // Sinon, on lui indique qu'il est connecté en tant qu'admin et qu'il peut ajouter des CD ou se deconnecter 
            if ($_SESSION['login'] == "admin" && $_SESSION['pwd'] == "admin") {
                print "<div class=\"connected-container\">";
                print "<p id=\"power-active\">⭐Pouvoir administrateur activé⭐</p>";
                print "<div class=\"options-container\">";
                print "<a id=\"bouton-nav\" href=\"ajoutCDs.php\">AJOUTER DES CD</a>";
                print "<a id=\"bouton-nav\" href=\"traitementDeconnexion.php\">Se déconnecter</a>";
                print "</div></div>";
            }
        }
        ?>
        <a href="panier.php"><img id="panier" src="images/panier.png" alt="panier"></a>
    </nav>
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
                print "<div><img id=\"vignette\" src=\"traitementImage.php?url=$url&width=500&height=500\" alt=\"vignette $titre\"></div>";
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
    <footer>
        <p>Réalisé par Matis Chabanat !</p>
        <p>2022 - 2023</p>
    </footer>
</body>
</html>