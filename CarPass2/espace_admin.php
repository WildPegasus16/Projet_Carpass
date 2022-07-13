<!DOCTYPE html>
<html class = "" lang = "fr-FR">
<head>
    <title>Espace administrateur | Historique kilométrique de votre véhicule</title>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta charset = "utf-8"/>
</head>

<link rel="stylesheet" href="css/espace.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&family=Lato:wght@300&display=swap" rel="stylesheet">

<header>
    <div class="header">
        <a class="logo" href="#">Carmeter</a>
        <div class = "headerRight">
            <a class="active" href="#">Accueil</a>
            <a href="infosVehicule.php">Vos informations</a>
            <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>
</header>

<body>
Bienvenue sur votre espace administrateur !
</body>

</html>

<?php
session_start();
require_once ('estConnecte.php');