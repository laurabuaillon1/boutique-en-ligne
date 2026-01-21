<?php

//APPEL MODEL PRODUIT.PHP
require_once __DIR__ .  '/../model/Produit.php';

//CLASS

class ProductManager
{

    //PROPRIETE POUR STOCKER LA BDD
    private PDO $db;

    //CONSTRUCTEUR:RECOIT LA CONNEXION A LA BDD
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }



    //----------------------------------------------------//
    //RECUPERER TOUS LES PRODUITS (afficher les produits)//
    //--------------------------------------------------//

    public function findAll(): array
    {
        //1-requete SQL pour récupérer tout les produits
        $stmt = $this->db->query('SELECT * FROM products');

        //preparation d'un tableau vide qui recevra les donnees
        $products = [];

        //2-BOUCLE (tant qu'il y a des ligne dans le tableau,on boucle)
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // $row est un tableau simple : ['id' => 1, 'nom' => 'Télé', 'prix' => 500]

            // 3. L'HYDRATATION MANUELLE
            // On transforme ce tableau "bête" en un Objet "intelligent"
            $newProduct = new Product(
                $row['id_products'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['created_at']
            );
            //4-On range l'object dans une liste
            $products[] = $newProduct;
        }


    
        return $products;
    }


    //------------------------------------------------//
    // C = CREER (ajouter un produit)--------------- //
    //----------------------------------------------//

    public function create(Product $products): void
    {
        $sql = "INSERT INTO produits(id, name, description,prix,date) VALUES (:id,:name,:description,:prix,:date)";

        //securiter contre injection SQL
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id_product' => $products->getId(),
            'name' => $products->getName(),
            'description' => $products->getDescription(),
            'price' => $products->getPrix(),
            'created_at' => $products-> getDate(),
            

        ]);
    }

    //----------------------------------------------------------//
    // R = READ (récupérer produit par id,afficher un produit)  //
    //----------------------------------------------------------//  

    public function findById(int $id): ?Product
    {
        //securiter contre injonction SQL
        $stmt = $this->db->prepare('SELECT*FROM produits WHERE id = :id');
        $stmt->execute(['id' => $id]);

        // On récupère le tableau associatif simple
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si pas de résultat (false), on retourne null
        if (!$row) {
            return null;
        }

        // Sinon, on crée l'objet manuellement
        return new Product(
            $row['id_products'],
            $row['name'],
            $row['description'],
            $row['price'],
            $row['created_at']
            
        );
    }


    //-------------------------------------//
    //U = UPDATE (modifier un produit)-----//
    //-------------------------------------//

    public function update(Product $products): bool
    {
        $sql = 'UPDATE produits SET id = :id, name = :name,description = :description,prix = :prix,date = :date WHERE id = :id';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_products' => $products->getId(),
            'name' => $products->getName(),
            'description' => $products->getDescription(),
            'price' => $products->getPrix(),
            'created_at' => $products-> getDate(),
            
        ]);
    }

    //---------------------------------------//
    // D = DELETE (supprimer un produit)-----//
    //---------------------------------------//

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM produits WHERE id =:id");
        $stmt->execute(['id' => $id]);
    }
}
