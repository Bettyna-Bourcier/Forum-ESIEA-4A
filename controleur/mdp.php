<?php
session_start();
include_once('../modele/utilisateurs.php');

// On récupère les données saisies dans le formulaire de mdp oublié
$identifiant = $_POST['identifiant'];
$mail = $_POST['adresseEmail'];

// Vérification des informations rentrées dans le formulaire
if (mdp_oublie_verification($identifiant,$mail) == true) {

    $newMdp = generateRandomString(10);
    modification_mdp($identifiant,$newMdp);
    $_SESSION['new_mdp'] = $newMdp;   
    header('Location: ../vues/nouveau_mdp.php');
} else {
    header('Location: ../vues/mdpOublie.php?erreur=true');
}


/* Fonction qui renvoie une chaine de caractère aléatoire. */
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}