<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function doctors(){
        return $this->belongsToMany(Doctor::class, 'doctor_specialities');
    }



}
