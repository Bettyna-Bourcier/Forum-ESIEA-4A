<?php
session_start();
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8"/>
        <title>Forum PHP</title>

    </head>

    <body>

        <?php
        include_once('layouts/header.php');
        include_once('../modele/sujets.php');
        include_once('../modele/post.php');

        $sujet = recuperation_sujet($_GET['sujet']);
        echo '<p>' . $sujet['titre'] . '</p>';
        echo '<p>Sujet créé par : ' . $sujet['identifiant'] . '</p>';
        echo '<p>Contenu : ' . $sujet['contenu'] . '</p>';
        echo '<p>'.$sujet['signature'].'</p>';
        
        $posts = recuperer_posts($sujet['id']);
        foreach($posts as $post)
        {
            echo '<p>'.$post['identifiant'].'</p>';
            echo '<p>'.$post['contenu'].'</p>';
            echo '<p>'.$post['signature'].'</p>';
        }

        /* Si l'utilisateur est connecté au forum et actif alors il peut répondre au sujet */
        if (isActif()) {
            ?>
            <h1>Vous pouvez répondre :</h1>
            <form action="../controleur/post.php?sujet=<?php echo $_GET['sujet'] ?>" method="POST">

                <textarea name="contenu" id="1" cols="30" rows="10"></textarea>
                <input type="submit" name="textAreaSubmit">
            </form>
            <?php
        }
        ?>



    </body>

</html>