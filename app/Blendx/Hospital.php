<?php


namespace App\Blendx;


class Hospital extends Blender
{
    public static function store_validator($route)
    {
        $validator = parent::store_validator($route);
        return $validator;
    }

    public static function update_validator()
    {
        return [
            'name'=>'required|string',
            'phone'=>'required|string',
            'location'=>'required|string',
        ];
    }
}
