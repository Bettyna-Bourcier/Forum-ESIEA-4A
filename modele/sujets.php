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


function recuperation_sujets()
{
    try {
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM sujets');
        $req->execute();
        $sujets = $req->fetchAll();
        return $sujets;
    } catch (Exception $ex) {
        die('Erreur : ' . $e->getMessage());
    }
}