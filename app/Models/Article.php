<?php
class Article
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connexion();
    }

    public function tous()
    {
        $sql = "SELECT * FROM articles";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function retraitStock(int $id, int $quantite)
    {
        $stmt = $this->pdo->prepare("UPDATE articles SET quantite = quantite - ? WHERE id = ?");
        return $stmt->execute([$quantite, $id]);
    }

}
