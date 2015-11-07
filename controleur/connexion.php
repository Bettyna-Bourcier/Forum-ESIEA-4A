<?php
session_start();
include('../modele/utilisateurs.php');

// On récupère les données saisies dans le formulaire de connexion
$identifiant = $_POST["pseudoIdentification"];
$mdp = $_POST["mdpIdentification"];

// Vérification des informations de connexion de l'utilisateur
$utilisateur = connection_utilisateur($identifiant,$mdp);
if($utilisateur)
{
    // Si l'utilisateur existe, alors on met en session ses infos prises dans la bdd
    $_SESSION['identifiant'] = $utilisateur['identifiant'];
    
    header('Location: ../vues/pagePerso.php');
}
else {
    header('Location: ../vues/connexion.php');
}

