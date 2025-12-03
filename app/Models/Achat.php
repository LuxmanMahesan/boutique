<?php
class Achat
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connexion();
    }

    // Ajouter un achat
    public function creer(int $userId, int $articleId, int $quantite = 1)
    {
        $stmt = $this->pdo->prepare("INSERT INTO achats (user_id, article_id, quantite) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $articleId, $quantite]);
    }

    // Récupérer l'historique d'un utilisateur
    public function historiqueParUser(int $userId)
    {
        $stmt = $this->pdo->prepare("
            SELECT a.id, ar.nom AS article, a.quantite, a.date_achat, ar.montant
            FROM achats a
            JOIN articles ar ON a.article_id = ar.id
            WHERE a.user_id = ?
            ORDER BY a.date_achat DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
