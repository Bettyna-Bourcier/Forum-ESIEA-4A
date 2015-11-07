<?php
/*
 * action pour générer un mot de passe aléatoire
 *
 * parametres : POST
 *      identifiant => identifiant de l'utilisateur
 *      adresseEmail => email
 */

if (isset($_POST['mdpOublieSubmit'])) {
    /* On vérifie que l'utilisateur existe et qu'il a bien rentré ses informations. */
    if (!empty($_POST['identifiant']) AND !empty($_POST['adresseEmail']) AND file_exists("../utilisateurs/" . $_POST['identifiant'])) {

        $monFichier = fopen('../utilisateurs/' . $_POST['identifiant'] . '/info.txt', 'a+');

        $identifiant = trim(fgets($monFichier));
        $email = trim(fgets($monFichier));

        fclose($monFichier);
        /* Vérification de l'adresse email */
        if ($_POST['adresseEmail'] == $email) {
            $newMdp = generateRandomString(10);

            /* Changement du mot de passe dans le fichier info.txt */
            unlink('../utilisateurs/'.$_POST['identifiant'].'/mdp.txt');
            $monFichier = fopen('../utilisateurs/'.$_POST['identifiant'].'/mdp.txt','a+');
            fputs($monFichier,$newMdp);
            fclose($monFichier);


            echo "<p>Votre nouveau mot de passe est le suivant : ".$newMdp."</p>";
            echo "<p><a href='../vues/connexion.php'>retour vers la page de connexion</a>";
        } else {
            header('Location: ../vues/mdpOublie.php?erreur=true');
        }

    } else {
        header('Location: ../vues/mdpOublie.php?erreur=true');
    }
} else {
    header('Location: ../vues/mdpOublie.php?erreur=true');
}

 /* Fonction qui renvoie une chaine de caractère aléatoire. */
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}