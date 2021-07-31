<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyBooking extends Model
{
    use HasFactory;


    public function pathologies(){
        return $this->belongsTo(Pathology::class, 'pathology_id','id');
    }
    public function booktests(){
        return $this->belongsTo(BookTest::class, 'book_test_id','id');
    }
}
