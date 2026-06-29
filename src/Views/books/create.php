<?php
/**
 * ★基礎課題: 新規登録フォームのビュー
 *
 * ここに登録フォームを実装してください。要件は README.md の「基礎課題」を参照。
 * 用意されている変数（BookController::create() から渡す想定）:
 *   $categories : カテゴリ一覧（Category::all() の結果）
 *   $errors     : バリデーションエラーの配列（再表示用、任意）
 *   $old        : 直前の入力値の配列（入力値保持用、任意）
 *
 * ヒント:
 *   - <form method="post" action="/?page=store"> で送信する
 *   - <input name="title">, <textarea>, <select name="category_id"> など
 *   - 値の出力は必ず e(...) でエスケープする（XSS 対策）
 *   - エラーがあれば <p class="error"> で表示する
 */
$title = '新規登録';
?>

<h2>新規書籍登録（このページを実装してください）</h2>

<!-- <p class="muted">README の「基礎課題」に従って登録フォームを作成してください。</p> -->

<form method="post" action="/?page=store">

<div>
        <label>タイトル：</label>
        <input type="text" name="title" value="<?= e($old['title'] ?? '') ?>">
        <?php if (!empty($errors['title'])): ?>
            <p style="color: red;"><?= e($errors['title']) ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label>著者：</label>
        <input type="text" name="author" value="<?= e($old['author'] ?? '') ?>">
        <?php if (!empty($errors['author'])): ?>
            <p style="color: red;"><?= e($errors['author']) ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label>カテゴリ：</label>
        <select name="category_id">
            <option value="">選択してください</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= e($cat['id']) ?>" <?= isset($old['category_id']) && $old['category_id'] == $cat['id'] ? 'selected' : '' ?>>
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
        <input type="number" name="price" value="<?= e($old['price'] ?? '') ?>">
        <?php if (!empty($errors['price'])): ?>
            <p style="color: red;"><?= e($errors['price']) ?></p>
        <?php endif; ?>
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" class="btn">登録する</button>
    </div>

</form>

<p><a class="btn" href="/">← 一覧へ戻る</a></p>
