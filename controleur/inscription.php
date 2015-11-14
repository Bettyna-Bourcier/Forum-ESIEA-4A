<?php
    include('../modele/utilisateurs.php');

// On récupère les données saisies dans le formulaire d'inscription
   $identifiant = $_POST["pseudo"];
   $mdp = $_POST["mdp"];
   $mail = $_POST["mail"];
   $mdp_verification = $_POST["verifMdp"];

    if(!empty($mdp) && !empty($identifiant) && !empty($mail) && !empty($mdp_verification) && $mdp == $mdp_verification)
    {
      insert_informations_connection($identifiant,$mdp,$mail);

      header('Location: ../vues/connexion.php');
    } else {
        header('Location: ../vues/inscription.php?erreur=inscription');
    }

?>