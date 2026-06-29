<?php

namespace App\Models;


abstract class Model
{

    abstract protected static function table(): string;

    public static function all(): array
    {
        $table = static::table();
        $sql = "SELECT * FROM {$table} ORDER BY id DESC";
        return db()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $table = static::table();
        $sql = "SELECT * FROM {$table} WHERE id = ?";
        $stmt = db()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}