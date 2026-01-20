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
        $stmt = $this->db->query('SELECT*FROM products');
        
        //preparation d'un tableau vide qui recevra les donnees
        $products = [];

        //2-BOUCLE (tant qu'il y a des ligne dans le tableau,on boucle)
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // $row est un tableau simple : ['id' => 1, 'nom' => 'Télé', 'prix' => 500]

            // 3. L'HYDRATATION MANUELLE
            // On transforme ce tableau "bête" en un Objet "intelligent"
            $newProduct = new Products(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['prix'],
                $row['date'],
            );
        }

        //4-On range l'object dans une liste
        $products[] = $newProduct;

        return $products;
        echo '<pre>';
        var_dump($products);
    }


    //------------------------------------------------//
    // C = CREER (ajouter un produit)--------------- //
    //----------------------------------------------//

    public function create(Products $products): void
    {
        $sql = "INSERT INTO produits(id, name, description,prix,date) VALUES (:id,:name,:description,:prix,:date)";

        //securiter contre injection SQL
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $products->getId(),
            'name' => $products->getName(),
            'description' => $products->getDescription(),
            'prix' => $products->getPrix(),
            'date' => $products > getDate(),
        ]);
    }

    //----------------------------------------------------------//
    // R = READ (récupérer produit par id,afficher un produit)  //
    //----------------------------------------------------------//  

    public function findById(int $id): ?Products
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
        return new Products(
            $row['id'],
            $row['name'],
            $row['description'],
            $row['prix'],
            $row['date'],
        );
    }


    //-------------------------------------//
    //U = UPDATE (modifier un produit)-----//
    //-------------------------------------//

    public function update(Products $products): bool
    {
        $sql = 'UPDATE produits SET id = :id, name = :name,description = :description,prix = :prix,date = :date WHERE id = :id';
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $products->getId(),
            'name' => $products->getName(),
            'description' => $products->getDescription(),
            'prix' => $products->getPrix(),
            'date' => $products > getDate(),
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
