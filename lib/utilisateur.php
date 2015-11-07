<?php
    function isAdmin() {
        return isset($_SESSION['pseudo']) AND
            file_exists("../utilisateurs/".$_SESSION['pseudo']."/is_admin.txt");
    }

function isConnected() {
    return isset($_SESSION['identifiant']);
}

function isActif() {
    return isset($_SESSION['pseudo']) AND file_exists('../utilisateurs/'.$_SESSION['pseudo'].'/is_actif.txt');
}