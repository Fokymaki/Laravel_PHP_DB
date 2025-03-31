<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesManager extends Model
{
    /** @use HasFactory<\Database\Factories\ServicesManagerFactory> */
    use HasFactory;
    
    protected $table = 'services'; 
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'service_type', 'payment_type', 'payment_summ', 'activity'
    ];
    

}
