<?php
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Wallet.php';

class PanierController
{
    private $articleModel;
    private $walletModel;

    public function __construct()
    {
        $this->articleModel = new Article();
        $this->walletModel = new Wallet();
    }

    // Ajouter un article au panier
    public function ajouterAuPanier()
    {
        $articleId = $_POST['article_id'] ?? null;
        $quantite = max(1, (int)($_POST['quantite'] ?? 1));

        if (!$articleId) {
            header("Location: ?page=articles");
            exit;
        }

        if (!isset($_SESSION['panier'])) $_SESSION['panier'] = [];

        // Ajouter ou incrémenter la quantité
        if (isset($_SESSION['panier'][$articleId])) {
            $_SESSION['panier'][$articleId] += $quantite;
        } else {
            $_SESSION['panier'][$articleId] = $quantite;
        }

        header("Location: ?page=articles");
        exit;
    }

    // Afficher le panier
    public function afficherPanier()
    {
        $panier = $_SESSION['panier'] ?? [];
        $articles = [];

        foreach ($panier as $id => $qte) {
            $articles[] = [
                'info' => $this->articleModel->getById($id),
                'quantite' => $qte
            ];
        }

        require __DIR__ . '/../Views/panier.php';
    }

    // Valider l'achat
    public function validerPanier()
    {
        $wallet = $this->walletModel->getWalletByUserId($_SESSION['user_id']);
        $panier = $_SESSION['panier'] ?? [];

        $total = 0;
        foreach ($panier as $id => $qte) {
            $article = $this->articleModel->getById($id);
            if ($article['quantite'] < $qte) {
                $_SESSION['msg_panier'] = "Stock insuffisant pour " . $article['nom'];
                header("Location: ?page=panier");
                exit;
            }
            $total += $article['montant'] * $qte;
        }

        if ($wallet['solde'] < $total) {
            $_SESSION['msg_panier'] = "Solde insuffisant pour cet achat.";
            header("Location: ?page=panier");
            exit;
        }

        // Débiter wallet et mettre à jour stock
        foreach ($panier as $id => $qte) {
            $this->walletModel->debiter($_SESSION['user_id'], $this->articleModel->getById($id)['montant'] * $qte);
            $this->articleModel->retraitStock($id, $qte);
        }

        unset($_SESSION['panier']);
        $_SESSION['msg_panier'] = "Achat effectué avec succès !";
        header("Location: ?page=articles");
        exit;
    }
}
