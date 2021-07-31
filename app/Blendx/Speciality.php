<?php

namespace App\Blendx;


class Speciality extends Blender
{
    public static function update_validator()
    {
        return [
            'name'=>'required|string'
        ];
    }

    protected $relations = ['doctors.hospitals'];
}
