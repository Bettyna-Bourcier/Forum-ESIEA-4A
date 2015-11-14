<?php
   
include_once('../connection_bdd.php');

// Insère le titre, l'user_id et le contenu du sujet créé dans la bdd 
function creation_sujet($titre, $contenu, $user_id)
{
    try {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO sujets (titre, contenu, utilisateurs_id) VALUES(?,?,?)');
        $req->execute(array($titre, $contenu, $user_id));
        header('Location:../vues/sujets.php');   
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

// Récupère tous les sujets créés
function recuperation_sujets()
{
    try {
        global $bdd;
        $req = $bdd->prepare('SELECT sujets.*, utilisateurs.identifiant FROM sujets JOIN utilisateurs ON sujets.utilisateurs_id = utilisateurs.id');
        $req->execute();
        $sujets = $req->fetchAll();
        return $sujets;
    } catch (Exception $ex) {
        die('Erreur : ' . $e->getMessage());
    }
}

// Récupère un sujet 
function recuperation_sujet($id)
{
    try {
        global $bdd;
        $req = $bdd->prepare('SELECT sujets.*, utilisateurs.identifiant, utilisateurs.signature, utilisateurs.image FROM sujets JOIN utilisateurs ON sujets.utilisateurs_id = utilisateurs.id WHERE sujets.id=?');
        $req->execute(array($id));
        $sujet = $req->fetch();
        return $sujet;
    } catch (Exception $ex) {
        die('Erreur : ' . $e->getMessage());
    }
}


// Supprime un sujet 
function supprimer_sujet($sujet_id)
{
    try {
        global $bdd;
        $req = $bdd->prepare('DELETE FROM sujets WHERE id=?');
        $req->execute(array($sujet_id));
    } catch (Exception $ex) {
        die('Erreur : ' . $e->getMessage());
    }
}