<?php

namespace MaxServ\App\Entity;

class Product
{
    /**
     * @param int $external_id
     * @param string $title
     * @param string $description
     * @param float $price
     * @param string $brand
     * @param string $category
     * @param float $discountPercentage
     * @param string $thumbnail
     */
    public function __construct(

        public int    $external_id,

        public string $title,

        public string $description,

        public float  $price,

        public string $brand,

        public string $category,

        public float $discountPercentage,

        public string $thumbnail,
    )
    {
    }

}