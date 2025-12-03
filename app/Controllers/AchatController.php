<?php
require_once __DIR__ . '/../Models/Achat.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Core/Session.php';

class AchatController
{
    public function historique()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?page=login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $userModel = new User();
        $user = $userModel->getById($userId);

        $achatModel = new Achat();
        $achats = $achatModel->historiqueParUser($userId);

        require __DIR__ . '/../Views/achats.php';
    }
}
