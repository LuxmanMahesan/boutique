<?php
class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connexion();
    }

    public function creer($nom,$email,$mdp)
    {
        $sql = "INSERT INTO users (nom, email, mdp) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $ok = $stmt->execute([$nom, $email, password_hash($mdp, PASSWORD_BCRYPT)]);

        if ($ok) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }

    public function connexion($email,$mdp)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $u = $stmt->fetch();

        if ($u && password_verify($mdp, $u['mdp'])) {
            return $u;
        }
        return false;
    }

    public function getById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
