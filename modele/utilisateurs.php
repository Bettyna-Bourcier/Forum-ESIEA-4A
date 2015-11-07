<?php

include_once('../connection_bdd.php');


// On insère les informations rentrées dans le formulaire d'inscription dans la base de donnée
function insert_informations_connection($identifiant, $mdp, $mail)
{
    try {
        global $bdd; // On récupère l'objet $bdd représentant la connection à la base
        $req = $bdd->prepare('INSERT INTO utilisateurs (identifiant, mot_de_passe, adresse_mail) VALUES(?,?,?)');
        $req->execute(array($identifiant,$mdp,$mail));
        header('Location: ../vues/connexion.php');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

}



// Vérifie si l'utilisateur existe dans la bdd
function connection_utilisateur($identifiant, $mdp)
{
    try {

        global $bdd;
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE identifiant=? AND mot_de_passe=?');
        $req->execute(array($identifiant,$mdp));
        $utilisateur = $req->fetchAll();

        if(empty($utilisateur))
        {
            return false;
        }
        else{
            return $utilisateur[0];
        }
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}



// Vérifie si les infos rentrées dans le formulaire de mdp oublié sont correctes et renvoie un boolean
function mdp_oublie_verification($identifiant,$mail)
{
    try {
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE identifiant=? AND adresse_mail=?');
        $req->execute(array($identifiant,$mail));
        $utilisateur = $req->fetchAll();

        if(empty($utilisateur))
        {
            return false;
    }
        else
        {
            return true;
        }
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

}


// On change le mdp de l'utilisateur
function modification_mdp($identifiant,$mdp)
{
    try {
        global $bdd; // On récupère l'objet $bdd représentant la connection à la base
        $req = $bdd->prepare('UPDATE utilisateurs SET mot_de_passe=? WHERE identifiant=?;');
        $req->execute(array($mdp,$identifiant));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
}



// Ajoute/modifie les infos personnelles du formulaire dans la bdd
function modification_infos_perso($mail,$mail_secours,$nom,$prenom,$age,$identifiant)
{
    try{
        global $bdd;
        $req = $bdd->prepare('UPDATE utilisateurs SET adresse_mail=?, adresse_mail_secours=?, nom=?, prenom=?, age=? WHERE identifiant=?;');
        $req->execute(array($mail,$mail_secours,$nom,$prenom,$age,$_SESSION['identifiant']));
    }
    catch(Exception $e)
    {
        die('Erreur : ' .$e->getMessage());
    }
}


// Modifie la signature dans la bdd

function modification_signature($identifiant,$signature)
{
    try{
        global $bdd;
        $req = $bdd->prepare('UPDATE utilisateurs SET signature=? WHERE identifiant=?;');
        $req->execute(array($signature,$identifiant));
    }
    catch(Exception $e)
    {
        die('Erreur : ' .$e->getMessage());
    }
}


// Stock le chemin de l'image sur le disque dur
function emplacement_image($identifiant, $image)
{
    try{
        global $bdd;
        $req = $bdd->prepare('UPDATE utilisateurs SET image=? WHERE identifiant=?;');
        $req->execute(array($image,$identifiant));
    }
    catch(Exception $e)
    {
        die('Erreur : ' .$e->getMessage());
    }
}