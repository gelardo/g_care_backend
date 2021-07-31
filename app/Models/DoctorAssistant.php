<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DoctorAssistant extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
