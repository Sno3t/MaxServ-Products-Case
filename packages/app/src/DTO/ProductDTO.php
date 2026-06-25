<?php

namespace MaxServ\App\DTO;

class ProductDTO
{

    /**
     * @param int $external_id
     * @param string $title
     * @param string $description
     * @param float $price
     * @param float $discount_percentage
     * @param string|null $brand
     * @param string $category
     * @param string $thumbnail
     */
    public function __construct(
        private int     $external_id,
        private string  $title,
        private string  $description,
        private float   $price,
        private float   $discount_percentage,
        private ?string $brand,
        private string  $category,
        private string  $thumbnail
    )
    {}

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            external_id: $data['id'],
            title: $data['title'],
            description: $data['description'],
            price: $data['price'],
            discount_percentage: ($data['discountPercentage']),
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
            'external_id' => $this->external_id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discount_percentage' => $this->discount_percentage,
            'brand' => $this->brand,
            'category' => $this->category,
            'thumbnail' => $this->thumbnail
        ];
    }

    /**
     * @return int
     */
    public function getExternalId(): int
    {
        return $this->external_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getBrand(): ?string
    {
        return $this->brand;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return float
     */
    public function getDiscountPercentage(): float
    {
        return $this->discount_percentage;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @return float
     */
    public function getFinalPrice(): float
    {
        return $this->price * (1 - $this->discount_percentage / 100);
    }
}
