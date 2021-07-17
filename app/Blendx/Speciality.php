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
}
