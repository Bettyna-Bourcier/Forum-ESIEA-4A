<?php
include_once("../modele/utilisateurs.php");

session_start();


if (isset($_POST['boutonModif'])) // Formulaire de modification des infos du compte
{
    // On récupère les infos remplies dans le formulaire d'infos personnelles
    $adresse_mail = $_POST['email'];
    $adresse_mail_secours = $_POST['emailSecours'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['emailSecours'] = $_POST['emailSecours'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['age'] = $_POST['age'];


    // On ajoute/modifie les infos dans la bdd
    modification_infos_perso($adresse_mail, $adresse_mail_secours, $nom, $prenom, $age, $identifiant);
    header('Location: ../vues/pagePerso.php');
} elseif (isset($_POST['mdpModifSubmit'])) { // Formulaire de changement de mdp
    // On récupère les infos dans le formulaire de mdp
    $mdp = $_POST['mdpModif'];
    $mdpVerif = $_POST['verifMdpModif'];

    if ($mdp == $mdpVerif) {
        modification_mdp($_SESSION['identifiant'], $mdp);
        header('Location: ../vues/pagePerso.php');
    }
} elseif (isset($_POST['signatureSubmit'])) { // Formulaire de signature
    $signature = $_POST['textAreaSignature'];
    $_SESSION['textAreaSignature'] = $_POST['textAreaSignature'];
    modification_signature($_SESSION['identifiant'], $signature);
    header('Location: ../vues/pagePerso.php');

} elseif (isset($_POST['imageSubmit'])) // Formulaire d'upload de l'image
{
    $finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime de l'extension mimetype
    if (finfo_file($finfo, $_FILES['file']['tmp_name']) == 'image/jpeg') // On accepte que les images jpeg
    {
        // Taille de l'image <= 150x150 et <= 2Mo
        if(getimagesize($_FILES['file']['tmp_name'])[0] <= 150 && getimagesize($_FILES['file']['tmp_name'])[1] <= 150 && filesize($_FILES['file']['tmp_name']) <= 2097152) {
            mkdir("../utilisateurs/".$_SESSION['identifiant']);
            $emplacement_image = "../utilisateurs/" . $_SESSION['identifiant'] . '/image.jpeg';
            move_uploaded_file($_FILES['file']['tmp_name'], $emplacement_image);
            emplacement_image($_SESSION['identifiant'], $emplacement_image); // Enregistrement de l'emplacement de l'image dans la bdd
            header('Location: ../vues/pagePerso.php');
        } else
        {
            header('Location: ../vues/pagePerso.php?erreur=image_size');
        }
    }
   
} else {
    header('Location: ../vues/pagePerso.php?erreur=true');
}
