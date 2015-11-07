<?php
session_start();
include('../modele/utilisateurs.php');

// On récupère les données saisies dans le formulaire de connection
$identifiant = $_POST["pseudoIdentification"];
$mdp = $_POST["mdpIdentification"];

// Vérification des informations de connection de l'utilisateur
$utilisateur = connection_utilisateur($identifiant,$mdp);
if($utilisateur)
{
    // Si l'utilisateur existe, alors on met en session ses infos prises dans la bdd
    $_SESSION['identifiant'] = $utilisateur['identifiant'];
    $_SESSION['nom'] = $utilisateur['nom'];
    $_SESSION['prenom'] = $utilisateur['prenom'];
    $_SESSION['email'] = $utilisateur['adresse_mail'];
    $_SESSION['emailSecours'] = $utilisateur['adresse_mail_secours'];
    $_SESSION['textAreaSignature'] = $utilisateur['signature'];
    $_SESSION['age'] = $utilisateur['age'];
    $_SESSION['image'] = $utilisateur['image'];

    header('Location: ../vues/pagePerso.php');

}
else {
    header('Location: ../vues/connexion.php');
}

