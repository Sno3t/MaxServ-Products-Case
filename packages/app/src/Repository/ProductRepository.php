<?php

namespace MaxServ\App\Repository;


use MaxServ\App\DTO\ProductDTO;
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
     * @param string|null $sort
     * @return array
     */
    public function findAllSorted(?string $sort): array
    {
        $rows = $this->db->getConnection()
            ->query('SELECT * FROM products')
            ->fetchAll();

        $products = array_map(
            fn($row) => ProductDTO::fromArray($row),
            $rows
        );

        usort($products, function ($a, $b) use ($sort) {
            return match ($sort) {
                'title' => $a->getTitle() <=> $b->getTitle(),
                'brand' => $a->getBrand() <=> $b->getBrand(),
                'price' => $a->getPrice() <=> $b->getPrice(),
                'final_price' => $a->getFinalPrice() <=> $b->getFinalPrice(),
                'category' => $a->getCategory() <=> $b->getCategory(),
                default => $a->getId() <=> $b->getId(),
            };
        });

        return $products;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?ProductDTO
    {
        $stmt = $this->db->getConnection()->prepare(
            'SELECT * FROM products WHERE id = :id'
        );

        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();

        return $row ? ProductDTO::fromArray($row) : null;
    }

    /**
     * @param array $data
     * @return void
     */
    public function save(array $data): void
    {
        $existing = $this->findByExternalId($data['external_id']);

        if ($existing) {
            $this->update($data['external_id'], $data);
            return;
        }

        $this->create($data);
    }

    /**
     * @param int $externalId
     * @return array|null
     */
    public function findByExternalId(int $externalId): ?array
    {
        $stmt = $this->db->getConnection()->prepare(
            'SELECT * FROM products WHERE external_id = :external_id'
        );

        $stmt->execute([
            'external_id' => $externalId
        ]);

        return $stmt->fetch() ?: null;
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $stmt = $this->db->getConnection()->prepare(
            'INSERT INTO products 
            (external_id, title, description, price, brand, category, discount_percentage, thumbnail)
            VALUES
            (:external_id, :title, :description, :price, :brand, :category, :discount_percentage, :thumbnail)'
        );

        $stmt->execute($data);
    }

    /**
     * @param int $externalId
     * @param array $data
     * @return void
     */
    public function update(int $externalId, array $data): void
    {
        $stmt = $this->db->getConnection()->prepare(
            'UPDATE products SET
                title = :title,
                description = :description,
                price = :price,
                brand = :brand,
                category = :category,
                discount_percentage = :discount_percentage,
                thumbnail = :thumbnail
            WHERE external_id = :external_id'
        );

        $stmt->execute($data);
    }
}
