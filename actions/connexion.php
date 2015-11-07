<?php
/*
 * action de connexion
 *
 * parametres : POST
 *      pseudoIdentification => pseudo de l'utilisateur souhaitant s'identifier
 *      mdpIdentification    => mot de passe soumis
 *
 */

session_start();
/* Vérification des informations de connexion de l'utilisateur */
    if(file_exists("../utilisateurs/".$_POST['pseudoIdentification']."/mdp.txt"))
    {
        $monFichier = fopen('../utilisateurs/'.$_POST['pseudoIdentification']."/mdp.txt", "r");
        $mdp = fgets($monFichier);
        fclose($monFichier);

        if($_POST['mdpIdentification'] == $mdp) { // mot de passe OK
            if(file_exists("../utilisateurs/".$_POST['pseudoIdentification']."/info.txt"))
            {

                $infos = infos_utilisateur($_POST['pseudoIdentification']);
                setcookie('pseudo',$_POST['pseudoIdentification'], time()+365*24*3600,'/',null,false,true);

                $_SESSION['pseudo'] = $infos[0];
                $_SESSION['email'] = $infos[1];
                $_SESSION['emailSecours'] = $infos[2];
                $_SESSION['nom'] = $infos[3];
                $_SESSION['prenom'] = $infos[4];
                $_SESSION['age'] = $infos[5];

                if(file_exists('../utilisateurs/'.$_POST['pseudoIdentification'].'/signature.txt')) {
                    // si signature existe on la met en session
                    $_SESSION['textAreaSignature'] = file_get_contents('../utilisateurs/'.$_POST['pseudoIdentification'].'/signature.txt');
                } else {
                    // sinon signature en session = ''
                    $_SESSION['textAreaSignature'] = '';
                }

                header('Location: ../vues/pagePerso.php');
            } else {
                // fichier info n'existe pas pour l'utilisateur => anormal
                header('Location: ../vues/pagePerso.php?erreur=true&message=fichier info inexistant');
            }
        } else { // mot de passe incorect
            header('Location: ../vues/connexion.php?erreur=true&message=mot de passe incorrect');
        }
    } else { // l'utilisateur n'existe pas
        header('Location: ../vues/connexion.php?erreur=true&message=utilisateur inexistant');
    }

/*
 * Retourne un tableau contenant les infos de l'utilisateur
 *      0 => pseudo
 *      1 => email
 *      2 => email de secours
 *      3 => nom
 *      4 => prenom
 *      5 => age
 */
function infos_utilisateur($nom_utilisateur) {
    $monFichier = fopen('../utilisateurs/'.$nom_utilisateur."/info.txt", "r");

    /* On stock les lignes du fichier info.txt dans un tableau. */
    $infos = Array();
    while($ligne = fgets($monFichier)) {
        $infos[] = trim($ligne); /* trim => supprime les espaces en trop en début et fin de chaine */
    }

    fclose($monFichier);

    return $infos;
}

?>