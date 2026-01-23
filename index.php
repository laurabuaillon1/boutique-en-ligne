<?php
//token
session_start();
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
var_dump($_SESSION["csrf_token"]);


//-----------------------------------------------------//

//CHARGER TOUT LES CONTROLEURS ET REPOSITORIES

//controleur
require_once  './controller/ProduitController.php';
require_once  './controller/UtilisateurController.php';
require_once  './controller/CommandeController.php';


//repositories
require_once  './repository/ProduitRepository.php';
require_once  './repository/UtilisateurRepository.php';
require_once  './repository/DetailCommandeRepository.php';
require_once  './repository/CommandeRepository.php';

$pdo = getPDO();
$utilisateurRepository = new UtilisateurRepository($pdo);
$detailCommandeRepository = new DetailCommandeRepository($pdo);



$page = $_GET['page'] ?? 'home';


switch ($page) {

    //PRODUITS

    //voir un produit
    case 'produit':
        $controler = new ProductController();
        $controler->show((int)($_GET['id'] ?? 0));
        break;

    //supprimer un produit
    case 'supprimer':
        $controler = new ProductController();
        $controler->delete((int)($_GET['id'] ?? 0));
        break;


    //UTILISATEURS

    //inscription
    case 'inscription':
        $controler = new UtilisateurController($utilisateurRepository);
        $controler->inscription();
        break;

    //connexion
    case 'login':
        $controler = new UtilisateurController($utilisateurRepository);
        $controler->connexion();
        break;

    //deconnexion

    case 'deconnexion':
        $controler = new UtilisateurController($utilisateurRepository);
        $controler->deconnexion((int)($_GET['id'] ?? 0));
        break;

    case 'home':
    default:
        $controler = new ProductController();
        $controler->index();
        break;



    //PANIER

    case 'panier':
        $controler = new CommandeController($detailCommandeRepository);
        $controler->show((int)($_GET['id'] ?? 0));
        break;


    case 'ajouter-au-panier':
        $controler = new CommandeController($detailCommandeRepository);
        $controler->add();
        break;
}
