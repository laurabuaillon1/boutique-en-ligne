<?php

//deconnexion
session_destroy();

//faire retrouner l'utilisateur à la page de connexion
header("Location : login.php");

?>