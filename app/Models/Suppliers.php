<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suppliers extends Model
{
    /** @use HasFactory<\Database\Factories\SuppliersFactory> */
    use HasFactory;

    protected $guarded = [];

    public function product(): HasMany

    {
        return $this->hasMany(Product::class);
    }
}
