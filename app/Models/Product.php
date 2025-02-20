<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /** As we want to manupilate all the columns of the table, 
     * rather than using $fillable = ['col_1', 'col_2'], 
     * we use and leave $guarded = [] empty 
     * */
    protected $guarded = [];
    
    // Belongs to Relationship
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    // Belongs to Relationship
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'suppliers_id');
    }

    // Has Many Relationship
    public function orderDetails(): HasMany 
    {
        return $this->hasMany(OrderDetail::class);
    }
}
