<?php
session_start();
include_once('../lib/utilisateur.php');
if(isConnected()) {
    header('Location: ../vues/pagePerso.php');
}
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8"/>
    <title>Connexion forum</title>
</head>

<body>
<?php 
    include_once('layouts/header.php');
    $pseudo = '';
    if(isset($_COOKIE['pseudo'])) {
        $pseudo = $_COOKIE['pseudo'];
    }

?>
<p>

<h3>Connection au forum</h3></p>

<!-- Formulaire permettant de remplir les informations obligatoires pour la connection au forum.-->
<form method='POST' action="../controleur/connexion.php">
    <p>Veuillez remplir les informations suivantes pour pouvoir vous connecter au forum.</p>

    <p>Identifiant :
        <input type='text' name='pseudoIdentification' value=<?php echo $pseudo ?>></p>


    <p>Mot de passe:
        <input type='password' name='mdpIdentification'></p>

    <input type="submit" name="connectionBouton" action="">


</form>

<p>Mot de passe oublié ? <a href="../vues/mdpOublie.php">Cliquez ici</a></p>
<p>Pas encore inscrit ? <a href="../vues/inscription.php">Cliquez ici</a> </p>

</body>

</html>