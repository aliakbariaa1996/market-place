<?php

namespace App\Models;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['store_id','name'];
    protected $appends=['price','quantity'];
    use HasFactory;

    public function getPriceAttribute(){
        return app()->make(ProductRepository::class)->getProductPrice($this->id);
    }
    public function getQuantityAttribute(){
        return app()->make(ProductRepository::class)->getProductQuantity($this->id);
    }

}
