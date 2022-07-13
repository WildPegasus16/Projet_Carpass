<!DOCTYPE html>
<html class = "" lang = "fr-FR">
    <head>
        <title>Connexion | Historique kilométrique de votre véhicule</title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta charset = "utf-8"/>

        <link rel="stylesheet" href="css/connexion.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Radio+Canada&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="login">
            <h1>Authentification</h1>
                <form method="post" action="loginPro.php">
                    <label class="req" for="adresse_mail">Adresse Mail:</label>
                    <br>
                    <input type="email" name="adresse_mail" required>
                    <br>
                    <label class="req" for="mdp_utilisateur">Mot de passe:</label>
                    <br>
                    <input type="password" name="mdp_utilisateur" required>
                    <br>
                    <div class="submit">
                        <input type="submit" value="Se connecter">
                    </div>
                </form>
        </div>
    </body>

<?php