<?php

namespace App\Interfaces;

interface StoreServiceInterface
{
    public function findOwnersStoreById(int $owner_id, int $store_id);

    public function findOwnerStores(int $owner_id);

    public function createNewStore(array $data);

    public function storeProducts(int $store_id);

    public function createNewProduct(int $store_id, string $name, int $price, int $quantity);

    public function findNearbyStores($lat, $lon);

    public function userStoreSingle($lat, $lon, $id);


}
