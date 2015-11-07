<?php

include_once('../connection_bdd.php');


// Permet de savoir si l'utilisateur est super admin ou non => boolean
function is_super_admin($identifiant)
{
    global $bdd;
    $req = $bdd->prepare('SELECT super_admin FROM utilisateurs WHERE identifiant = $identifiant');
    $req->execute(array($identifiant));

    if ($req == true) {
        return true;
    } else {
        return false;
    }
}


// Permet de savoir si l'utilisateur est admin => boolean
function is_admin($identifiant)
{
    try {
        global $bdd;
        $req = $bdd->prepare('SELECT admin FROM utilisateurs WHERE identifiant = ?');
        $req->execute(array($identifiant));
        $admin = $req->fetchAll(PDO::FETCH_COLUMN, 0); // Récupère la valeur de la première colonne

        if ($admin[0] == 1) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function is_actif($identifiant) {
        try {
        global $bdd;
        $req = $bdd->prepare('SELECT actif FROM utilisateurs WHERE identifiant = ?');
        $req->execute(array($identifiant));
        $admin = $req->fetchAll(PDO::FETCH_COLUMN, 0); // Récupère la valeur de la première colonne

        if ($admin[0] == 1) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

// On récupère tous les utilisateurs actifs ou non actif selon $actif dans la bdd
function recuperer_utilisateurs($actif = 1)
{
    try {
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM utilisateurs WHERE actif=?');
        $req->execute(array($actif));
        $utilisateurs = $req->fetchAll();
        return $utilisateurs;

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


// Change la colonne "actif" de l'utilisateur
function active_utilisateur($identifiant)
{
    try {
        global $bdd;
        $req = $bdd->prepare('UPDATE utilisateurs SET actif=? WHERE identifiant=?');
        $req->execute(array(1,$identifiant));

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


// Met à jour tout le tableau des utilisateurs actifs dans la bdd
function modifier_utilisateur($identifiant,$nom,$prenom,$adresse_mail,$adresse_mail_secours,$actif,$signature,$admin,$image)
{
    try {
        global $bdd;
        $req = $bdd->prepare('UPDATE utilisateurs SET nom=?, prenom=?,adresse_mail=?, adresse_mail_secours=?, actif=?, signature=?, admin=?, image=? WHERE identifiant=?');
        $req->execute(array($nom,$prenom,$adresse_mail,$adresse_mail_secours,$actif,$signature,$admin,$image,$identifiant));

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
