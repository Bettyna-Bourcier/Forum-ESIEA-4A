<?php

include_once('../connection_bdd.php');

// Insère le contenu d'un post dans la bdd
function inserer_post($contenu, $sujet_id, $utilisateur_id) {
    try {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO post (contenu, sujets_id, utilisateurs_id) VALUES(?,?,?)');
        $req->execute(array($contenu, $sujet_id, $utilisateur_id));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

// Recupère en bdd tous les posts d'un sujet + utilisateur + signature
function recuperer_posts($sujet_id) {
    try {
        global $bdd;
        $req = $bdd->prepare('SELECT * FROM post JOIN utilisateurs ON post.utilisateurs_id = utilisateurs.id WHERE sujets_id=?');
        $req->execute(array($sujet_id));
        $posts = $req->fetchAll();
        return $posts;
    } catch (Exception $ex) {
        die('Erreur : ' . $e->getMessage());
    }
}
