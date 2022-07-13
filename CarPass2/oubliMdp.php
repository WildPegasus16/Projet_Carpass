<!DOCTYPE html>
<html class = "" lang = "fr-FR">
    <head>
        <title>Mot de passe oublié ?</title>
        <meta charset = "utf-8"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>

        <link rel="stylesheet" href="css/index.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Radio+Canada&display=swap" rel="stylesheet">
    </head>

    <body>
    <div class="resetMdp">
        <form method="post" action="resetMdp.php">
            <label for="plaqueRecup">Saisissez votre plaque d'immatriculation:</label>
            <input type="text" name="plaqueRecup" required>
            <div class="submit">
                <input type="submit" value="Valider">
            </div>
        </form>
    </div>
    </body>

<?php
