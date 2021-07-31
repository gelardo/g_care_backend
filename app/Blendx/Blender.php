<?php

namespace App\Blendx;

use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\BlendxHelpers;
use Illuminate\Support\Str;

class Blender {
    public static function store_validator($route){

        $table = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns(Str::plural($route));
        $validator = [];
        foreach ($table as $column){
            if($column->getName() == 'id' || $column->getName() == 'slug' || Str::contains($column->getName(), '_token') || Str::contains($column->getName(), '_at')){continue;}
            $validator[$column->getName()] = BlendxHelpers::column_to_validator_line($column);
        }
        return $validator;
    }

    public static function update_validator(){
        return [];
    }
    public static function after_validator($validated, $route, $user = null){

        $table_name = BlendxHelpers::route_to_table($route);
        $model = BlendxHelpers::route_to_model($route);
        if (Schema::hasColumn($table_name, 'slug'))
        {
            $slug = isset($validated['name']) ? BlendxHelpers::generate_slug($validated['name'], $route) : (isset($validated['title']) ? BlendxHelpers::generate_slug($validated['title'], $route) : null);

            $validated['slug'] = $slug;

        }
        $updated = $validated;

        foreach ($validated as $key => $input){
            if(gettype($input) == 'object'){
                $originalFileName = $input->getClientOriginalName();
                $fileExt = $input->getClientOriginalExtension();
                $originalFileNameWithoutExt = Str::of($originalFileName)->basename('.'.$fileExt);
                $fileNameToSave = $originalFileNameWithoutExt . '_' . time() . '.' . $fileExt;
                $updated[$key] = 'storage/'.Str::snake($model->name).'/'.$fileNameToSave;
                $input->storeAs('public/'.Str::snake($model->name), $fileNameToSave);
            }
        }
        $create_with = $model->blender->getCreateWith();
        $toReturn = [];
        foreach ($create_with as $input => $relation_route){

            $toReturn[$input] = $validated[$input];
            unset($validated[$input]);
        }
        $toReturn['updated'] = $validated;
        $toReturn['route'] = $route;
        return $toReturn;
    }

    public static function handleRelations($entry, $processed){

        $originalRoute = $processed['route'];
        $originalModel = BlendxHelpers::route_to_model($originalRoute);
        // dd($originalModel);
        $create_with = $originalModel->blender->getCreateWith();
//        dd($create_with);
        foreach ($processed as $input => $values){

            if($input == 'updated' || $input == 'route'){
                continue;
            }

            foreach($values as $value){
                $route = $create_with[$input];
                $model = BlendxHelpers::route_to_model($route);
                $pivotEntry = new $model->path();
                $pivotMaster = $originalRoute."_id";
                $pivotEntry->$pivotMaster = $entry->id;
                $pivotAux = Str::substr($input, 0, -1);
                $pivotEntry->$pivotAux = $value;
                $pivotEntry->save();
            }
        }
        return;
    }

    public static function after_created($entry, $processed){
        self::handleRelations($entry, $processed);
        return;
    }

    public static function after_updated($entry,$processed){
        self::handleRelations($entry,$processed);
        return;
    }

    protected $relations = [];

    public function getRelations(){
        return $this->relations;
    }



    // public static function setRoute($route){
    //     self::$route = $route;
    // }

    protected $create_with = [];

    public function getCreateWith(){
        return $this->create_with;
    }

    public static function format_entry ($entry, $model = null){
        $formatted = $model->path::where('id', $entry->id)->with($model->blender->getRelations())->first();
        return $formatted;
    }
}

