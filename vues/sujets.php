<?php
/**
 * Created by PhpStorm.
 * User: Bettyna
 * Date: 12/09/2015
 * Time: 13:47
 */
session_start();
include_once('../lib/utilisateur.php');
?>
<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8"/>
		<title>Forum PHP</title>

	</head>

	<body>
	<?php include_once('layouts/header.php'); ?>
		<header>
			<p><h3>Bienvenue sur le forum du club des développeurs et IT pro!</h3></p>
			<?php
				if(!isConnected()) {
					echo 'Pour voir les sujets, veuillez vous <a href="connexion.php">connecter</a>.';
				} ?>

		</header>


<!-- Liste de tous les sujets -->
		<?php
		if(isActif()) {

			$sujets = scandir('../sujets'); // on récupère tous les fichiers dans le dossiers sujets
			?>
			<ul>
				<?php
				// les deux premiers elements du tableau sont [., ..] => on les ignore
				//on parcourt les sujets pour afficher leur titre (1ere ligne du fichier)
				for ($i = 2; $i < sizeof($sujets); $i++) {
					$monFichier = fopen('../sujets/' . $sujets[$i], 'r');
					?>
					<li><a href="sujet.php?sujet=<?php echo $sujets[$i] ?>"><?php echo fgets($monFichier) ?></a></li>
					<?php
					fclose($monFichier);
				}
				?>
			</ul>
			<?php
		} else { // utilisateur pas actif
			if(isConnected()) {
				echo '<p>Votre compte doit être validé par un administrateur afin de voir les sujets et de pouvoir participer.</p>';
			} else {
				echo '<p>Vous n\'êtes pas encore membre du forum ?
					Vous pouvez vous inscrire en cliquant sur ce lien : <a href="inscription.php">inscription</a></p>';
			}
		}
		?>



	</body>

</html>