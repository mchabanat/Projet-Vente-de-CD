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