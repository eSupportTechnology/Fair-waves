<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = ['fee'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
