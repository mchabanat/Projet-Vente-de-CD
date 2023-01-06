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
<body id="flou">
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
            <h2>Tous les CDs</h2>
        </div>
        <div id="lesCDs">
            <?php 
                // Tableau associatif : tableau("idDuCd" => "quantité")
                if (!isset($_SESSION['eltsPanier'])) {
                    $_SESSION["eltsPanier"] = array();
                }

                include 'configBD.php';

                $link = getConnection();

                $nomtable = "CD";

                $query1="SELECT DISTINCT(genre) FROM $nomtable";
                $result1=mysqli_query($link,$query1);

                while ($donnees1=mysqli_fetch_assoc($result1)) {
                    $genre = $donnees1["genre"];
                    $query2 = "SELECT * FROM $nomtable WHERE genre='$genre' ORDER BY titre";
                    $result2= mysqli_query($link,$query2);

                    print "<section class=unGenre>";
                    print "<h3>$genre</h3>";
                    print "<div class=\"genre-container\">";
                
                    while ($donnees2=mysqli_fetch_assoc($result2)) {      
                        $id=$donnees2["id"];
                        $titre=$donnees2["titre"];
                        $auteur=$donnees2["auteur"];
                        $genre=$donnees2["genre"];
                        $prix=$donnees2["prix"];
                        $url=$donnees2["urlVignette"];
                        
                        // Affichage d'une carte 
                        print "<div class=\"carte\">";
                        print "<a href=\"infoCD.php?id=$id\"><img id=\"vignette\" src=\"traitementImage.php?url=$url&width=150&height=150\" alt=\"vignette $titre\"></a>";
                        print "<p id=\"titre\">$titre</p>";
                        print "<p id=\"auteur\">$auteur</p>";
                        print "<p id=\"genre\">$genre</p>";
                        if (isset($_SESSION['login']) && isset($_SESSION['pwd'])){
                            if ($_SESSION['login'] == "admin" && $_SESSION['pwd'] == "admin") {
                                print "<div class=\"boutons\">";
                                print "<a class=\"connecte\" href=\"ajouterPanier.php?id=$id\">Ajouter au panier (+{$prix}€)</a>";
                                print "<a class=\"supprCD\" href=\"confirmSuppr.php?id=$id\">Supprimer le CD</a>";
                                print "</div>";
                            }
                        } else {
                            print "<div class=\"boutons\">";
                            print "<a class=\"nonConnecte\" href=\"ajouterPanier.php?id=$id\">Ajouter au panier (+{$prix}€)</a>";
                            print "</div>";
                        }
                        print "</div>";
                    }
                    print "</div></section>";
                }
            ?> 
            </div>
    </article>
    <footer>
        <p>Réalisé par Matis Chabanat !</p>
        <p>2022 - 2023</p>
    </footer>
</body>
</html>