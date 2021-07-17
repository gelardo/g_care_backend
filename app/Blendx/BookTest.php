<?php

namespace App\Blendx;


class BookTest extends Blender
{
    protected $create_with=[
        'pathology_ids'=>'pathology_booking'
    ];

    protected $relations = ['pathologies','patients','doctors'];

    public static function store_validator($route)
    {
        $validator=parent::store_validator($route);
        $validator['pathology_ids'] = 'required|array';
        return $validator;
    }
}
