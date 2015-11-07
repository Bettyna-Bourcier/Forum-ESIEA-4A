<?php
session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8"/>
    <title>Mot de passe oublié</title>

</head>

<body>
<?php include_once('layouts/header.php'); ?>
<!--Formulaire permettant le changement de mot de passe en cas d'oublie.-->
    <form action="../controleur/mdp.php" method="POST">
        <p>Rentrez votre identifiant et votre adresse email afin de changer de mot de passe.</p>
        <p>Identifiant:<input type="text" name="identifiant"></p>
        <p>Adresse email:<input type="text" name="adresseEmail"></p>
        <input type="submit" name="mdpOublieSubmit">
    </form>


</body>

</html>