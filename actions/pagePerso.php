<?php
/*
 * actions pour
 *      uploader une image de profil
 *          parametres : POST
 *              file
 *
 *      modifier les informations de son compte
 *          paramtres : POST
 *              email
 *              emailSecours
 *              nom
 *              prenom
 *              age
 *
 *      modifier mot de passe
 *          parametres : POST
 *              mdpModif
 *              verifMdpModif
 *
 *      modification de la signature
 *          parametres : POST
 *              textAreaSignature
 */
session_start();

if(isset($_POST['imageSubmit'])) { // formulaire d'upload d'image

    $finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à l'extension mimetype
    if(finfo_file($finfo, $_FILES['file']['tmp_name']) == 'image/jpeg') { // on accepte que les images jpeg
        move_uploaded_file($_FILES['file']['tmp_name'],"../utilisateurs/".$_SESSION['pseudo'].'/photo.jpeg');
        header('Location: ../vues/pagePerso.php');
    } else {
        header('Location: ../vues/pagePerso.php?erreur=true');
    }

} elseif(isset($_POST['boutonModif'])) { // formulaire de modification des infos du compte
    // on supprime l'ancien fichier info.txt
    unlink("../utilisateurs/".$_SESSION['pseudo']."/info.txt");

    // on réécrit les nouvelles infos
    $monFichier = fopen('../utilisateurs/'.$_SESSION['pseudo'].'/info.txt', 'a+');

    fputs($monFichier, $_SESSION["pseudo"].PHP_EOL); /* PHP_EOL => saut à la ligne selon les OS */
    fputs($monFichier, $_POST["email"].PHP_EOL);
    fputs($monFichier, $_POST['emailSecours'].PHP_EOL); // email de secours
    fputs($monFichier, $_POST['nom'].PHP_EOL); // nom
    fputs($monFichier, $_POST['prenom'].PHP_EOL); // prenom
    fputs($monFichier, $_POST['age'].PHP_EOL); // age
    fclose($monFichier);

    // on met les infos dans la session
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['emailSecours'] = $_POST['emailSecours'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['age'] = $_POST['age'];

    header('Location: ../vues/pagePerso.php');

}elseif(isset($_POST['mdpModifSubmit'])) { // formulaire de changement de mote de passe
    // si mdp nn vide et confirmation = mot de passe
    if($_POST['mdpModif'] == $_POST['verifMdpModif'] AND !empty($_POST['mdpModif'])) {
        // on supprime l'ancien mot de passe
        unlink("../utilisateurs/".$_SESSION['pseudo']."/mdp.txt");

        // on crée le ficheir pour le nouveau mot de passe
        $monFichier = fopen("../utilisateurs/".$_SESSION['pseudo']."/mdp.txt",'a+');
        fputs($monFichier, $_POST['mdpModif']);
        fclose($monFichier);

        header('Location: ../vues/pagePerso.php');
    } else {
        header('Location: ../vues/pagePerso.php?erreur=true');
    }

} elseif(isset($_POST['signatureSubmit'])) {
    if(file_exists('../utilisateurs/'.$_SESSION['pseudo'].'/signature.txt')) {
        /* On supprime l'ancienne signature */
        unlink('../utilisateurs/' . $_SESSION['pseudo'] . '/signature.txt');
    }
        $monFichier = fopen('../utilisateurs/'.$_SESSION['pseudo'].'/signature.txt', 'a+');
        fputs($monFichier, $_POST['textAreaSignature']);
        $_SESSION['textAreaSignature'] = $_POST['textAreaSignature'];
        fclose($monFichier);
        header('Location: ../vues/pagePerso.php');
}
?>