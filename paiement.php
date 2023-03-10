<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>CD - Paiement</title>
</head>
<body>
    <?php
    include 'templates/nav.php';
    ?>
    <article>
        <h1>Bienvenue sur HappyMusic !</h1><br><br>
        <center>
            <h2>Paiement</h2><br>

            <div id="infos-commande">
                <?php
                
                $nbArticles = $_GET['nbArticle'];
                $prixTotal = $_GET['prix'];

                print "<p id=\"prix-du-cd\">Nombre d'articles : <strong>$nbArticles</strong></p>";
                print "<p id=\"prix-du-cd\">Prix Total : <strong>{$prixTotal}€</strong></p>";

                ?>
            </div>

            <form method="post" action="traitementPaiement.php">
                <label for="numero_carte">Numéro de carte :</label>
                <input type="text" id="numero_carte" name="numero_carte" maxlength="16" onkeyup="verifierLongueurNumeroCarte()">
                <div id="erreur_numero_carte"></div>
                <script>
                    function verifierLongueurNumeroCarte() {
                      // récupère la valeur du champ de saisie
                      var numero_carte = document.getElementById("numero_carte").value;
                    
                      // vérifie la longueur du numéro de carte
                      if (numero_carte.length != 16) {
                        // affiche le message d'erreur
                        document.getElementById("erreur_numero_carte").innerHTML = "Le numéro de carte doit contenir 16 chiffres.";
                      } else {
                        // masque le message d'erreur
                        document.getElementById("erreur_numero_carte").innerHTML = "";
                      }
                    }
                </script><br>
                <label for="date_validite">Date de validité :</label>
                <div id="dates">
                    <select name="mois" id="mois">
                        <option value="01" selected>1</option>
                        <?php
                        for($i = 2;$i <= 12;$i++) {
                            if($i < 10) {
                                print "<option value=\"0$i\">$i</option>";
                            } else {
                                print "<option value=\"$i\">$i</option>";
                            }
                        }
                        ?>
                    </select>
                    <select name="annee" id="annee">
                        <?php
                        for($i = 2023;$i <= 2038;$i++) {
                            print "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <br>
                <input type="submit" value="Valider">
            </form> 
              
        </center>
    </article>
    <?php
    include 'templates/footer.php';
    ?>
</body>
</html>