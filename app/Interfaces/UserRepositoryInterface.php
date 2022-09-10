<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function userList();
    
    public function makeSeller(int $user_id);
}
