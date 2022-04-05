<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController
{
    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(int $id): Response
    {
        dd($id);
    }








    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {

    }
}