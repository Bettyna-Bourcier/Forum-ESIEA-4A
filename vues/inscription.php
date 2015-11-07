<?php
/**
 * Created by PhpStorm.
 * User: Bettyna
 * Date: 12/09/2015
 * Time: 13:54
 */
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8"/>
    <title>Connexion forum</title>
</head>
<body>
<?php include_once('layouts/header.php'); ?>
<p><h3>Inscription</h3></p>
<form method="POST" action="../controleur/inscription.php">
    <p>Renseignements obligatoires :</p>

    <p>Identifiant :
        <input type="text" name="pseudo":/></p>


    <p>Mot de passe:
        <input type="text" name="mdp":/></p>

    <p>Vérification du mot de passe:
        <input type="text" name="verifMdp":/></p>

    <p>Adresse email: :
        <input type="text" name="mail":/></p>

    <p><input type="submit" name="validate" /></p>
</form>
</body>
</html>