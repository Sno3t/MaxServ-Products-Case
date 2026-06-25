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
    public function show(array $parameters): void
    {
        // for some reason when passing the id directly as an int, it doesn't work and it passes the whole routing parameter array instead
        // I couldn't find a fix without changing the core router, so I just changed the method signature to accept an array instead of an int
        $product = $this->productRepository->find($parameters['id']);

        echo $this->templateRenderer->render('products/show.html.twig', [
            'product' => $product
        ]);
    }

}
