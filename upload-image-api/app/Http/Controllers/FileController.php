<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class FileController extends Controller
{
    function upload(Request $request){
        $images = $request->file('image');
		$imageName='';
		foreach($images as $image)
		{
			$new_name = rand() . '.' . $image->getClientOriginalExtension();
			$image->move(public_path('/uploads/images'), $new_name);
			$imageName =$imageName . $new_name.",";
		}
		$imagedb=$imageName;
        return response()->json($imagedb);

        // $image = $request->file('image');
        // if($request->hasFile('image')) {
        //     $new_name = rand() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('/uploads/images'), $new_name);
        //     return response()->json($new_name); 
        // }else{
        //     return response()->json('image null');
        // }
    }
}
