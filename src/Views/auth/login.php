<h2>認証画面</h2>

<?php if (!empty($errors['success'])): ?>
    <p style="color: green;"><?= e($errors['success']) ?></p>
<?php endif; ?>

<div style="display: flex; gap: 50px; margin-top: 20px;">
    <div style="flex: 1; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
        <h3>ログイン</h3>
        <?php if (!empty($errors['login'])): ?>
            <p style="color: red;"><?= e($errors['login']) ?></p>
        <?php endif; ?>
        <form method="post" action="/?page=login_process">
            <div>
                <label>メールアドレス：</label><br>
                <input type="email" name="email" required>
            </div>
            <div style="margin-top: 10px;">
                <label>パスワード：</label><br>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn" style="margin-top: 15px;">ログイン</button>
        </form>
    </div>

    <div style="flex: 1; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
        <h3>新規ユーザー登録</h3>
        <?php if (!empty($errors['register'])): ?>
            <p style="color: red;"><?= e($errors['register']) ?></p>
        <?php endif; ?>
        
        <form method="post" action="/?page=register_process">
            <div>
                <label>メールアドレス：</label><br>
                <input type="email" name="email" required>
            </div>
            <div style="margin-top: 10px;">
                <label>パスワード：</label><br>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn" style="margin-top: 15px;">アカウント作成</button>
        </form>
    </div>
</div>