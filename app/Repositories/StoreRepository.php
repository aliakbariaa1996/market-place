<?php

namespace App\Repositories;

use App\Interfaces\StoreRepositoryInterface;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class StoreRepository implements StoreRepositoryInterface
{
    public function findOwnersStoreById(int $owner_id, int $store_id)
    {
        return $this->model()->whereOwnerId($owner_id)->whereId($store_id)->first();
    }

    public function model(): Model
    {
        return new Store();
    }

    public function findOwnerStores(int $owner_id)
    {
        return $this->model()->whereOwnerId($owner_id);
    }

    public function createNewStore(array $data)
    {
        return $this->model()->create($data);
    }

    public function storeProducts(int $store_id)
    {
        return Product::whereStoreId($store_id);
    }

    public function findNearbyStores($lat, $lon)
    {
        return Cache::remember("nearby_stores_in:" . $lat . "," . $lon, 60, function () use ($lat, $lon) {
            $stores = $this->model()->all();
            $matched_stores = new Collection();
            foreach ($stores as $store) {
                $distance = $this->getDistance($store->lat, $store->long, $lat, $lon);
                if ($distance <= $store->service_radius) {
                    $matched_stores->push($store);
                }
            }
            return $matched_stores;
        });
    }

    private function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        try {
            $earth_radius = 6371;

            $dLat = deg2rad($latitude2 - $latitude1);
            $dLon = deg2rad($longitude2 - $longitude1);

            $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * asin(sqrt($a));
            $d = $earth_radius * $c;
            return $d;
        } catch (\Exception | \Throwable $exception) {
            abort(400);
        }

    }

    public function userStoreSingle($lat, $lon, $id)
    {
        $store = $this->model()->find($id);
        if (is_null($store)) abort(404);
        $distance = $this->getDistance($store->lat, $store->long, $lat, $lon);
        if ($distance <= $store->service_radius) {
            return $store;
        }
        return [];
    }
}
