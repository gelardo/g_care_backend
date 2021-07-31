<?php

namespace App\Blendx;

class DoctorAssistant extends Blender
{
    protected $relations = ['doctors'];
    public static function store_validator($route)
    {
        $validator = parent::store_validator($route);
        return $validator;
    }

}
