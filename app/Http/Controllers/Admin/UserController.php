<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSellerRequest;
use App\Http\Resources\CreateSellerResource;
use App\Interfaces\StoreServiceInterface;
use App\Interfaces\UserServiceInterface;
use App\Models\User;

class UserController extends Controller
{


    /**
     * @var StoreServiceInterface
     */
    private $storeService;
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(StoreServiceInterface $storeService, UserServiceInterface $userService)
    {
        $this->storeService = $storeService;
        $this->userService = $userService;
    }


    public function users()
    {
        return $this->userService->userList();
    }

    public function createSeller(CreateSellerRequest $request)
    {
        $user_id = $request->owner_id;
        // make user seller if not
        $this->userService->makeSeller($user_id);
        return new CreateSellerResource(["store" => $this->storeService->createNewStore([
            'owner_id' => $request->owner_id,
            'name' => $request->name,
            'lat' => $request->lat,
            'long' => $request->long,
            'service_radius' => $request->service_radius,
            'address' => $request->address
        ]), "user" => User::find($user_id)]);

    }
}
