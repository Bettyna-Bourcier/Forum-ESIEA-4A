<?php
session_start();
include_once('../modele/admin.php');
include_once('../modele/sujets.php');
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8"/>
        <title>Connexion forum</title>
    </head>

    <body>
        <?php include_once('layouts/header.php'); ?>

        <div class="container">
            <h1>Utilisateurs actifs</h1>

            <form method="post" action="../controleur/admin.php">
                <div class="table-responsive">
                    <table class="table table-striped" border="2">
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

                        foreach ($utilisateurs_actifs as $utilisateur) {
                            if (canModify($utilisateur)) {
                                echo '<tr>';
                                echo '<td>' . $utilisateur['identifiant'] . '</td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[nom]" . '" value=' . $utilisateur['nom'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[prenom]" . '" value=' . $utilisateur['prenom'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[adresse_mail]" . '" value=' . $utilisateur['adresse_mail'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[adresse_mail_secours]" . '" value=' . $utilisateur['adresse_mail_secours'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[signature]" . '" value=' . $utilisateur['signature'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[image]" . '" value=' . $utilisateur['image'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[actif]" . '" value=' . $utilisateur['actif'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[admin]" . '" value=' . $utilisateur['admin'] . '></td>';
                                echo '<td>' . '<input type="text" name="' . $utilisateur['identifiant'] . "[super_admin]" . '" value=' . $utilisateur['super_admin'] . '></td>';
                                echo '</tr>';
                            } else {
                                echo '<tr>';
                                echo '<td>' . $utilisateur['identifiant'] . '</td>';
                                echo '<td>' . $utilisateur['nom'] . '</td>';
                                echo '<td>' . $utilisateur['prenom'] . '</td>';
                                echo '<td>' . $utilisateur['adresse_mail'] . '</td>';
                                echo '<td>' . $utilisateur['adresse_mail_secours'] . '</td>';
                                echo '<td>' . $utilisateur['signature'] . '</td>';
                                echo '<td>' . $utilisateur['image'] . '</td>';
                                echo '<td>' . $utilisateur['actif'] . '</td>';
                                echo '<td>' . $utilisateur['admin'] . '</td>';
                                echo '<td>' . $utilisateur['super_admin'] . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>

                    </table>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default" name="modification_submit">Valider</button>
                </div>

            </form>

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
            <ul>
                <?php
                $sujets = recuperation_sujets();
                foreach ($sujets as $sujet) {
                    echo'<li><a href="../vues/sujet.php?sujet= ' . $sujet['id'] . '">' . $sujet['titre'] . '</a> | <a href=\'../controleur/sujets.php?supprimer=' . $sujet['id'] . '\'>  Supprimer</a></li>';
                }
                ?>
            </ul>
        </div>
    </body>
</html>