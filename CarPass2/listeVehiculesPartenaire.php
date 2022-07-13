<?php

session_start();
require_once('estConnecte.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$nomServ = 'localhost';
$nomUtil = 'root';
$mdp = 'root';
$nomDb = 'carpass';

$conn = mysqli_connect($nomServ, $nomUtil, $mdp, $nomDb);
?>

<!DOCTYPE html>
<html class = "" lang = "fr-FR">
<head>
    <title>Modifier les informations d'un véhicule | Historique kilométrique de votre véhicule</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta charset = "utf-8"/>

    <link rel="stylesheet" href="css/espace.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Lato:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<header>
    <div class="header">
        <a class="logo" href="#">Carmeter</a>
        <div class = "headerRight">
            <a href="espace_partenaire.php">Accueil</a>
            <a class="active" href="#">Modif. informations</a>
            <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>
</header>

<body>
<form action="" method="post">
    <input name="recupPlaque" type="text" hidden/>
    <label>
        <select name="plaquesPartenaire" id="plaquesPartenaire" type="text" required>
            <option value = ""></option>
            <?php
                $cherche = mysqli_query($conn, "Select v.numero_de_plaque from Vehicule v, Partenaire p where v.partenaire_id = p.partenaire_id");
                while ($vehiculePartenaires = mysqli_fetch_assoc($cherche)) {
                    $valuePlaque = $vehiculePartenaires['numero_de_plaque'];
                    echo "<option value='$valuePlaque'>" . $vehiculePartenaires['numero_de_plaque'] . "</option>";
                }
                $_SESSION['immatriculation'] = $_POST['plaquesPartenaire'];
            ?>
        </select>
    </label>
</form>

    <?php
    if(isset($_POST['plaquesPartenaire'])) {
        $immatriculation = $_SESSION['immatriculation'];
        $recupInfosVehicule = "Select * from Vehicule where numero_de_plaque = '$immatriculation'";
        $query2 = mysqli_query($conn, $recupInfosVehicule);
        $infosVehicule = mysqli_fetch_assoc($query2);
    }
    ?>

    <form method="post" action="modifVehicule.php">
        <div class="infos_vehicule">
            <h1>Les informations du véhicule: <b><?php echo $_SESSION["immatriculation"]; ?></b></h1>
            <label for="numero_de_plaque" class="req">N° immatriculation: </label>
            <br>
            <input type="text" name="numero_de_plaque" id="numero_de_plaque" value="<?php echo $infosVehicule['numero_de_plaque']; ?>" readonly/>
            <br>
            <label for="numero_de_chassis" class="req">N° chassis: </label>
            <br>
            <input type="text" name="numero_de_chassis" id="numero_de_chassis" value="<?php echo $infosVehicule['numero_chassis']; ?>" required/>
            <br>
            <label for="kilometrage" class="req">Kilométrage (au dernier passage chez un partenaire): </label>
            <br>
            <input type="number" name="kilometrage" id="kilometrage" min="<?php echo $infosVehicule['kilometrage']; ?>" value="<?php echo $infosVehicule['kilometrage']; ?>" required/>
            <br>
            <label for="carburant" class="req">Type de carburant: </label>
            <br>
            <select name="carburant" id="carburant" type="text" required>
                <option value="">Sélectionnez un type de carburant</option>
                <option value="essence">Essence</option>
                <option value="diesel">Diesel</option>
                <option value="ethanol">Ethanol</option>
                <option value="gpl">GPL</option>
            </select>
            <br>
            <label for="date_circulation_debut" class="req">Date de première mise en circulation: </label>
            <br>
            <input type="text" name="date_circulation_debut" id="date_circulation_debut" value="<?php echo $infosVehicule['date_circulation_debut']; ?>" required/>
            <br>
        </div>
        <div class="submit">
            <input type="submit" value="Mettre à jour les informations">
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $('#plaquesPartenaire').on('change', function (){
                var choixPlaque = $(this).val();
                if (choixPlaque) {
                    $.ajax({
                        type:'POST',
                        url:'listeVehiculesPartenaire.php',
                        data:'numero_de_plaque'+choixPlaque,
                        success:function(html){
                            $('#numero_de_chassis').html(html);
                            $('#kilometrage').html(html);
                            $('#carburant').html(html);
                            $('#date_circulation_debut').html(html);
                        }
                    });
                }
            });
        });
    </script>
</form>
</body>
