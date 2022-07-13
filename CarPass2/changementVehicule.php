<!DOCTYPE html>
<html class = "" lang = "fr-FR">
<head>
    <title>Signaler un changement de véhicule | Historique kilométrique de votre véhicule</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta charset = "utf-8"/>

    <link rel="stylesheet" href="css/espace.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Lato:wght@300&display=swap" rel="stylesheet">
</head>

<header>
    <div class="header">
        <a class="logo" href="#">Carmeter</a>
        <div class = "headerRight">
            <a href="espace_client.php">Accueil</a>
            <a class="active" href="#">Vos informations</a>
            <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>
</header>


<body>
    <div class="changementVehicule">
    <div class="introChangementVehicule">
        <h1>Vous avez changé de véhicule ?</h1>
        <p>Saisissez dès maintenant la plaque d'immatriculation de votre nouveau véhicule. Nos partenaires se chargeront de mettre à jour ses informations.</p>
    </div>
    <div class="majImmatriculation">
        <form method="post">
            <label for="immatriculation" class="req">Votre nouveau n° d'immatriculation:
                <input name="immatriculation" placeholder="" class="form-control" type="text" required>
            </label>
            <div class="submit">
                <input type="submit" value="Valider">
            </div>
        </form>
    </div>
    </div>
</body>

<?php
session_start();
require_once ('estConnecte.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$nomServ = 'localhost';
$nomUtil = 'root';
$mdp = 'root';
$nomDb = 'carpass';

$conn = mysqli_connect($nomServ,$nomUtil,$mdp,$nomDb);

$anciennePlaque = $_SESSION['username'];
if(isset($_POST['immatriculation']) && $_POST('submit')) {
    $nouv_immatriculation = $_POST['immatriculation'];
    $obtenirId = "Select client.client_id from client, vehicule where vehicule.client_id=client.client_id and vehicule.numero_de_plaque='$anciennePlaque'";
    $recupId = mysqli_fetch_assoc(mysqli_query($conn,$obtenirId));
    $majClientId = "Update Vehicule, Client set Vehicule.client_id = 'NULL' where Vehicule.client_id = Client.client_id and Vehicule.numero_de_plaque = '$anciennePlaque'";
    $vehiculeExiste = mysqli_query($conn, "Select numero_de_plaque from Vehicule where numero_de_plaque = '$nouv_immatriculation'");
    if(mysqli_num_rows($vehiculeExiste)>0) $nouvVehicule = "Update Vehicule inner join Client on Vehicule.client_id = Client.client_id set Vehicule.client_id = '$recupId' ";
    else $nouvVehicule = "Insert into Vehicule(numero_de_plaque,client_id) values ('$nouv_immatriculation', '$recupId')";

    if(!mysqli_query($conn,$nouvVehicule) || !mysqli_query($conn,$majClientId)) {
        die("Erreur de requête");
        echo 'Vos informations ont bien été confirmées. Merci de fermer cette page.';
    }
}
