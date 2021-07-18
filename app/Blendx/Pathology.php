<?php


namespace App\Blendx;


class Pathology extends Blender
{
    public static function update_validator()
    {
        return [
            'name'=>'required|string'
        ];
    }
}
