<!-- QU'ELLE ACTION PEUX FAIRE UN UTILISATEUR CLASSIQUE ? -->

<?php 

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/DetailCommande.php';
require_once __DIR__ . '/../repository/DetailCommandeRepository.php';

class CommandeController{

   private DetailCommandeRepository $detailCommandeRepository;

   public function __construct(DetailCommandeRepository $detailCommandeRepository)
   {
    $this->detailCommandeRepository = $detailCommandeRepository;
   }

 //afficher le detail de TOUTE la commande
   public function show(int $id):void{
    $pdo =getPDO();
    $manager = new DetailCommandeRepository($pdo);
    $produit = $manager->findByOrderId($id);

    require_once __DIR__ . '/../view/panier.php';
   }


}








?>
