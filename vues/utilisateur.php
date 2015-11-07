<?php
session_start();
include_once('../lib/utilisateur.php');

// on vérifie que l'utilisateur est admin
if(isAdmin()){

if(file_exists("../utilisateurs/".$_GET['utilisateur']."/info.txt")) {
    $monFichier = fopen("../utilisateurs/".$_GET['utilisateur']."/info.txt", "r");

    /* On stock les lignes du fichier info.txt dans un tableau. */
    $infos = Array();
    while ($ligne = fgets($monFichier)) {
        $infos[] = trim($ligne); /* trim => supprime les espaces en trop en début et fin de chaine */
    }

    fclose($monFichier);
}
} else {
    header('Location: ../vues/pagePerso.php?erreur=true');
}
?>
    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8"/>
        <title>Forum PHP</title>

    </head>

    <body>
<?php include_once('layouts/header.php'); ?>

<form method="POST" action="../actions/utilisateur.php?utilisateur=<?php echo $_GET['utilisateur'] ?>">
    <h3>Changer les informations personnelles de <?php echo $_GET['utilisateur'] ?></h3>

    <p>Adresse email: <input type="text" name="email" value=<?php echo $infos[1]?>></p>
    <p>Adresse email de secours: <input type="text" name="emailSecours"  value=<?php echo $infos[2]?>>
    <p>Nom: <input type="text" name="nom"  value=<?php echo $infos[3]?>></p>
    <p>Prénom: <input type = "text" name="prenom"  value=<?php echo $infos[4]?>></p>
    <p>Age: <input type="text" name="age"  value=<?php echo $infos[5]?>></p>
    <p><input type="submit" name="boutonModif"></p>

</form>

    </body>
</html>
