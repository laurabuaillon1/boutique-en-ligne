<!-- QU'ELLE ACTION PEUX FAIRE UN UTILISATEUR CLASSIQUE ? -->

<?php


require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/DetailCommande.php';
require_once __DIR__ . '/../repository/DetailCommandeRepository.php';
require_once __DIR__ . '/../repository/CommandeRepository.php';


class CommandeController
{

  private DetailCommandeRepository $detailCommandeRepository;


  public function __construct(DetailCommandeRepository $detailCommandeRepository,)
  {
    $this->detailCommandeRepository = $detailCommandeRepository;
  }





  //afficher le detail de TOUTE la commande
  public function show(int $id): void
  {
    $pdo = getPDO();
    $manager = new DetailCommandeRepository($pdo);
    $produits = $manager->findByOrderId($id);

    require_once __DIR__ . '/../view/panier.php';
  }






  //AJOUTER UN PRODUIT AU PANIER
  public function add(): void
  {
    //  session_start(); //permet de stocker les données persistante sans ça les donnees du panier disparaissent à chaque page

    //recuperer les données du formulaire
    $productId = (int) ($_POST['productId'] ?? 0);
    $quantity = (int) ($_POST['quantity'] ?? 1);


    //validation des données
    if ($productId <= 0 || $quantity <= 0) {
      die('données invalides');
    }

    //initaliser le panier
    if (!isset($_SESSION['panier'])) {  //Si le panier n’existe pas encore, on le crée comme tableau vide
      $_SESSION['panier'] = [];
    }

    // Ajouter/incrementer le produit
    if (isset($_SESSION['panier'][$productId])) {   //vérifie si le produit est déjà dans le panier.
      $_SESSION['panier'][$productId] += $quantity;
    } else {
      $_SESSION['panier'][$productId] = $quantity;
    }




    header('Location: ?page=panier');
    exit;
  }
}

?>