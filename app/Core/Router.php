<?php

class Router
{
    public function chargerPage($page)
    {
        switch ($page) {
            // Liste articles avec tableau et achat
            case 'articles':
                require_once __DIR__ . '/../Controllers/ArticleController.php';
                $c = new ArticleController();
                $c->listeArticles();
                break;

            case 'achats':
                require_once __DIR__ . '/../Controllers/AchatController.php';
                $c = new AchatController();
                $c->historique();
                break;

            // CRUD complet côté admin/front
            case 'articles':
                require_once __DIR__ . '/../Controllers/ArticleController.php';
                $c = new ArticleController();
                $c->listeArticles();
                break;

            case 'ajouter_article':
                require_once __DIR__ . '/../Controllers/ArticleController.php';
                $c = new ArticleController();
                $c->formAjouter();
                break;

            case 'modifier_article':
                require_once __DIR__ . '/../Controllers/ArticleController.php';
                $c = new ArticleController();
                $c->formModifier();
                break;

            case 'supprimer_article':
                require_once __DIR__ . '/../Controllers/ArticleController.php';
                $c = new ArticleController();
                $c->supprimer();
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
                require_once __DIR__ . '/../Core/Session.php';
                Session::detruire();
                header("Location: /boutique/public/?page=login");
                exit;

            case 'recharge_wallet':
                require_once __DIR__ . '/../Controllers/ArticleController.php';
                $controller = new UserController();
                $controller->recharge();
                break;

            default:
                echo "Page inconnue.";
        }
    }
}
