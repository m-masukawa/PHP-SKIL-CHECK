<?php

/**
 * ★応用課題: 編集フォームのビュー
 *
 * 既存の値をフォームに初期表示し、/?page=update へ送信して更新します。
 * 用意されている変数（BookController::edit() から渡す想定）:
 *   $book       : 編集対象の書籍（Book::find($id) の結果）
 *   $categories : カテゴリ一覧
 *   $errors     : バリデーションエラー（任意）
 *
 * ヒント:
 *   - <form method="post" action="/?page=update"> に <input type="hidden" name="id" value="...">
 *   - 既存値を value= に入れて初期表示（必ず e(...) でエスケープ）
 */
$title = '編集';
?>

<h2>書籍の編集</h2>

<!-- <p class="muted">README の「応用課題」に従って編集フォームを作成してください。</p> -->

<form method="post" action="/?page=update&id=<?= e($book['id']) ?>">

    <div>
        <label>タイトル：</label>
        <input type="text" name="title" value="<?= e($old['title'] ?? $book['title']) ?>">
        <?php if (!empty($errors['title'])): ?>
            <p style="color: red;"><?= e($errors['title']) ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label>著者：</label>
        <input type="text" name="author" value="<?= e($old['author'] ?? $book['author']) ?>">
        <?php if (!empty($errors['author'])): ?>
            <p style="color: red;"><?= e($errors['author']) ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label>カテゴリ：</label>
        <select name="category_id">
            <option value="">選択してください</option>
            <?php
            $selected_id = $old['category_id'] ?? $book['category_id'];
            ?>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= e($cat['id']) ?>" <?= $selected_id == $cat['id'] ? 'selected' : '' ?>>
                    <?= e($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['category_id'])): ?>
            <p style="color: red;"><?= e($errors['category_id']) ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label>価格：</label>
        <input type="number" name="price" value="<?= e($old['price'] ?? $book['price']) ?>">
        <?php if (!empty($errors['price'])): ?>
            <p style="color: red;"><?= e($errors['price']) ?></p>
        <?php endif; ?>
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn">更新する</button>
    </div>

</form>

<p><a class="btn" href="/">← 一覧へ戻る</a></p>