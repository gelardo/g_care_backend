<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // protected $fillable=['name','phone','start_time','end_time'];
    protected $guarded=[];

    protected $casts = [
        'speciality_ids' => 'array'
    ];
    public function booktests(){
        return $this->hasMany(BookTest::class);
    }
    //relations
    public function specialities(){
        return $this->belongsToMany(Speciality::class, 'doctor_specialities');
    }

    public function hospitals(){
        return $this->belongsToMany(Hospital::class, 'doctor_hospitals');
    }


}
