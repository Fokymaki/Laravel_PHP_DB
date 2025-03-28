<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;

    protected $table = 'test'; // Указываем имя таблицы
    protected $fillable = ['name', 'age']; // Поля, которые можно заполнять
}
