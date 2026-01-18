<?php

namespace App\Models;

use App\Database\Connection;
use PDO;

class Product
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::getInstance()->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM products WHERE is_active = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO products (name, description, price, quantity)
             VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $data['name'],
            $data['description'] ?? null,
            $data['price'],
            $data['quantity']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE products
             SET name = ?, description = ?, price = ?, quantity = ?
             WHERE id = ?"
        );

        return $stmt->execute([
            $data['name'],
            $data['description'] ?? null,
            $data['price'],
            $data['quantity'],
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE products SET is_active = 0 WHERE id = ?"
        );
        return $stmt->execute([$id]);
    }
}
