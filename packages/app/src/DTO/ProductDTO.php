<?php

namespace MaxServ\App\DTO;

class ProductDTO
{

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param float $price
     * @param int $discountPercentage
     * @param string $brand
     * @param string $category
     * @param string $thumbnail
     */
    public function __construct(
        private int    $id,
        private string $title,
        private string $description,
        private float  $price,
        private int    $discountPercentage,
        private string $brand,
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
            id: $data['id'],
            title: $data['title'],
            description: $data['description'],
            price: $data['price'],
            discountPercentage: $data['discountPercentage'],
            brand: $data['brand'],
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discountPercentage' => $this->discountPercentage,
            'brand' => $this->brand,
            'category' => $this->category,
            'thumbnail' => $this->thumbnail
        ];
    }
}