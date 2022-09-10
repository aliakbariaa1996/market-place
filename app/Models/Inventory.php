<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $fillable = ['product_id', 'quantity'];
    use HasFactory;

    /**
     * @return array
     */
    public function getHidden(): array
    {
        if (auth()->user()->isAdmin() || auth()->user()->isSeller()) return [];
        return ['id', 'product_id', 'created_at', 'updated_at'];
    }
}
