<!DOCTYPE html>
<html class = "" lang = "fr-FR">
    <head>
        <title>Inscription | Historique kilométrique de votre véhicule</title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta charset = "utf-8"/>

        <link rel="stylesheet" href="css/connexion.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Radio+Canada&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="inscription">
            <div class="infos">
                <h1>Inscription</h1>
                <form method="post" action="ajoutClient.php">
                    <label for="nom_client" class="req">Nom:</label>
                    <br>
                    <input name="nom_client" placeholder="" class="form-control" type="text" required>
                    <br>
                    <label for="prenom_client" class="req">Prénom:</label>
                    <br>
                    <input name="prenom_client" placeholder="" class="form-control" type="text" required>
                    <br>
                    <label for="adresse_client" class="req">Adresse Mail:</label>
                    <br>
                    <input name="adresse_client" placeholder="" class="form-control" type="email" required>
                    <br>
                    <label for="immatriculation" class="req">N° d'immatriculation:</label>
                    <br>
                    <input name="immatriculation" placeholder="" class="form-control" type="text" required>
                    <br>
                    <label for="mdp_client" class="req">Insérer mot de passe:</label>
                    <br>
                    <input name="mdp_client" placeholder="" class="form-control" type="password" required>
                    <br>
                    <label for="nom_client" class="req">Confirmer mot de passe:</label>
                    <br>
                    <input name="confirmer_mdp" placeholder="" class="form-control" type="password" required>
                    <br>
                    <div class="submit">
                        <input type="submit" value="S'inscrire">
                    </div>
                </form>
            </div>
        </div>
    </body>