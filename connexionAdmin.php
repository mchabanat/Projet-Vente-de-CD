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
    <?php
    include 'templates/nav.php';
    ?>
    <article class="au-centre">
        <h1>Bienvenue sur HappyMusic !</h1>
        <h2>Connexion Administrateur</h2>

        <form id="form-connexion-admin" action="traitementConnexionAdmin.php" method="post">
            Votre login : <input type="text" name="login"><br>
            Votre mot de passe : <input type="password" name="pwd"><br><br>
            <input type="submit" value="Connexion">
        </form> 
    </article>
    <?php
    include 'templates/footer.php';
    ?>
</body>
</html>