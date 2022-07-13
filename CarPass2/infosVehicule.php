<?php

session_start();
require_once ('estConnecte.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$nomServ = 'localhost';
$nomUtil = 'root';
$mdp = 'root';
$nomDb = 'carpass';

$conn = mysqli_connect($nomServ,$nomUtil,$mdp,$nomDb);

if (mysqli_connect_errno()) {
    echo "Impossible de se connecter a MySQL: " . mysqli_connect_error();
    exit();
}

$immatriculation = $_SESSION['username'];

$recupInfosUtil = "Select C.* from Client C, Vehicule V where v.client_id = c.client_id and v.numero_de_plaque='$immatriculation'";
$recupInfosVehicule = "Select * from Vehicule where numero_de_plaque = '$immatriculation'";
$query1 = mysqli_query($conn, $recupInfosUtil);
$query2 = mysqli_query($conn, $recupInfosVehicule);
if (!$query1 || !$query2) die('Erreur de requête' . mysqli_error($conn));
else {
    $infosClient = mysqli_fetch_assoc($query1);
    $infosVehicule = mysqli_fetch_assoc($query2);
}
?>

<!DOCTYPE html>
<html class = "" lang = "fr-FR">
<head>
    <title>Modifier vos informations personnelles | Historique kilométrique de votre véhicule</title>
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
    <form method="post" action="infosVehicule.php">
        <div class="infos_perso">
            <h1>Vos informations personnelles:</h1>
            <label for="prenom_client" class="req">Prenom: </label>
            <br>
            <input type="text" name="prenom_client" value="<?php echo $infosClient['prenom']; ?>" readonly/>
            <br>
            <label for="nom_client" class="req">Nom: </label>
            <br>
            <input type="text" name="nom_client" value="<?php echo $infosClient['nom']; ?>" readonly/>
            <br>
            <label for="mail_client" class="req">Adresse Mail: </label>
            <br>
            <input type="email" name="mail_client" value="<?php echo $infosClient['mail']; ?>" required/>
            <br>
            <label for="adresse_client" class="req">Adresse postale: </label>
            <br>
            <input type="text" name="adresse_client" value="<?php echo $infosClient['adresse']; ?>" required/>
            <br>
            <label for="num_telephone" class="req">N° téléphone: </label>
            <br>
            <input type="tel" name="num_telephone" value="<?php echo $infosClient['telephone']; ?>" pattern="" required/>

            <br>
            <a href="#">Vous souhaitez changer de mot de passe ?</a>
        </div>
        <hr>
        <div class="infos_vehicule">
            <h1>Les informations sur votre véhicule:</h1>
            <label for="numero_de_plaque" class="req">N° immatriculation: </label>
            <br>
            <input type="text" name="numero_de_plaque" value="<?php echo $infosVehicule['numero_de_plaque']; ?>" readonly/>
            <br>
            <label for="numero_de_chassis" class="req">N° chassis: </label>
            <br>
            <input type="text" name="numero_de_chassis" value="<?php echo $infosVehicule['numero_chassis']; ?>" readonly/>
            <br>
            <label for="kilometrage" class="req">Kilométrage (au dernier passage chez un partenaire): </label>
            <br>
            <input type="text" name="kilometrage" value="<?php echo $infosVehicule['kilometrage']; ?>" readonly/>
            <br>
            <label for="carburant" class="req">Type de carburant: </label>
            <br>
            <select name="carburant" type="text" disabled="true">
                <option value="<?php echo $infosVehicule['carburant'];?>" ></option>
                <option>Essence</option>
                <option>Diesel</option>
                <option>Ethanol</option>
                <option>GPL</option>
            </select>
            <br>
            <label for="date_circulation_debut" class="req">Date de première mise en circulation: </label>
            <br>
            <input type="text" name="date_circulation_debut" value="<?php echo $infosVehicule['date_circulation_debut']; ?>" readonly/>
            <br>
            <a href="changementVehicule.php">Vous avez changé de véhicule ?</a>
        </div>
        <div class="submit">
            <input type="submit" value="Mettre à jour les informations">
        </div>
    </form>
</body>


<?php
    $nouvMail = htmlspecialchars($_POST['mail_client']);
    $nouvAdresse = htmlspecialchars($_POST['adresse_client']);
    if($_POST['submit']) {
        $majInfos = "Update Client inner join Vehicule on Vehicule.client_id = Client.client_id Set mail = '$nouvMail' and adresse = '$nouvAdresse' where " ;
    }