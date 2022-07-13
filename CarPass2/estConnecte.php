<?php
class auth{
    static function logged_only(){
        if(!isset($_SESSION['username'])) {
            echo "Vous devez être connecté pour accéder à cette page";
            header('5,location:authentificationClient.php');
        }
    }
}

auth::logged_only();