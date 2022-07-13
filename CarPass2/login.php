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

if(isset($_POST['immatriculation']) && isset($_POST['mdp_client'])) {
    $immatriculation = htmlspecialchars($_POST['immatriculation']);
    $immatriculation = mysqli_real_escape_string($conn, $immatriculation);
    $mdp_util = htmlspecialchars($_POST['mdp_client']);
    $mdp_util = mysqli_real_escape_string($conn, $mdp_util);
    $query = "SELECT c.role from Vehicule v, Client c where v.client_id = c.client_id and v.numero_de_plaque = '$immatriculation' and c.mot_de_passe = '$mdp_util'";
    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if ($user['role'] == 'Client') {
            header('location: espace_client.php');
            $_SESSION['username'] = $immatriculation;
        }
    }
    else {
        echo "L'immatriculation ou le mot de passe que vous avez saisi est incorrect(e).";
        header("4,refresh:authentificationClient.php");
    }

}