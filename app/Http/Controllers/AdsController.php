<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;

class AdsController extends Controller
{
	public function index()
    {

       return view('layouts.layout');
    }
}
