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
        return $this->pdo->query("SELECT * FROM articles ORDER BY id DESC")->fetchAll();
    }

    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO articles (nom, categorie, montant, quantite, description) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nom'], $data['categorie'], $data['montant'], $data['quantite'], $data['description']]);
    }

    public function update(int $id, array $data)
    {
        $stmt = $this->pdo->prepare("UPDATE articles SET nom=?, categorie=?, montant=?, quantite=?, description=? WHERE id=?");
        return $stmt->execute([$data['nom'], $data['categorie'], $data['montant'], $data['quantite'], $data['description'], $id]);
    }

    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function retraitStock(int $id, int $quantite)
    {
        $stmt = $this->pdo->prepare("UPDATE articles SET quantite = quantite - ? WHERE id = ?");
        return $stmt->execute([$quantite, $id]);
    }
}
