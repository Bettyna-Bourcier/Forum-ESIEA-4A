<?php
/*
 * action [ADMIN] pour changer les infos d'un utilisateur
 *
 *  parametres : POST
 *      email
 *      emailSecours
 *      nom
 *      prenom
 *      age
 *
 *  parametres : GET
 *      utilisateur => pseudo de l'utilisateur à modifier
 */

session_start();
include_once('../lib/utilisateur.php');

// on vérifie que l'utilisateur est admin
if(isAdmin()){
    unlink("../utilisateurs/".$_GET['utilisateur']."/info.txt");

    // on réécrit les nouvelles infos
    $monFichier = fopen('../utilisateurs/'.$_GET['utilisateur'].'/info.txt', 'a+');

    fputs($monFichier, $_GET['utilisateur'].PHP_EOL); /* PHP_EOL => saut à la ligne selon les OS */
    fputs($monFichier, $_POST["email"].PHP_EOL);
    fputs($monFichier, $_POST['emailSecours'].PHP_EOL); // email de secours
    fputs($monFichier, $_POST['nom'].PHP_EOL); // nom
    fputs($monFichier, $_POST['prenom'].PHP_EOL); // prenom
    fputs($monFichier, $_POST['age'].PHP_EOL); // age
    fclose($monFichier);

    header('Location: ../vues/admin.php');
} else {
    header('Location: ../vue/pagePerso.php?erreur=true');
}

