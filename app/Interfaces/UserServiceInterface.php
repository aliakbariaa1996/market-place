<?php

namespace App\Interfaces;

interface UserServiceInterface
{
    public function userList();
    
    public function makeSeller(int $user_id);

}
