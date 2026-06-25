<?php

namespace MaxServ\App\DTO;

class ProductDTO
{

    /**
     * @param int $externalId
     * @param string $title
     * @param string $description
     * @param float $price
     * @param float $discountPercentage
     * @param string|null $brand
     * @param string $category
     * @param string $thumbnail
     */
    public function __construct(
        private int    $externalId,
        private string $title,
        private string $description,
        private float  $price,
        private float  $discountPercentage,
        private ?string $brand,
        private string $category,
        private string $thumbnail
    )
    {
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            externalId: $data['id'],
            title: $data['title'],
            description: $data['description'],
            price: $data['price'],
            discountPercentage: $data['discountPercentage'],
            brand: $data['brand'] ?? null,
            category: $data['category'],
            thumbnail: $data['thumbnail']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'external_id' => $this->externalId,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discount_percentage' => $this->discountPercentage,
            'brand' => $this->brand,
            'category' => $this->category,
            'thumbnail' => $this->thumbnail
        ];
    }
}