<!-- QUELLES OPÉRATIONS PEUT-ON FAIRE SUR LES DONNÉES "UTILISATEUR" DANS LA BASE ? -->


<?php

//APPEL MODEL UTILISATEUR
require_once __DIR__ . '/../model/Utilisateur.php';


class UtilisateurRepository
{

   private PDO $db;

   public function __construct(PDO $db)
   {
      $this->db = $db;
   }



   //------------------------------------------------//
   // C = CREER (ajouter un produit)--------------- //
   //----------------------------------------------//

   public function create(User $users): void
   {
      $sql = 'INSERT INTO users (id_users,email,password_hash,role)Values (:id_users,:email,:password_hash,:role)';

      //securiter
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
         'id_users' => $users->getId(),
         'email' => $users->getEmail(),
         'password' => $users->getPassword(),
         'role' => $users->getRole(),
      ]);
   }

   //----------------------------------------------------------//
   // R = READ (récupérer produit par id,afficher un produit)  //
   //----------------------------------------------------------// 

   public function findById(int $id): ?User
   {
      $stmt = $this->db->prepare('SELECT * FROM users WHERE id =:id');
      $stmt->execute(['id'=>$id]);

      $row = $stmt->fetch(PDO:: FETCH_ASSOC);

      if (!$row){
         return null;
      }

      return new User(
         $row['id_users'],
         $row['email'],
         $row['password_hash'],
         $row['role']
      );
   }

   //-------------------------------------//
   //U = UPDATE (modifier un produit)-----//
   //-------------------------------------//

   public function update(User $users): void
   {
      $sql = "UPDATE users SET id = :id,email = :email,password = :password,role =:role";
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
         'id_users' => $users->getId(),
         'email' => $users->getEmail(),
         'password' => $users->getPassword(),
         'role' => $users->getRole(),
      ]);
   }
   //---------------------------------------//
   // D = DELETE (supprimer un produit)-----//
   //---------------------------------------//

   public function delete(User $users): void
   {
      $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
      $stmt->execute([
         'id_users' => $users->getId(),
         'email' => $users->getEmail(),
         'password' => $users->getPassword(),
         'role' => $users->getRole(),
      ]);
   }
}






























?>