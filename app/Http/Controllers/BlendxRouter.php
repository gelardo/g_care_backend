<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlendxRouter extends Controller
{
    public function blendme(Request $request, $route, $action = 'index', $id = null){
        $controller_path = BlendxHelpers::get_controller($route);
        if(method_exists($controller_path, $action)){
            return $controller_path::$action($request, $route, $id);
        }else{
            return response()->json(BlendxHelpers::generate_response(true, 'Method '.$action.' not found!', []), 500);
        }

    }
}
