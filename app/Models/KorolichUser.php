<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KorolichUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'korolich_user_table'; 
    protected $primaryKey = 'id';

    protected $fillable = [
        'full_name', 'birth_date', 'phone', 'email', 'username', 'password', 'photo'
    ];

    protected $hidden = ['password'];
}
