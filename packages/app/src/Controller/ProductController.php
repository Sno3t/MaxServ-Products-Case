<?php

namespace MaxServ\App\Controller;

use MaxServ\App\Repository\ProductRepository;
use MaxServ\Core\Render\TemplateRenderer;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ProductController
{

    /**
     * @param TemplateRenderer $templateRenderer
     * @param ProductRepository $productRepository
     */
    public function __construct(
        private TemplateRenderer  $templateRenderer,
        private ProductRepository $productRepository
    )
    {
    }

    /**
     * @return void
     * @throws SyntaxError
     * @throws LoaderError
     * @throws RuntimeError
     */
    public function index(): void
    {
        $products = $this->productRepository->findAll();

        echo $this->templateRenderer->render('products/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @param int $id
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show(int $id): void
    {
        $product = $this->productRepository->find($id);

        echo $this->templateRenderer->render('products/show.html.twig', [
            'product' => $product
        ]);
    }

}
