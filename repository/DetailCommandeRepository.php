<!-- QUELLES OPÉRATIONS PEUT-ON FAIRE SUR LES DONNÉES "DÉTAIL COMMANDE" DANS LA BASE ? (UTILISATEUR/ADMIN) -->


<?php

require_once __DIR__ . '/../model/DetailCommande.php';


class DetailCommandeRepository
{

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }



    //RECUPERE TOUS LES DETAILS D'UNE COMMANDE (AU COMPLET)
    public function findByOrderId(int $order_id): array
    {

        //requete sql pour recuperer les produits
        $stmt = $this->db->prepare('SELECT * FROM order_item WHERE order_id = ?');
        $stmt->execute([$order_id]);
        $orderItem = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $newDetailCommande = new Orderitem(
                $row['id'],
                $row['order_id'],
                $row['product_id'],
                $row['quantity'],
                $row['unit_price']
            );
            $orderItem[] = $newDetailCommande;
        }
        return $orderItem;
    }


    //ajouter produit à la commande
    public function addItem(int $order_id, int $product_id, int $quantity, float $unit_price): void
    {
        $stmt = $this->db->prepare('INSERT INTO order_item (order_id,product_id,quantity,unit_price) VALUES (?,?,?,?)');
        $stmt->execute([$order_id,$product_id,$quantity,$unit_price]);
    
        }


    //------------------------------------------------//
    // C = CREER (ajouter un produit)--------------- //
    //----------------------------------------------//

    //INSERE UNE LIGNE DE COMMANDE
    public function create(Orderitem $ordersitems): void
    {

        $sql = "INSERT INTO order_item (order_id,product_id,quantity,unit_price)VALUES(:order_id,:product_id,:quantity,:unit_price)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "order_id" => $ordersitems->getOrderItem(),
            "product_id" => $ordersitems->getProductId(),
            "quantity" => $ordersitems->getQuantity(),
            "unit_price" => $ordersitems->getUnitPrice(),
        ]);
    }


    //----------------------------------------------------------//
    // R = READ (récupérer produit par id,afficher un produit)  //
    //----------------------------------------------------------// 


    //RECUPERE UNE LIGNE PRECISE DANS LA COMMANDE
    public function find(int $orderItemId): ?Orderitem
    {
        //securiter contre injonction SQL
        $stmt = $this->db->prepare('SELECT*FROM order_item WHERE id = :id');
        $stmt->execute(['id' => $orderItemId]);

        // On récupère le tableau associatif simple
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si pas de résultat (false), on retourne null
        if (!$row) {
            return null;
        }

        // Sinon, on crée l'objet manuellement
        return new Orderitem(
            $row['id'],
            $row['order_id'],
            $row['product_id'],
            $row['quantity'],
            $row['unit_price']

        );
    }



    //---------------------------------------//
    // D = DELETE (supprimer un produit)-----//
    //---------------------------------------//


    //SUPPRIME UNE LIGNE DE COMMANDE
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM order_item WHERE id =:id");
        $stmt->execute(['id' => $id]);
    }
}











?>