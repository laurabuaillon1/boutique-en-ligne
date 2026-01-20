<?php
require_once  __DIR__ . '/../config/Database.php';

require_once  __DIR__ . '/../model/Produit.php';
require_once  __DIR__ . '/../repository/ProduitRepository.php';


class ProductController{


//affiche la liste de tous les produits
public function index(): void{
    //connexion avec la bdd
    $pdo = getPDO();

    //instancier le product manager
    $manager =  new ProductManager($pdo);

    //recupérer tout les produits
    $produits = $manager->findAll();

    //ajoute une vue
    require_once __DIR__ . '/../view/accueil.php';


}
}


?>