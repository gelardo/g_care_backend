<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    // protected $fillable=['name','phone','start_time','end_time'];
    protected $guarded = [];

    public function doctors(){
        return $this->belongsToMany(Doctor::class, 'doctor_hospitals');
    }

}
