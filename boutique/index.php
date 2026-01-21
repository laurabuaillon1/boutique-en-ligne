<?php

//chargement du controleur
require_once __DIR__ . '/../controller/ProduitController.php';

//on instancie le controleur
$controller = new ProductController();

//on appelle la méthode index pour afficher l'accueil
$controller->index();



?>