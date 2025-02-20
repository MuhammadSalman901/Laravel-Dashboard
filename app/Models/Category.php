<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    /** As we want to manupilate all the columns of the table, 
     * rather than using $fillable = ['col_1', 'col_2'], 
     * we use and leave $guarded = [] empty 
     * */
    protected $guarded = [];

    // Has Many Relationship
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
