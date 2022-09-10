<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user with no role is customer
        foreach (["admin", "seller"] as $item) {
            Role::create([
                "name" => $item
            ]);
        }
    }
}
