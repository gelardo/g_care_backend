<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['is_expired'];


    public function getIsExpiredAttribute(){
        $expiry_date = Carbon::parse($this->expiry_date);
        return $expiry_date->lt(Carbon::today());
    }
}
