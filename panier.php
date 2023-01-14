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
    <?php
    include 'templates/nav.php';
    ?>
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
                print "<center><a id=\"info-bouton-ajouter\"href=\"actionsPanier.php?id=$idCD&mode=4\">Vider le panier</a></center>";
                print "<div class=\"infosCommande\">";
                print "<p>$nbItemsDansPanier article(s)</p>";
                print "<p>Prix total : €$prixFinal</p>";
                print "<a href=\"paiement.php?nbArticle=$nbItemsDansPanier&prix=$prixFinal\">Commander</a>";
                print "</div>";
            }
        ?>
    </article>
    <?php
    include 'templates/footer.php';
    ?>
</body>
</html>