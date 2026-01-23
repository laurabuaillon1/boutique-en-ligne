<!-- QUELLES OPÉRATIONS PEUT-ON FAIRE SUR LES DONNÉES COMMANDES DANS LA BASE ? (UTILISATEUR/ADMIN) -->

<?php

require_once __DIR__ . '/../model/Commande.php';

class CommandeRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }



    public function findById(int $id): array
    {

        //requete sql pour recuperer les produits

        $stmt = $this->db->prepare('SELECT * FROM orders WHERE id = ?');
        $stmt->execute([$id]);

        $orderItem = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $newDetailCommande = new Order(
                $row['id'],
                $row['user_id'],
                $row['created_at'],
                $row['total'],
            );

            $orderItem[] = $newDetailCommande;
        }

        return $orderItem;
    }


    //------------------------------------------------//
    // C = CREER (ajouter un produit)--------------- //
    //----------------------------------------------//

    //creer une nouvelle commande
    public function create(Order $orders): void
    {

        $sql = "INSERT INTO orders (user_id,created_at,total)Values(:user_id,:created_at,:total)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            "user_id" => $orders->getUserId(),
            "created_at" => $orders->getCreatedAt(),
            "total" => $orders->getTotal()
        ]);
    }

    //------------------------------------------------------------------------------------------------//
    // R = READ (récupérer commande par id de l'uttilisateur,afficher la commande de l'utilisateur)  //
    //----------------------------------------------------------------------------------------------// 

    public function find(int $userId): ?Order
    {
        //securiter contre injonction SQL
        $stmt = $this->db->prepare('SELECT*FROM orders WHERE id = :id');
        $stmt->execute(['id' => $userId]);

        // On récupère le tableau associatif simple
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si pas de résultat (false), on retourne null
        if (!$row) {
            return null;
        }

        // Sinon, on crée l'objet manuellement
        return new Order(
            $row['id'],
            $row['user_id'],
            $row['created_at'],
            $row['total'],

        );
    }


    //--------------------------------------------------------------------------------//
    //U = UPDATE (modifier une commande, (statut,éléments,données,informations))-----//
    //------------------------------------------------------------------------------//

    public function update(Order $order): bool
    {
        $sql = 'UPDATE orders SET id = :id, user_id = :user_id,created_at = :created_at,total = :total WHERE id = :id';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $order->getId(),
            'user_id' => $order->getUserId(),
            'created_at' => $order->getCreatedAt(),
            'total' => $order->getTotal()
            
        ]);
    }

    //------------------------------------------//
    // D = DELETE (supprimer une commande)-----//
    //----------------------------------------//


    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id =:id");
        $stmt->execute(['id' => $id]);
    }
}
?>