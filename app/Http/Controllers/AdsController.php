<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;

class AdsController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('contentPageCategory', compact("category"));
    }
    public function showCategory($id)
    {

        $cat = Category::find($id);
        $category = Category::find($id)->ads()->get();

        return view('contentPageAds', compact("category", "cat"));
    }
    public function showAds($id)
    {
        $ads = Ads::find($id);

        return view('showAdsPage', compact("ads"));
    }
}
