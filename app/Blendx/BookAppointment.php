<?php

namespace App\Blendx;

use App\Models\BookAppointment as BookAppointmentModel;
use App\Models\Doctor;


class BookAppointment extends Blender
{
    protected $relations = ['patients','doctors'];


    public static function store_validator($route)
    {
        $validator=parent::store_validator($route);
        $validator['serial'] = 'integer';
        return $validator;
    }

    public static function after_validator($validated, $route, $user = null)
    {
        $serial=BookAppointmentModel::where([['date','=',$validated['date']],['doctor_id','=',$validated['doctor_id']]])->latest()->first();
        if($serial){
            $validated['serial']=$serial->serial+1;
        }
        else{
            $validated['serial']=1;
        }

        $toReturn= parent::after_validator($validated, $route, $user = null);
        return $toReturn;
    }

    public static function update_validator()
    {
        return [
            'patient_id'=>'required|string',
            'doctor_id'=>'required|string',
            'date'=>'required|string',
            'status'=>'required|boolean',
            'serial'=>'integer'
        ];
    }

}
