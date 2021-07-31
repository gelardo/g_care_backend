<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlendxHelpers extends Controller
{
    // Generates response in a common format
    // $error: boolean | Indicates if there was an error.
    // $message: String | Returns additional message about the response.
    // $data: Object/Array/JSON | The actual data which gets converted to JSON and goes as API response
    public static function generate_response($error, $message, $data){
        $response = new \stdClass();
        $response->error = $error;
        $response->message = $message;
        $response->data = $data;
        return $response;
    }

    // Understands the request if it is an API request or not.
    public static function is_api(Request $request){
        if($request->is("api/*")){
            return true;
        }else{
            return false;
        }
    }

    // Provides an object for using against the model
    // $route: string | Snake case singular name of the model.
    // $model->name: String | Provides the model name for using anywhere.
    // $model->path: ClassPath | Provides full path of the model class to use to class anywhere.
    // $model->blender: Object | Provides an instance of the blender of the Model to use in Controllers.
    public static function route_to_model($route){
        $model_name = Str::ucfirst(Str::camel($route));
        $model_path = "App\\Models\\".$model_name;
        $blender_path = "App\\Blendx\\".$model_name;
        if(!class_exists($model_path)){
            return response()->json(BlendxHelpers::generate_response(true, 'Model not found!', []), 404);
        }
        if(!class_exists($blender_path)){
            $blender_path = "App\\Blendx\\Blender";
        }
        $model = new \stdClass();
        $model->name = $model_name;
        $model->path = $model_path;
        $model->blender = new $blender_path();
        return $model;
    }

    // Converts a column to Laravel validator compatible validation rule.
    public static function column_to_validator_line($column){
        $type = $column->getType()->getName();
        $isRequired = $column->getNotNull() ? "|required" : "";
        $name = $column->getName();
        $validator_string = "";

        if(Str::contains($name, '_id')){
            $route = Str::substr($name, 0, -3);
            $table_name = Str::plural($route);
            $validator_string = "integer|exists:".$table_name.",id";
        }else{
            switch ($type){
                case 'text':
                case 'string':
                    $validator_string = "string";
                    break;
                case 'integer':
                    $validator_string = "integer";
                    break;
                case 'float':
                case 'double':
                    $validator_string = "numeric";
                    break;
                case 'boolean':
                    $validator_string = 'boolean';
                    break;
                case 'datetime':
                    $validator_string = 'date';
                    break;
                default:
                    break;
            }
        }
        $toReturn = $validator_string . $isRequired;
        return $toReturn;
    }

    // From route generates table name
    public static function route_to_table($route){
        return Str::snake(Str::plural($route));
    }

    // Generates slug
    public static function generate_slug($title, $route){
        $slug = Str::slug($title);
        $model = self::route_to_model($route);
        $exists = $model->path::where('slug', $slug)->first();
        if($exists){
            $title = $title.'-b';
            return self::generate_slug($title, $route);
        }else{
            return $slug;
        }
    }


    public static function get_controller($route){
        $model = self::route_to_model($route);
        if(!isset($model->name)){
            return $model;
        }
        $singular_controller_name = $model->name."Controller";
        $plural_controller_name = Str::plural($model->name)."Controller";
        $plural_controller_path = "App\\Http\\Controllers\\".$plural_controller_name;
        $singular_controller_path = "App\\Http\\Controllers\\".$singular_controller_name;
        $controller_name = $plural_controller_name;
        $controller_path = $plural_controller_path;
        if(!class_exists($controller_path)){
            $controller_name = $singular_controller_name;
            $controller_path = $singular_controller_path;
        }
        if(!class_exists($controller_path)){
            $controller_name = "BlendxController";
            $controller_path = "App\\Http\\Controllers\\BlendxController";
        }
        return $controller_path;
    }
}
