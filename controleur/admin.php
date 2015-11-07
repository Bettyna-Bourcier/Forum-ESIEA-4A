<?php
include_once("../modele/admin.php");
session_start();



if(validating_user())
{
    active_utilisateur($_GET['pseudo']);
    header('Location: ../vues/admin.php');
}elseif(modifying_users())
{
    var_dump($_POST);
    foreach ($_POST as $utilisateur) {
        if(is_array($utilisateur)) {
             modifier_utilisateur($utilisateur['identifiant'], $utilisateur['nom'], $utilisateur['prenom'], $utilisateur['adresse_mail'], $utilisateur['adresse_mail_secours'], $utilisateur['actif'], $utilisateur['signature'], $utilisateur['admin'], $utilisateur['image']);
        }
           
    }




}

function validating_user() {
    return isset($_GET['pseudo']);
}

function modifying_users() {
    return isset($_POST['modification_submit']);
}
