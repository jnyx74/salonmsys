<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
	protected $fillable = [
        'service_name',
        'service_detail',
        'service_category'
    ];
    
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }
}
