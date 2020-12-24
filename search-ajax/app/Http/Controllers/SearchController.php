<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts;
use DB;

class SearchController extends Controller
{
	public function Search(Request $request){
		$inputSearch = $request['inputSearch'];
		$keyResult = DB::table('posts')
		->Where('name','LIKE','%'.$inputSearch.'%')
		->OrWhere('content','LIKE','%'.$inputSearch.'%')
		->get();
		echo $keyResult;
	}
}
