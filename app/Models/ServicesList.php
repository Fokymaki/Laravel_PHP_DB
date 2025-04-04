<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesList extends Model
{
    use HasFactory;
    protected $table = 'services_list';
    protected $fillable = [
        'service_id','is_by_agreement','is_hourly_type','is_work_type','hourly_payment','work_payment','is_active',
    ];
    
}
