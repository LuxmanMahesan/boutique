<?php

class PanierController
{
    public function afficherPanier()
    {
        $panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];

        require __DIR__ . '/../Views/panier.php';
    }
}
