<!-- QUELLES OPÉRATIONS PEUT-ON FAIRE SUR LES DONNÉES "UTILISATEUR" DANS LA BASE ? -->


<?php

//APPEL MODEL UTILISATEUR
require_once __DIR__ . '/../model/Utilisateur.php';



class UtilisateurRepository
{
   //son role:communiquer avec la base de donnée
   private PDO $db;

   public function __construct(PDO $db)
   {
      $this->db = $db;
   }


   public function findByEmail(string $email): ?User
   {
      $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
      $stmt->execute([':email' => $email]);

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$row) {
         return null;
      }

      return new User(
         $row['id_users'],
         $row['email'],
         $row['password_hash'],
         $row['role']
      );
   }

   //------------------------------------------------//
   // C = CREER (ajouter un utilisateur)----------- //
   //----------------------------------------------//

   public function create(string $email,string $password_hash): void
   {
      $sql = 'INSERT INTO users (email,password_hash,role)Values (:email,:password_hash,:role)';

      //securiter
      $stmt = $this->db->prepare($sql);
      $stmt->execute([
         'email' => $email,
         'password_hash' => $password_hash,
         'role' =>'user',
      ]);
   }

   //----------------------------------------------------------------//
   // R = READ (récupérer urtilisateur par id,afficher un produit)  //
   //--------------------------------------------------------------// 

   public function findById(int $id): ?User
   {
      $stmt = $this->db->prepare('SELECT * FROM users WHERE id =:id');
      $stmt->execute(['id' => $id]);

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$row) {
         return null;
      }

      return new User(
         $row['id_users'],
         $row['email'],
         $row['password_hash'],
         $row['role']
      );
   }

   //------------------------------------------//
   //U = UPDATE (modifier un utilisateur)-----//
   //----------------------------------------//

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
   //--------------------------------------------//
   // D = DELETE (supprimer un utilisateur)-----//
   //------------------------------------------//

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