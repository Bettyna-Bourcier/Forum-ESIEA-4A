<?php
session_start();
?>

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
        ?>
        <div class="container">
            <?php
            $sujet = recuperation_sujet($_GET['sujet']);
           
            echo '<ul class="media-list">'
            . '<li class="media">'
            . '<div class="media-left media-top">'
                    . '<img class="media-object" width="100" height="100" src="'.$sujet['image'].'">'
            . '</div>'
            . '<div class="media-body">'
                    . '<h3 class="media-heading">'. $sujet['titre'].'<small> par '.$sujet['identifiant'].'</small> </h3>'
                    . '<p>' . $sujet['contenu'] . '</p>'
                    . '<blockquote>'
                        . '<p><small>' . $sujet['signature'] . '</small></p>'
                    . '</blockquote>';
            
            $posts = recuperer_posts($sujet['id']);
            foreach ($posts as $post) {
                           
                echo '<div class="media">'
            . '<div class="media-left media-top">'
                    . '<img class="media-object" width="100" height="100" src="'.$post['image'].'">'
                    . '</div>'
                    . '<div class="media-body">'
                    . '<h3 class="media-heading"><small>'.$post['identifiant'].'</small> </h3>'
                    . '<p>' . $post['contenu'] . '</p>'
                    . '<blockquote>'
                    . '<p><small>' . $post['signature'] . '</small></p>'
                    . '</blockquote>'
                        . '</div>'
                        . '</div>';               
            }
            
            echo '</div>'
            . '</li>'
                    . '</ul>';
                 


            /* Si l'utilisateur est connecté au forum et actif alors il peut répondre au sujet */
            if (isActif()) {
                ?>
                <h3>Vous pouvez répondre :</h3>
                <form action="../controleur/post.php?sujet=<?php echo $_GET['sujet'] ?>" method="POST">
                    <textarea name="contenu" class="form-control" id="1" cols="30" rows="10"></textarea>
                    <button name="textAreaSubmit" type="submit" class="btn btn-default">Répondre</button>
                </form>
                <?php
            }
            ?>

        </div>

    </body>

</html>