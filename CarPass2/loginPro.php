<?php

session_start();

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

if(isset($_POST['adresse_mail']) && isset($_POST['mdp_utilisateur'])) {
    $IdPro = htmlspecialchars($_POST['adresse_mail']);
    $IdPro = mysqli_real_escape_string($conn, $IdPro);
    $mdp_util = htmlspecialchars($_POST['mdp_utilisateur']);
    $mdp_util = mysqli_real_escape_string($conn, $mdp_util);
    $resultAdmin = mysqli_query($conn, "SELECT * from admin where mail = '$IdPro' and mot_de_passe = '$mdp_util'");
    $admin = mysqli_fetch_assoc($resultAdmin);
    $resultPartenaire = mysqli_query($conn, "SELECT * from partenaire where mail = '$IdPro' and mot_de_passe = '$mdp_util'");
    $partenaire = mysqli_fetch_assoc($resultPartenaire);

    if ($admin) {
        if ($admin['role'] == 'Admin') {
            header('location: espace_admin.php');
            $_SESSION['username'] = $IdPro;
        }
    }
    else if($partenaire) {
        if ($partenaire['role'] == 'Partenaire') {
            header('location: espace_partenaire.php');
            $_SESSION['username'] = $IdPro;
        }
    }
    }
    else {
        echo "L'adresse mail ou le mot de passe que vous avez saisi est incorrect(e).";
        header("4,refresh:accesPro.php");
    }
