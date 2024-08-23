<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory;

    protected $fillable =[
        'dish_id',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
