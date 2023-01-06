<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CD - Connexion</title>
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
        <h1>Bienvenue sur HappyMusic !</h1>
        <h2>Connexion Administrateur</h2>

        <form id="form-connexion-admin" action="traitementConnexionAdmin.php" method="post">
            Votre login : <input type="text" name="login"><br>
            Votre mot de passe : <input type="password" name="pwd"><br><br>
            <input type="submit" value="Connexion">
        </form> 
    </article>
    <footer>
        <p>Réalisé par Matis Chabanat !</p>
        <p>2022 - 2023</p>
    </footer>
</body>
</html>