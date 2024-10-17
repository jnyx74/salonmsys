<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hairdresser extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'job_description',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }
}
