<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage($request , $key)
    {
        //image upload 
        if($request->hasFile($key)){
                // Get file name with the extension
            $fileNameWithExt = $request->file($key)->getClientOriginalName();
                // Get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just Ext
            $extension = $request->file($key)->getClientOriginalExtension();
                // File name to store
            $fileNameToStore =  $fileName.'_'.time().'.'.$extension;
                // upload image
            // $path = $request->file('slider1')->storeAs('image', $fileNameToStore);
            $file = $request->$key;
            $file->move('uploads/images', $fileNameToStore);

            return $fileNameToStore;
        }
    }
}
