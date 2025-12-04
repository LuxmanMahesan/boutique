<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Wallet.php';

class UserController
{
    public function login()
    {
        if (!empty($_POST)) {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

            $u = new User();
            $user = $u->connexion($email, $mdp);

            if ($user) {
                Session::set("user_id", $user['id']);
                header("Location: /boutique/public/?page=articles");
                exit;
            }

            $erreur = "Identifiants incorrects.";
        }

        require __DIR__ . '/../Views/login.php';
    }

    public function register()
    {
        if (!empty($_POST)) {
            $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

            $u = new User();
            $idUser = $u->creer($nom, $email, $mdp);

            if ($idUser) {
                $w = new Wallet();
                $w->creerWalletPourUser($idUser);


                Session::set("user_id", $idUser);
                header("Location: /boutique/public/?page=articles");
                exit;
            }

            $erreur = "Erreur lors de l'inscription.";
        }

        require __DIR__ . '/../Views/register.php';
    }



    public function recharge()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $montant = isset($_POST['montant']) ? (int)$_POST['montant'] : 0;
            if ($montant <= 0) die("Montant invalide");

            $userId = Session::get("user_id");
            $w = new Wallet();
            $w->crediter($userId, $montant);

            echo "OK"; // simple retour
            exit;
        }
    }

}
