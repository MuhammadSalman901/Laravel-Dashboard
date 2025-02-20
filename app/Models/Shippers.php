<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shippers extends Model
{
    /** @use HasFactory<\Database\Factories\ShippersFactory> */
    use HasFactory;

    protected $guarded = [];

    public function salesOrder(): HasMany
    {
        return $this->hasMany(SalesOrder::class);
    }
}
