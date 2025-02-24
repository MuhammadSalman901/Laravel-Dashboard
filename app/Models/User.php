<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    /** As we want to manupilate all the columns of the table, 
     * rather than using $fillable = ['col_1', 'col_2'], 
     * we use and leave $guarded = [] empty 
     * */ 
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills_input' => 'array',
        ];
    }

    // Has Many Relationship
    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Has Many Relationship
    public function salesOrder(): HasMany
    {
        return $this->hasMany(SalesOrder::class);
    }
}
