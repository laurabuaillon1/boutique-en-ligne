<!-- QU'ELLE ACTION PEUX FAIRE UN UTILISATEUR CLASSIQUE ? -->
<?php


require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Utilisateur.php';
require_once __DIR__ . '/../repository/UtilisateurRepository.php';





class UtilisateurController
{
    private UtilisateurRepository $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }



    public function inscription(): void
    {
        //VERIFIER SI L'EMAIL EXISTE DEJA
        

        //ICI JE FAIS UN POST POUR RECUPERER LES DONNEES
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        //pour le token
        if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']){
            die("Erreur CSRF: Token invalide !");
        }
            // 1-récupérer les informations du formulaire en bas dans le html
            $email = $_POST["email"];
            $password = $_POST["password"];


            //2-SECURITER CONTRE LES INJECTIONS

            $control = $this->utilisateurRepository->findByEmail($email);

            //3-traitement du resultat
            $result = $control;


            //4-boucle afficher le resultat/creer un utilisateur

            if ($result) {
                echo "Cet email est déjà pris";
            } else {
                $hash = password_hash($password, PASSWORD_ARGON2ID);
                $this->utilisateurRepository->create($email, $hash);

                header("Location: ?page=login");
                
                exit;
            }
        }
        
        //LA C'EST UN GET QUI AFFICHE LA FORMULAIRE INSCRIPTION
        require_once __DIR__  . '/../view/inscription.php';
    }


    public function connexion(): void
    {
        //OBLIGATOIRE SI UTILISATION DE $_SERVER

        //CONNEXION A LA DDB
        require_once __DIR__ . '/../config/Database.php';

        //RECUPERATION DES DONNEES MIS DANS LE FORMULAIRE
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //1-recuperation donnee utilisateur
            $email = $_POST['email'];
            $password = $_POST['password'];

            //2-preparation de la requete
            $control = $this->utilisateurRepository->findByEmail($email);;

            //4-traitement du resultat
            $user = $control;


            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_email'] = $user->getEmail();


              //header=vers quelle page je veux être redirigé
                header("Location: ?page=index");
                exit;

            } else {
                echo"vos identifiants sont invalides";
            }
        }
        
        //quelle page je veux afficher
        require_once __DIR__ . '/../view/login.php';
    }

    public function deconnexion(): void
    {
        //deconnexion
        session_destroy();

        //faire retrouner l'utilisateur à la page de connexion
        header("Location : login.php");

        require_once __DIR__ . '/../view/login.php';
    }

}

?>