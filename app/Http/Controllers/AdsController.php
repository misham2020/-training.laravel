<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;

class AdsController extends Controller
{
    public function index()
    {
      
        $category = Category::withCount('ads')->orderByDesc('ads_count')->get();

        return view('contentPageCategory', compact('category'));
    }

    public function showCategory(int $id)
    {

        $cat = Category::findOrFail($id);
        $category = Category::findOrFail($id)->ads()->paginate(2);

        return view('contentPageAds', compact('category', 'cat'));
    }

    public function showAds(int $id)
    {
        $ads = Ads::findOrFail($id);
        $img = $ads->imges;
        $category = Ads::findOrFail($id)->cat()->get();

        return view('showAdsPage', compact('ads', 'category', 'img'));
    }
}
