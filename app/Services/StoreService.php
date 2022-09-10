<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\StoreServiceInterface;

class StoreService implements StoreServiceInterface
{
    /**
     * @var StoreRepositoryInterface
     */
    private $storeRepository;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(StoreRepositoryInterface $storeRepository, ProductRepositoryInterface $productRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->productRepository = $productRepository;
    }

    public function findOwnersStoreById(int $owner_id, int $store_id)
    {
        return $this->storeRepository->findOwnersStoreById($owner_id, $store_id);
    }

    public function findOwnerStores(int $owner_id)
    {
        return $this->storeRepository->findOwnerStores($owner_id);
    }

    public function createNewStore(array $data)
    {
        return $this->storeRepository->createNewStore($data);
    }

    public function storeProducts(int $store_id)
    {
        return $this->storeRepository->storeProducts($store_id);
    }

    public function createNewProduct(int $store_id, string $name, int $price, int $quantity)
    {
        return $this->productRepository->createNewProduct($store_id, $name, $price, $quantity);
    }

    public function findNearbyStores($lat, $lon)
    {
        return $this->storeRepository->findNearbyStores($lat, $lon);
    }

    public function userStoreSingle($lat, $lon, $id)
    {
        return $this->storeRepository->userStoreSingle($lat, $lon, $id);
    }



}
