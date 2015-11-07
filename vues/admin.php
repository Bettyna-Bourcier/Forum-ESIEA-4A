<?php
session_start();
include_once('../modele/admin.php');

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8"/>
    <title>Connexion forum</title>
</head>

<body>
<?php include_once('layouts/header.php'); ?>
<h1>Utilisateurs actifs</h1>
<ul>

    <form method="post" action="../controleur/admin.php">


        <table border="2" class="table">
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse mail</th>
                <th>Adresse mail de secours</th>
                <th>Signature</th>
                <th>Image</th>
                <th>Actif</th>
                <th>Admin</th>
                <th>Super Admin</th>

            </tr>


            <?php
            $utilisateurs_actifs = recuperer_utilisateurs(1);
//            foreach ($utilisateurs_actifs as $utilisateur) {
//                echo '<tr>';
//                echo '<td>' . '<input type="text" name="identifiant[' . $utilisateur['id'] . ']" value=' . $utilisateur['identifiant'] . '></td>';
//                echo '<td>' . '<input type="text" name="nom[' . $utilisateur['id'] . ']" value=' . $utilisateur['nom'] . '></td>';
//                echo '<td>' . '<input type="text" name="prenom[' . $utilisateur['id'] . ']" value=' . $utilisateur['prenom'] . '></td>';
//                echo '<td>' . '<input type="text" name="adresse_mail[' . $utilisateur['id'] . ']" value=' . $utilisateur['adresse_mail'] . '></td>';
//                echo '<td>' . '<input type="text" name="adresse_mail_secours[' . $utilisateur['id'] . ']" value=' . $utilisateur['adresse_mail_secours'] . '></td>';
//                echo '<td>' . '<input type="text" name="signature[' . $utilisateur['id'] . ']" value=' . $utilisateur['signature'] . '></td>';
//                echo '<td>' . '<input type="text" name="image[' . $utilisateur['id'] . ']" value=' . $utilisateur['image'] . '></td>';
//                echo '<td>' . '<input type="text" name="actif[' . $utilisateur['id'] . ']" value=' . $utilisateur['actif'] . '></td>';
//                echo '<td>' . '<input type="text" name="admin[' . $utilisateur['id'] . ']" value=' . $utilisateur['admin'] . '></td>';
//                echo '<td>' . '<input type="text" name="super_admin[' . $utilisateur['id'] . ']" value=' . $utilisateur['super_admin'] . '></td>';
//                echo '</tr>';
//            }





            foreach ($utilisateurs_actifs as $utilisateur) {
                echo '<tr>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[identifiant]" . '" value=' . $utilisateur['identifiant'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[nom]" . '" value=' . $utilisateur['nom'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[prenom]" . '" value=' . $utilisateur['prenom'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[adresse_mail]" . '" value=' . $utilisateur['adresse_mail'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[adresse_mail_secours]" . '" value=' . $utilisateur['adresse_mail_secours'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[signature]" . '" value=' . $utilisateur['signature'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[image]" . '" value=' . $utilisateur['image'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[actif]" . '" value=' . $utilisateur['actif'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[admin]" . '" value=' . $utilisateur['admin'] . '></td>';
                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant']."[super_admin]" . '" value=' . $utilisateur['super_admin'] . '></td>';
                echo '</tr>';
            }
            ?>

        </table>
        <input type="submit" name="modification_submit">
    </form>

</ul>

<h1>Utilisateurs à valider</h1>
<ul>
    <?php

    $utilisateurs_a_valider = recuperer_utilisateurs(0);
    // on affiche les utilisateurs a valider
    foreach ($utilisateurs_a_valider as $utilisateur) {
        ?>
        <li><?php echo $utilisateur['identifiant'] ?>
            <a href="../controleur/admin.php?pseudo=<?php echo $utilisateur['identifiant'] ?>">
                Activer
            </a>
        </li>
        <?php
    }
    ?>
</ul>

<h1>Sujets</h1>
<!-- Liste de tous les sujets -->
<?php
$sujets = scandir('../sujets'); // on récupère tous les fichiers dans le dossiers sujets
?>
<ul>
    <?php
    // les deux premiers elements du tableau sont [., ..] => on les ignore
    //on parcourt les sujets pour afficher leur titre (1ere ligne du fichier)
    for ($i = 2; $i < sizeof($sujets); $i++) {
        $monFichier = fopen('../sujets/' . $sujets[$i], 'r');
        ?>
        <li>
            <a href="sujet.php?sujet=<?php echo $sujets[$i] ?>"><?php echo fgets($monFichier) ?></a>
            <!-- lien de supression -->
            <a href="../actions/supprimer_sujet.php?sujet=<?php echo $sujets[$i] ?>">Supprimer</a>
        </li>
        <?php
        fclose($monFichier);
    }
    ?>
</ul>

<h2>Création d'un sujet</h2>

<form action="../actions/creation_sujet.php" method="post">
    <input type="text" name="nomSujet">
    <input type="submit">
</form>
</body>
</html>