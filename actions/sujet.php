<?php
/*
 * action pour poster un message dans un sujet
 *
 *  parametres : GET
 *      sujet => nom du fichier du sujet
 *
 *  parametres : POST
 *      textArea => contenu du message
 */

    session_start();

    /* ce que l'on va enregistrer dans le sujet */
    $content = PHP_EOL.PHP_EOL."----------".PHP_EOL.$_SESSION['pseudo'].PHP_EOL.PHP_EOL.$_POST['textArea'].PHP_EOL.$_SESSION['textAreaSignature'];
    /* On écrit à la fin du fichier sujet ce que l'utilisateur a répondu sur le forum. */
    file_put_contents("../sujets/".$_GET['sujet'],$content, FILE_APPEND);

    /* On redirige vers le sujet afin de voir le message que l'utilisateur vient d'ajouter. */
    header("Location: ../vues/sujet.php?sujet=".$_GET['sujet']);
?>