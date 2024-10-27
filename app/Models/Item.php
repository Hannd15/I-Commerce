<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'available_amount',
    ];
}
