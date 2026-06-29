<?php

namespace App\Controllers;

/**
 * 認証コントローラ（最終完成版）
 */
class AuthController
{
    /** ログイン・登録画面の表示 */
    public function showLogin(): void
    {
        $errors = $_GET['errors'] ?? [];
        view('auth/login', ['errors' => $errors], 'ログイン / ユーザー登録');
    }

    /** ユーザー登録処理（POST） */
    public function register(): void
    {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? ''; // パスワードは trim しない

        if ($email === '' || $password === '') {
            header('Location: /?page=login&errors[register]=メールとパスワードは必須です。');
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $db = db();
        $stmt = $db->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
        
        try {
            $stmt->execute([$email, $hashedPassword]);
            header('Location: /?page=login&errors[success]=ユーザー登録が完了しました。ログインしてください。');
            exit;
        } catch (\PDOException $e) {
            // 💡レビュー④：もし重複（Unique）エラーなら、メッセージを適切に出し分ける
            if ($e->getCode() === '23000') { 
                header('Location: /?page=login&errors[register]=このメールアドレスは既に登録されています。');
            } else {
                header('Location: /?page=login&errors[register]=登録に失敗しました。');
            }
            exit;
        }
    }

    /** ログイン処理（POST） */
    public function login(): void
    {
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? ''; // パスワードは trim しない

        if ($email === '' || $password === '') {
            header('Location: /?page=login&errors[login]=メールアドレスとパスワードを入力してください。');
            exit;
        }

        $db = db();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /?page=index');
            exit;
        }

        header('Location: /?page=login&errors[login]=メールアドレスまたはパスワードが間違っています。');
        exit;
    }

    /** ログアウト処理 */
    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();

        header('Location: /?page=login');
        exit;
    }
}