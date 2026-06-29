-- 書籍管理アプリ スキーマ + シード（SQLite）
-- bootstrap.php が database/app.sqlite を作成するときにこのファイルを実行します。

DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;

CREATE TABLE categories (
    id   INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

CREATE TABLE books (
    id           INTEGER PRIMARY KEY AUTOINCREMENT,
    title        TEXT NOT NULL,
    author       TEXT NOT NULL,
    category_id  INTEGER NOT NULL,
    price        INTEGER NOT NULL,
    published_at TEXT,
    created_at   TEXT NOT NULL DEFAULT (datetime('now')),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE reviews (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    book_id    INTEGER NOT NULL,
    reviewer   TEXT NOT NULL,
    rating     INTEGER NOT NULL,          -- 1〜5
    comment    TEXT,
    created_at TEXT NOT NULL DEFAULT (datetime('now')),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

-- 発展課題（簡易ログイン）用。password は password_hash() のハッシュを入れる想定。
CREATE TABLE users (
    id       INTEGER PRIMARY KEY AUTOINCREMENT,
    email    TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

-- 「専門誌」はあえて書籍を1冊も登録していません（SQL.md 設問8 の LEFT JOIN で
-- 「書籍が0件のカテゴリ」を体感するため）。
INSERT INTO categories (name) VALUES
    ('技術書'), ('小説'), ('ビジネス'), ('デザイン'), ('専門誌');

INSERT INTO books (title, author, category_id, price, published_at) VALUES
    ('はじめてのPHP',            '山田 太郎',  1, 2800, '2023-04-10'),
    ('実践オブジェクト指向',      '鈴木 花子',  1, 3200, '2022-09-01'),
    ('SQL ドリル',               '田中 次郎',  1, 2600, '2024-01-20'),
    ('やさしいデータベース設計',   '佐藤 三郎',  1, 3000, '2023-11-15'),
    ('夜明けの向こう側',          '中村 さくら', 2, 1500, '2021-06-05'),
    ('海辺の図書館',             '小林 健',    2, 1600, '2022-03-12'),
    ('星を数える夜に',           '加藤 美咲',  2, 1700, '2024-02-28'),
    ('チーム開発の教科書',        '渡辺 亮',    3, 2400, '2023-07-19'),
    ('はじめてのマネジメント',     '伊藤 真',    3, 2200, '2022-12-01'),
    ('数字に強くなる会計入門',     '松本 由美',  3, 2000, '2024-05-09'),
    ('UI デザインの原則',         '木村 拓也',  4, 3400, '2023-02-14'),
    ('配色の教科書',             '林 七海',    4, 2900, '2022-08-23'),
    ('使いやすさの心理学',        '清水 大輔',  4, 3100, '2024-03-03'),
    ('リーダブルPHP',            '山田 太郎',  1, 2700, '2024-06-01'),
    ('続・夜明けの向こう側',       '中村 さくら', 2, 1600, '2023-10-10'),
    ('マーケティング超入門',       '吉田 香織',  3, 2100, '2023-05-21');

INSERT INTO reviews (book_id, reviewer, rating, comment) VALUES
    (1, '読者A', 5, '入門に最適でした'),
    (1, '読者B', 4, '図が豊富で分かりやすい'),
    (2, '読者C', 5, '設計の考え方が身についた'),
    (3, '読者A', 3, '演習がもう少し欲しい'),
    (5, '読者D', 5, '一気に読んでしまった'),
    (8, '読者E', 4, '実務で役立った'),
    (11, '読者F', 5, '配色の章が特に良い');
