<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pathology extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function booktests(){
        return $this->belongsToMany(BookTest::class, 'pathology_bookings');
    }
}
