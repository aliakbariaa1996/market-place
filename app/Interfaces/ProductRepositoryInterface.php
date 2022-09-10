<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function createNewProduct(int $store_id, string $name, int $price, int $quantity);

    public function getProductPrice(int $product_id);
    
    public function getProductQuantity(int $product_id);

}
