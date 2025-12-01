<?php

class Router
{
    public function chargerPage($page)
    {
        switch ($page) {
            case 'articles':
                require_once __DIR__ . '/../Controllers/ArticleController.php';
                $c = new ArticleController();
                $c->listeArticles();
                break;

            case 'panier':
                require_once __DIR__ . '/../Controllers/PanierController.php';
                $c = new PanierController();
                $c->afficherPanier();
                break;

            case 'login':
                require_once __DIR__ . '/../Controllers/UserController.php';
                $c = new UserController();
                $c->login();
                break;

            case 'register':
                require_once __DIR__ . '/../Controllers/UserController.php';
                $c = new UserController();
                $c->register();
                break;

            case 'logout':
                Session::detruire();
                header("Location: /boutique/public/?page=login");
                exit;

            default:
                echo "Page inconnue.";
        }
    }
}
