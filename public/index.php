<?php

require __DIR__ . '/../bootstrap.php';

$page = $_GET['page'] ?? 'index';

// 🌟レビュー⑦：index も保護対象に含める
$protectedPages = ['index', 'create', 'store', 'edit', 'update', 'delete'];
if (in_array($page, $protectedPages) && !isset($_SESSION['user_id'])) {
    header('Location: /?page=login');
    exit;
}

switch ($page) {
    case 'index':
        (new \App\Controllers\BookController())->index();
        break;
    case 'create':
        (new \App\Controllers\BookController())->create();
        break;
    case 'store':
        (new \App\Controllers\BookController())->store();
        break;
    case 'edit':
        (new \App\Controllers\BookController())->edit();
        break;
    case 'update':
        (new \App\Controllers\BookController())->update();
        break;
    case 'delete':
        (new \App\Controllers\BookController())->delete();
        break;
        
    case 'login':
        (new \App\Controllers\AuthController())->showLogin();
        break;
    case 'register_process':
        (new \App\Controllers\AuthController())->register();
        break;
    case 'login_process':
        (new \App\Controllers\AuthController())->login();
        break;
    case 'logout':
        (new \App\Controllers\AuthController())->logout();
        break;

    default:
        header('HTTP/1.1 404 Not Found');
        echo "ページが見つかりません。";
        break;
}