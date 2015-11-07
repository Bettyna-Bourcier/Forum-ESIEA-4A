<?php
/*
 * action de deconnexion
 */
session_start();
session_destroy();

header('Location: ../vues/connexion.php');