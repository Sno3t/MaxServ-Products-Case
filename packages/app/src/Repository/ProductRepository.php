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
        $stmt = $this->db->getConnection()->prepare('INSERT INTO products (id, title, description, price, brand, category, discountPercentage, thumbnail) VALUES (:id, :title, :description, :price, :brand, :category, :discountPercentage, :thumbnail)');
        $stmt->execute($data);
    }

}