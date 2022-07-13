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

if(isset($_POST['plaqueRecup'])){
    $plaque = htmlspecialchars($_POST['plaqueRecup']);
    $cherchePlaque = "Select numero_de_plaque from Vehicule where numero_de_plaque = '$plaque' limit 1";
    if(!mysqli_query($conn,$cherchePlaque)) die("Erreur de requête");
    else {
        $data = mysqli_fetch_assoc(mysqli_query($conn, $cherchePlaque));
        if ($plaque == $data['numero_de_plaque']) {
?>
            <link rel="stylesheet" href="css/index.css"/>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Radio+Canada&display=swap" rel="stylesheet">

            <div class="resetMdp">
                <form method="post" action="resetMdp.php?=<?php echo $plaque; ?>">
                    <label for="nouv_mdp">Saisissez votre nouveau mot de passe:</label>
                    <br>
                    <input type="password" name="nouv_mdp" required>
                    <br>
                    <label for="conf_nouv_mdp">Confirmez votre nouveau mot de passe:</label>
                    <br>
                    <input type="password" name="conf_nouv_mdp" required>
                    <div class="submit">
                        <input type="submit" value="Valider">
                    </div>
                </form>
            </div>

            <?php
            if(isset($_POST['nouv_mdp']) && $_POST['conf_nouv_mdp']) {
                $nouvMdp = htmlspecialchars($_POST['nouv_mdp']);
                if ($nouvMdp == htmlspecialchars($_POST['conf_nouv_mdp'])) {
                    $majMdp = "Update client inner join vehicule on vehicule.client_id = client.client_id set client.mot_de_passe = '$nouvMdp' where vehicule.numero_de_plaque = '$plaque'";
                    $updateMdp = mysqli_query($conn,$majMdp);
                    if (!$updateMdp) die('Erreur de requête' . mysqli_error($conn));
                    echo "Votre mot de passe a été correctement modifié. Vous allez être redirigé vers l'espace de connexion";
                    header("Location:","6,authentificationClient.php");
                }
                else {
                    echo "Vous n'avez pas saisi les mêmes données dans les deux champs, veuillez recommencer";
                    header("Refresh:","4,oubliMdp.php");
                }
            }
        }
        else {
            echo "La plaque d'immatriculation saisie n'est pas valide. Veuillez saisir une plaque d'immatriculation correcte.";
            header("Refresh:","6,oubliMdp.php");
        }
    }
}
