<?php
session_start();
if(!isset($_SESSION['identifiant'])) { // on redirige sur la page de connexion si pas connecté
    header('Location: ../vues/connexion.php?erreur=true&message=pas connecte');
}
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8"/>
    <title>Espace personnel</title>
</head>

<body>
<?php include_once('layouts/header.php') ?>

<p><h3>Bienvenue sur votre espace personnel : <?php echo $_SESSION['identifiant']; ?></h3></p>

<?php
    if(file_exists('../utilisateurs/'.$_SESSION['pseudo'].'/is_actif.txt')) {
        echo '<p>Votre compte est validé.</p>';
    } else {
        echo '<p>Votre inscription au forum doit être valider par les administrateurs.</p>';
    }
?>

<?php // si une photo est présente pour l'utilsateur, on l'affiche
if(file_exists('../utilisateurs/'.$_SESSION['identifiant'].'/image.jpeg')) {
    echo "<img src='../utilisateurs/".$_SESSION['identifiant']."/image.jpeg' />";
}
?>

<!--Ajout d'une image de profil-->
<form action="../controleur/pagePerso.php" method="POST" enctype="multipart/form-data">

    <input type="file" name="file">
    <input type="submit" name="imageSubmit">

</form>

<!--Ajout d'une signature-->

<form action="../controleur/pagePerso.php" method="POST">

    <h3>Changer ma signature</h3>
    <textarea name="textAreaSignature"><?php echo $_SESSION['textAreaSignature'] ?></textarea>
    <input type="submit" name="signatureSubmit">

</form>


<!-- Modification des informations personnelles de l'utilisateur -->
<form method="POST" action="../controleur/pagePerso.php">
    <h3>Changer mes informations personnelles</h3>

    <p>Adresse email: <input type="text" name="email" value=<?php echo $_SESSION['email']?>></p>
    <p>Adresse email de secours: <input type="text" name="emailSecours"  value=<?php echo $_SESSION['emailSecours']?>>
    <p>Nom: <input type="text" name="nom"  value=<?php echo $_SESSION['nom']?>></p>
    <p>Prénom: <input type = "text" name="prenom"  value=<?php echo $_SESSION['prenom']?>></p>
    <p>Age: <input type="text" name="age"  value=<?php echo $_SESSION['age']?>></p>
    <p><input type="submit" name="boutonModif"></p>

</form>

<h3>Changer mon mot de passe</h3>
<form method="POST" action="../controleur/pagePerso.php">
    <p>Mot de passe: <input type="text" name="mdpModif"></p>
    <p>Vérification de mot de passe: <input type="text" name="verifMdpModif"></p>
    <p><input type="submit" name="mdpModifSubmit"></p>
</form>

</body>

</html>