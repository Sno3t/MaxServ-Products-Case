<?php

namespace MaxServ\App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use MaxServ\App\DTO\ProductDTO;
use MaxServ\App\Repository\ProductRepository;

class ProductImportService
{

    /**
     * @param Client $client
     * @param ProductRepository $productRepository
     */
    public function __construct(
        private Client $client,
        private ProductRepository $productRepository
    )
    {
    }

    /**
     * @return int
     * @throws GuzzleException
     */
    public function importProducts(): int
    {
        $response = $this->client->get('https://dummyjson.com/products');

        $products = json_decode(
            $response->getBody()->getContents(),
            true
        );
        $count = 0;

        foreach ($products['products'] as $product) {
            $dto = ProductDTO::fromArray($product);

            $this->productRepository->create(
                $dto->toArray()
            );

            $count++;
        }

        return $count;
    }

}