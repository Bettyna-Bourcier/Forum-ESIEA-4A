<?php
/*
 * action d'inscription
 *
 * parametres : POST
 *      pseudo => pseudo de l'utilisateur
 *      mail   => email de l'utilisateur
 */

if(is_form_valid())
{
    /* Création d'un dossier pour l'utilisateur si celui-ci n'existe pas.*/
    if(!file_exists("../utilisateurs/".$_POST['pseudo']))
    {
        mkdir("../utilisateurs/".$_POST['pseudo']);

        /* Création d'un fichier dans le dossier de l'utilisateur.*/
        $monFichier = fopen("../utilisateurs/".$_POST["pseudo"]."/info.txt",'a+');

        fputs($monFichier, $_POST["pseudo"].PHP_EOL); /* PHP_EOL => saut à la ligne selon les OS*/
        fputs($monFichier, $_POST["mail"].PHP_EOL);
        fputs($monFichier, ''.PHP_EOL); // email de secours
        fputs($monFichier, ''.PHP_EOL); // nom
        fputs($monFichier, ''.PHP_EOL); // prenom
        fputs($monFichier, ''.PHP_EOL); // age
        fclose($monFichier);

        /* création du fichier pour le mot de passe */
        $monFichier = fopen("../utilisateurs/".$_POST["pseudo"]."/mdp.txt",'a+');
        fputs($monFichier, $_POST["mdp"]);
        fclose($monFichier);

        header('Location: ../vues/connexion.php');
    } else {
        header('Location: ../vues/inscription.php?erreur=true'); /* Redirige vers la page inscription.php */
    }

} else {
    header('Location: ../vues/inscription.php?erreur=true');
}

/**
 * Vérifie si le formulaire d'inscription est valide.
 * @return bool
 */



function is_form_valid()
{
    return isset($_POST['pseudo']) AND !empty($_POST['pseudo']) AND isset($_POST['mdp']) AND !empty($_POST['mdp']) AND isset($_POST['verifMdp']) AND isset($_POST['mail']) AND !empty($_POST['mail'])AND $_POST['mdp'] == $_POST['verifMdp'];
}