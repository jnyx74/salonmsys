<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'hairdresser_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    // Define the relationship with services
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Define the relationship with hairdresser
    public function hairdresser()
    {
        return $this->belongsTo(Hairdresser::class, 'hairdresser_id');
    }
}

