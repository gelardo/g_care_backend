<?php

namespace App\Http\Controllers;

use App\Models\Image as ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    /**
     * Fetch images
     * @param NA
     * @return JSON response
     */
    public function profile_image(Request $request) {
        $id = $request->user()->id;
        $images = ImageModel::where('user_id',$id)->first();
        return response()->json(["status" => "success",  "data" => $images]);
    }

    /**
     * Upload Image
     * @param $request
     * @return JSON response
     */
    public function upload_profile_images(Request $request) {
        $imagename = "";
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
                $user = Auth::user();
                $id = $request->user()->id;
                $image = $request->file('images');
                $filename = $id.'-profile-pic.'.$image->getClientOriginalExtension();
                $img = Image::make($request->file('images'));
                $img->resize(140, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $pimage = ImageModel::where('user_id',$id);
                $imageExists = $pimage->first();
//                return $imageExists->image_name.' s '.$filename;
                if($imageExists){
                    $pimage->update(['image_name' => $filename]);
                    unlink('uploads/'.$imageExists->image_name);
                    $img->save('uploads/'.$filename);
                }
                else{
                    ImageModel::create([
                        'image_name' => $filename,
                        'user_id' => $id
                    ]);
                    $img->save('uploads/'.$filename);
                }


            $response["status"] = "successs";
            $response["message"] = "Success! image(s) uploaded";
            $response["image_name"] = $filename;
        }

        else {
            $response["status"] = "failed";
            $response["message"] = "Failed! image(s) not uploaded";

        }
        return response()->json($response);
    }
}
