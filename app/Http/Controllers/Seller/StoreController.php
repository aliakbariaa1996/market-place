<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewProductRequest;
use App\Http\Resources\SellerStoreListResourceCollection;
use App\Http\Resources\SellerStoreSingleResource;
use App\Interfaces\StoreServiceInterface;
use App\ServiceAbstracts\StoreServiceAbstract;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    /**
     * @var StoreServiceInterface
     */
    private $storeService;

    public function __construct(StoreServiceInterface $storeService)
    {
        $this->storeService = $storeService;
    }

    public function listStores()
    {

        return new SellerStoreListResourceCollection (
            $this->storeService->findOwnerStores(auth()->user()->getAuthIdentifier())->paginate()
        );
    }

    public function singleStore(Request $request, $store_id)
    {
        $store = $this->storeService->findOwnersStoreById(auth()->user()->getAuthIdentifier(), $store_id);
        if (is_null($store)) abort(404);
        return new SellerStoreSingleResource($store);
    }

    public function newProduct(NewProductRequest $request, $store_id)
    {
        return $this->storeService->createNewProduct(
            $store_id,
            $request->name,
            $request->price,
            $request->quantity
        );
    }

}
