<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTest extends Model
{
    use HasFactory;

    protected $guarded=[];


    protected $casts = [
        'pathology_ids' => 'array'
    ];

    //relations

    public function doctors(){
        return $this->belongsTo(Doctor::class, 'doctor_id','id');
    }
    public function patients(){
        return $this->belongsTo(Patient::class, 'patient_id','id');
    }
    public function pathologies(){
        return $this->belongsToMany(Pathology::class, 'pathology_bookings');
    }
}
