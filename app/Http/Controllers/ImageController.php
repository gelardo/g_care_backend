<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Fetch images
     * @param NA
     * @return JSON response
     */
    public function profile_image(Request $request) {
        $id = $request->user()->id;
        $images = Image::find($id);
        return response()->json(["status" => "success",  "data" => $images]);
    }

    /**
     * Upload Image
     * @param $request
     * @return JSON response
     */
    public function upload_profile_images(Request $request) {
        return $request;
        die();
        $imagesName = [];
        $response = [];

        $validator = Validator::make($request->all(),
            [
                'images' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }

        if($request->has('images')) {
            foreach($request->file('images') as $image) {
                $filename = time().rand(3). '.'.$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);

                Image::create([
                    'image_name' => $filename
                ]);
            }

            $response["status"] = "successs";
            $response["message"] = "Success! image(s) uploaded";
        }

        else {
            $response["status"] = "failed";
            $response["message"] = "Failed! image(s) not uploaded";
        }
        return response()->json($response);
    }
}
