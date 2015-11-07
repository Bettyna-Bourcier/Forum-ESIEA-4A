<?php
    include('../modele/utilisateurs.php');

// On récupère les données saisies dans le formulaire d'inscription
   $identifiant = $_POST["pseudo"];
   $mdp = $_POST["mdp"];
   $mail = $_POST["mail"];
   $mdp_verification = $_POST["verifMdp"];

    if($mdp == $mdp_verification)
    {
      insert_informations_connection($identifiant,$mdp,$mail);

    }

?>