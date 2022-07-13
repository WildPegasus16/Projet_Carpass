<!DOCTYPE html>
<html class = "" lang = "fr-FR">
    <head>
        <meta charset="utf-8">

        <title>Historique kilométrique de votre véhicule</title>

        <meta name="description" content="Consultez l'historique kilométrique et des entretiens de vos véhicules sur notre site."/>
        <meta name="keywords" content="L'historique kilométrique de votre véhicule."/>

        <meta property="og:title" content="L'historique kilométrique de votre véhicule.">
        <meta property="og:type" content="website">
        <!-- <meta property="og:url" content="URL du site"> Quand on aura l'URL/nom de domaine -->

        <link rel="stylesheet" href="css/index.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Lato:wght@300&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    </head>

    <header>
        <div class="header">
            <a class="logo" href="#">Carmeter</a>
            <div class = "headerRight">
                <a class="active" href="#">Accueil</a>
                <a href="authentificationClient.php">Connexion client</a>
                <a href="accesPro.php">Vous êtes un professionnel ?</a>
            </div>
        </div>
    </header>

    <body>
        <!-- <div class="listeVehicules">
            <form name="rechercheVehicules">
            <select name="choixMarque">
                <option value="">Sélectionnez une marque de véhicules</option>
                 <?php /*
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $nomServ = 'localhost';
                $nomUtil = 'root';
                $mdp = 'root';
                $nomDb = 'carpass';

                $conn = mysqli_connect($nomServ, $nomUtil, $mdp, $nomDb);

                $cherche = mysqli_query($conn, "Select nom_marque from marques");
                while($listeMarques = mysqli_fetch_assoc($cherche)) {
                    $valueMarque = $listeMarques['nom_marque'];
                    echo "<option value=$valueMarque>".$listeMarques['nom_marque']."</option>";
                } */
                ?>
            </select>
            <select name="choixModele">
                <option value="">Sélectionnez le modèle</option>
                <?php /* if(isset($_POST['choixMarque'])) {
                    $marqueChoisie = $_POST['choixMarque'];
                    $chercheModeles = mysqli_query($conn,"Select modeles.nom_modele from modeles,marques where marques.marque_id = modeles.marque_id and marques.nom_marque = '$marqueChoisie'");
                    while($listeModeles = mysqli_fetch_assoc($chercheModeles)) {
                        $valueModele = $listeModeles['nom_modele'];
                        echo "<option value=$valueModele>".$listeModeles['nom_modele']."</option>";
                    }
                } */?>
            </select>
            </form></div>
        <script>
            $(document).ready(function(){
                $('#choixMarque').on('change', function (){
                    var choixMarque = $(this).val();
                    if (choixMarque) {
                        $.ajax({
                            type:'POST',
                            url:'index.php',
                            data:'nom_marque'+choixMarque,
                            success:function(html){
                                $('#choixModele').html(html);
                            }
                        }
                        });
                    }
                    }
        </script>
-->
    </body>
</html>

