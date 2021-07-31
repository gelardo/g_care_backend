<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
    use HasFactory;

    // protected $fillable=['patient_id','doctor_id','time','date','status'];
    protected $guarded=[];


    //relations
    public function doctors(){
        return $this->belongsTo(Doctor::class, 'doctor_id','id');
    }
    public function patients(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
