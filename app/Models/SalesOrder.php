<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesOrder extends Model
{
    /** @use HasFactory<\Database\Factories\SalesOrderFactory> */
    use HasFactory;

    /** As we want to manupilate all the columns of the table, 
     * rather than using $fillable = ['col_1', 'col_2'], 
     * we use and leave $guarded = [] empty 
     * */
    protected $guarded = [];

    // Has Many Relationship
    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Belongs to Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Belongs to Relationship
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customers_id');
    }

    // Belongs to Relationship
    public function shipper(): BelongsTo
    {
        return $this->belongsTo(Shippers::class, 'shippers_id');
    }
}
