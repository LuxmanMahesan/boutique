<?php
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Wallet.php';
require_once __DIR__ . '/../Core/Session.php';

class ArticleController
{
    private $articleModel;
    private $userModel;
    private $walletModel;

    public function __construct()
    {
        $this->articleModel = new Article();
        $this->userModel = new User();
        $this->walletModel = new Wallet();
    }

    // Liste avec achat et tableau dynamique
    public function listeArticles()
    {
        $articles = $this->articleModel->tous();
        $user = null;
        $wallet = null;
        $message = '';

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $user = $this->userModel->getById($userId);
            $wallet = $this->walletModel->getWalletByUserId($userId);

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acheter'])) {
                $articleId = (int) $_POST['article_id'];
                $article = $this->articleModel->getById($articleId);

                if (!$article) $message = "Article inexistant.";
                elseif ($article['quantite'] <= 0) $message = "Stock insuffisant.";
                elseif ($wallet['solde'] < $article['montant']) $message = "Solde insuffisant.";
                else {
                    $this->walletModel->debiter($userId, $article['montant']);
                    $this->articleModel->retraitStock($articleId, 1);
                    $wallet = $this->walletModel->getWalletByUserId($userId);
                    $message = "Achat effectué avec succès !";
                }
            }
        }

        require __DIR__ . '/../Views/articles.php';
    }

    // Affichage formulaire ajout
    public function formAjouter()
    {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'montant' => $_POST['montant'] ?? 0,
                'quantite' => $_POST['quantite'] ?? 0,
                'description' => $_POST['description'] ?? ''
            ];
            $this->articleModel->create($data);
            header("Location: ?page=articles");
            exit;
        }
        require __DIR__ . '/../Views/form_article.php';
    }

    // Affichage formulaire modification
    public function formModifier()
    {
        $id = $_GET['id'] ?? 0;
        $article = $this->articleModel->getById($id);
        if (!$article) die("Article introuvable");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'montant' => $_POST['montant'] ?? 0,
                'quantite' => $_POST['quantite'] ?? 0,
                'description' => $_POST['description'] ?? ''
            ];
            $this->articleModel->update($id, $data);
            header("Location: ?page=articles");
            exit;
        }

        require __DIR__ . '/../Views/form_article.php';
    }

    // Supprimer un article
    public function supprimer()
    {
        $id = $_GET['id'] ?? 0;
        $this->articleModel->delete($id);
        header("Location: ?page=articles");
        exit;
    }
}
