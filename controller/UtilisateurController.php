<!-- QU'ELLE ACTION PEUX FAIRE UN UTILISATEUR CLASSIQUE ? -->
<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Utilisateur.php';
require_once __DIR__ . '/../repository/UtilisateurRepository.php';





class UtilisateurController
{

    public function inscription(): void
    {
        //VERIFIER SI L'EMAIL EXISTE DEJA

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1-récupérer les informations du formulaire en bas dans le html
            $email = $_POST["email"];
            $password = $_POST["password"];


            //2-SECURITER CONTRE LES INJECTIONS

            $control = $pdb->prepare('SELECT * FROM users WHERE email = :email');
            $control->execute([':email' => $email]);

            //3-traitement du resultat
            $result = $control->fetch();


            //4-boucle afficher le resultat/creer un utilisateur

            if ($result) {
                $error = "Cet email esy déjà pris";
            } else {
                $hash = password_hash($password, PASSWORD_ARGON2ID);
                $insert = $pdo->prepare('INSERT INTO users (email,password) VALUES(:email,:password)');
                $insert->execute([":email" => $email, ":password" => $hash]);

                header("Location: login.php");
                exit;
            }
        }
    }


    public function connexion(): void
    {
        //OBLIGATOIRE SI UTILISATION DE $_SERVER
        session_start();

        //CONNEXION A LA DDB
        require_once __DIR__ . '/../config/Database.php';

        //RECUPERATION DES DONNEES MIS DANS LE FORMULAIRE
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //1-recuperation donnee utilisateur
            $email = $_POST['email'];
            $password = $_POST['password'];

            //2-preparation de la requete
            $control = $pdo->prepare('SELECT * FROM users WHERE email = :email');

            //3-execution
            $control = $pdo->execute(['email' => $email]);

            //4-traitement du resultat
            $user = $control->fetch();


            if ($user && password_verify($password, $user["password"])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                header("Location: index.php");
                exit;
            } else {
                $error = "vos identifiants sont invalides";
            }
        }
    }

    public function deconnexion(): void
    {
        //deconnexion
        session_destroy();

        //faire retrouner l'utilisateur à la page de connexion
        header("Location : login.php");
    }
}

?>