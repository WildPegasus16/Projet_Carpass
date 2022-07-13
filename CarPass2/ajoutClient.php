<?php
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

if (isset($_POST['nom_client']) && $_POST['prenom_client'] && $_POST['adresse_client'] && $_POST['immatriculation'] && $_POST['mdp_client'] && $_POST['confirmer_mdp']) {
    $nom_client = htmlspecialchars($_POST['nom_client']);
    $prenom_client = htmlspecialchars($_POST['prenom_client']);
    $adresse_client = htmlspecialchars($_POST['adresse_client']);
    $immatriculation = htmlspecialchars($_POST['immatriculation']);
    $mdp_client = htmlspecialchars($_POST['mdp_client']);
    $confirmer_mdp = htmlspecialchars($_POST['confirmer_mdp']);

    if ($mdp_client == $confirmer_mdp) {
        $ajoutDb = "INSERT into client(Nom,Prenom,Mail,Mot_de_passe,Role) values ('$nom_client','$prenom_client','$adresse_client','$mdp_client','Client')";
        $resultat_ajout = mysqli_query($conn, $ajoutDb);
        $ajoutDb2 = "Insert into vehicule(numero_de_plaque) values ('$immatriculation')";
        $resultat_ajout2 = mysqli_query($conn, $ajoutDb2);
        if (!$resultat_ajout || !$resultat_ajout2) die('Erreur de requête' . mysqli_error($conn));
        else {
            $res = mysqli_query($conn,"Select client_id from client where mail = '$adresse_client'");
            $data = mysqli_fetch_assoc($res);
            $IdClient = $data['client_id'];
            $majId = "Update vehicule set client_id = '$IdClient' where numero_de_plaque = '$immatriculation'";
            $resultat_update = mysqli_query($conn, $majId);
            if (!$resultat_update) die('Erreur de requête' . mysqli_error($conn));
        }
        ?>
        <meta http-equiv="location" content="6;url=authentificationClient.php">
        Vous allez être redirigés vers l'espace de connexion.
        <?php
        }
    else { ?>
        <meta http-equiv="refresh" content="10;url=inscription.php">
        Le mot de passe de confirmation n'est pas conforme. Votre inscription n'a pas pu être validée. Vous allez être redirigé vers la page.
        <?php
    }

}
