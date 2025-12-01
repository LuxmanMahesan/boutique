<?php
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Session.php';
require_once __DIR__ . '/../app/Core/Auth.php';

Session::demarrer();

// route simple via ?page=
$page = $_GET['page'] ?? 'articles';

$router = new Router();
$router->chargerPage($page);
