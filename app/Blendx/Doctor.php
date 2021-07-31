<?php

namespace App\Blendx;


class Doctor extends Blender
{
    protected $create_with=[
        'speciality_ids'=>'doctor_speciality',
        'hospital_ids'=>'doctor_hospital'
    ];

    protected $relations = ['specialities','hospitals'];

    public static function store_validator($route)
    {
        $validator=parent::store_validator($route);
        $validator['speciality_ids'] = 'required|array';
        $validator['hospital_ids'] = 'required|array';
        return $validator;
    }

    public static function update_validator()
    {
        return [
            'name'=>'required|string',
            'phone'=>'required|string',
            'start_time'=>'required|string',
            'end_time'=>'required|string',
            'speciality_ids'=>'required|array',
            'hospital_ids'=>'required|array'
        ];
    }
}
