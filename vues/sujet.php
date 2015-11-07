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
<?php include_once('layouts/header.php'); ?>
<?php
/* Lecture du sujet1 afin de l'afficher ligne par ligne */
$sujet = fopen('../sujets/'.$_GET['sujet'], 'r');
if($sujet) {

    /* tant que l'on est pas à la fin du fichier texte ... */
    while(!feof($sujet)) {
        $buffer = fgets($sujet); /* fgets retourne une ligne */
        echo $buffer . '</br>';
    }

    fclose($sujet);
}

/* Si l'utilisateur est connecté au forum, alors il peut écrire un message dans un textArea et cela s'enregistre dans le sujet. */
    if(isset($_SESSION['pseudo'])) {
        ?>
        <h1>Vous pouvez répondre :</h1>
        <form action="../actions/sujet.php?sujet=<?php echo $_GET['sujet'] ?>" method="POST">

            <textarea name="textArea" id="1" cols="30" rows="10"></textarea>
            <input type="submit" name="textAreaSubmit">
        </form>
        <?php
    }

?>



</body>

</html>