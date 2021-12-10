<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function destroy($id)
    {
        
        DB::table('ads_category')->where('id', $id)->delete();
    
        return redirect()->back();

    }
}
