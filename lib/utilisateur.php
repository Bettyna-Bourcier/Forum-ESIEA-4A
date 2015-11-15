<?php
function isAdmin() {
    return isset($_SESSION['identifiant']) AND
        is_admin($_SESSION['identifiant']);
}

function isSuperAdmin() {
    return isset($_SESSION['identifiant']) AND
            is_super_admin($_SESSION['identifiant']);
}

function isConnected() {
    return isset($_SESSION['identifiant']);
}

function isActif() {
    return isset($_SESSION['identifiant']) AND is_actif($_SESSION['identifiant']);
}

function canModify($utilisteur) {
    if(isSuperAdmin()) {
        return true;
    } elseif(isAdmin() && $utilisteur['admin'] != true) {
        return true;
    }
}

// retourne une url avec un timestamp pour eviter le cache navigateur
function imageUrlWithTime($imageUrl) {
    return "$imageUrl?" . time();
}
   