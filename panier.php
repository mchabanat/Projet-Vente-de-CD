<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CD - Panier</title>
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

    <article id="article-panier">
        <h1>Bienvenue sur HappyMusic !</h1><br><br>
            <h2>Votre panier</h2>

            <?php
                include 'configBD.php';

                $link = getConnection();

                $nomtable = "CD";

                $prixFinal = 0; // Représente la somme du prix de tous les articles du panier
                $nbItemsDansPanier = 0;
                $tailleTab = sizeof($_SESSION['eltsPanier']);

                // Affichage du panier
                if ($tailleTab == 0) {
                    // S'il est vide, on affiche panier vide
                    print "<div id=\"panier-vide\">";
                    print "<p>Le panier est vide.</p>";
                    print "</div>";
                } else {
                    // Parcours du tableau pour afficher chaque élément
                    foreach ($_SESSION["eltsPanier"] as $idCD => $qte) {
                        // Requete qui récupère les infos du cd selon son id
                        $sql = "SELECT * FROM $nomtable WHERE id=$idCD";
                        $result=mysqli_query($link,$sql); 

                        $donnees=mysqli_fetch_assoc($result);

                        $titre=$donnees["titre"];
                        $auteur=$donnees["auteur"];
                        $genre=$donnees["genre"];
                        $prix=$donnees["prix"] * $qte;

                        $prixFinal += $prix;
                        $nbItemsDansPanier += $qte;

                        // Affichage
                        print "<div class=\"unArticlePanier\">";
                        print "<div class=\"infosAlbum\">";
                        print "<p id=\"titre\">$titre</p>";
                        print "<p>$auteur</p>";
                        print "</div>";
                        print "<div id=\"gerer-quantite-container\">";
                        print "<a id=\"bouton-qte\" href=\"actionsPanier.php?id=$idCD&mode=1\">-1</a>";
                        print "<p>Nb Exemplaires : $qte</p>";
                        print "<a id=\"bouton-qte\" href=\"actionsPanier.php?id=$idCD&mode=2\">+1</a>";
                        print "</div>";
                        print "<p>Prix = €$prix</p>";
                        print "<a id=\"supprimer-du-panier\"href=\"actionsPanier.php?id=$idCD&mode=3\">Retirer du panier</a>";
                        print "</div>";
                    }
                    
                    print "<div class=\"infosCommande\">";
                    print "<p>$nbItemsDansPanier article(s)</p>";
                    print "<p>Prix total : €$prixFinal</p>";
                    print "<a href=\"paiement.php?nbArticle=$nbItemsDansPanier&prix=$prixFinal\">Commander</a>";
                    print "</div>";
                }
            ?>
    </article>
    <footer>
        <p>Réalisé par Matis Chabanat !</p>
        <p>2022 - 2023</p>
    </footer>
</body>
</html>