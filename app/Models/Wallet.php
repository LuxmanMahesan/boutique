<?php
class Wallet
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connexion();
    }

    public function creerWalletPourUser($idUser)
    {
        $sql = "INSERT INTO wallet (user_id, solde) VALUES (?, 1000)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$idUser]);
    }

    public function getWalletByUserId(int $userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM wallet WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function debiter(int $userId, int $montant)
    {
        $stmt = $this->pdo->prepare("UPDATE wallet SET solde = solde - ? WHERE user_id = ?");
        return $stmt->execute([$montant, $userId]);
    }

}
