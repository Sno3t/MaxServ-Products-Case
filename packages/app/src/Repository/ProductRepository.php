<?php

namespace MaxServ\App\Repository;


use MaxServ\Core\Database\Connection;

class ProductRepository
{

    /**
     * @param Connection $db
     */
    public function __construct(
        private Connection $db
    )
    {}

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->db->getConnection()->query('SELECT * FROM products')->fetchAll();
    }

    public function create(array $data): void
    {
        $stmt = $this->db->getConnection()->prepare('INSERT INTO products (external_id, title, description, price, brand, category, discount_percentage, thumbnail) VALUES (:external_id, :title, :description, :price, :brand, :category, :discount_percentage, :thumbnail)');
        $stmt->execute($data);
    }

}