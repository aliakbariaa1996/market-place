<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userList()
    {
        return $this->userRepository->userList();
    }

    public function makeSeller(int $user_id)
    {
        return $this->userRepository->makeSeller($user_id);
    }
}
