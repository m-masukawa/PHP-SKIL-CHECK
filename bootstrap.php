<?php

session_start();

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $file = __DIR__ . '/src/' . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

require __DIR__ . '/config/db.php';

/**
 * ビューを描画する小さなヘルパー。
 * 指定したビューの出力を $content に詰めて layout.php で包んで表示する。
 */
function view(string $name, array $data = [], string $title = '書籍管理'): void
{
    extract($data);
    ob_start();
    require __DIR__ . '/src/Views/' . $name . '.php';
    $content = ob_get_clean();
    require __DIR__ . '/src/Views/layout.php';
}

/** 安全に出力するためのエスケープ（XSS 対策） */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}