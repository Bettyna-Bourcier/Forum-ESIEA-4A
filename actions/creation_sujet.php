<?php
/*
 * action [ADMIN] pour créer un sujet
 *
 * paramètres : POST
 *      nomSujet => titre du sujet à créer
 */

session_start();
include_once('../lib/utilisateur.php');

// on vérifie que l'utilisateur est un admin
if(isAdmin()) {

    $numero_sujet = dernier_numero_sujet() + 1;

    // on crée le fichier pour le nouveau sujet
    $monFichier = fopen('../sujets/sujet' .$numero_sujet . '.txt', 'a+');
    // on écrit le titre du sujet en premiere ligne
    fputs($monFichier, $_POST['nomSujet']);
    fclose($monFichier);

    header('Location: ../vues/admin.php');
} else {
    // si pas admin on redirige sur la page perso
    header('Location: ../vues/pagePerso.php?erreur=true');
}

// retourne le numero du dernier sujet (int)
function dernier_numero_sujet() {
    $sujets = scandir('../sujets');
    // on recupere le numero du dernier sujet
    $dernier_numero_sujet = substr($sujets[sizeof($sujets) - 1], -5, 1);

    return (int)$dernier_numero_sujet;
}