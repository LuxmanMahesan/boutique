<?php
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Wallet.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Core/Session.php';

class ArticleController
{
    public function listeArticles()
    {


        $articleModel = new Article();
        $articles = $articleModel->tous();

        $user = null;
        $wallet = null;

        // Si connecté, récupérer info user et wallet
        if (isset($_SESSION['user_id'])) {
            $userModel = new User();
            $walletModel = new Wallet();

            $userId = $_SESSION['user_id'];
            $user = $userModel->getById($userId);
            $wallet = $walletModel->getWalletByUserId($userId);

            // Gestion de l'achat
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acheter'])) {
                $articleId = (int) $_POST['article_id'];
                $article = $articleModel->getById($articleId);

                if (!$article) {
                    $message = "Article inexistant.";
                } elseif ($article['quantite'] <= 0) {
                    $message = "Stock insuffisant.";
                } elseif ($wallet['solde'] < $article['montant']) {
                    $message = "Solde insuffisant.";
                } else {
                    $walletModel->debiter($userId, $article['montant']);
                    $articleModel->retraitStock($articleId, 1);
                    $wallet = $walletModel->getWalletByUserId($userId);
                    $message = "Achat effectué avec succès !";
                }
            }

        }

        require __DIR__ . '/../Views/articles.php';
    }
}
