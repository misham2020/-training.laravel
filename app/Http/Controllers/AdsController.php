<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index()
    {
        $category = Category::withCount('ads')->orderByDesc('ads_count')->paginate(3);
        $ads = Ads::paginate(8);

        return view('index.indexPage', compact('category', 'ads'));
    }

    public function category()
    {

        $category = Category::withCount('ads')->orderByDesc('ads_count')->get();

        return view('category.contentPageCategory', compact('category'));
    }

    public function ads()
    {
        $ads = Ads::orderBy('title')->paginate(15);

        return view('ads.adsPage', compact('ads'));
    }

    public function showCategory(int $id)
    {
        $cat = Category::findOrFail($id);
        $category = Category::findOrFail($id)->ads()->paginate(4);

        return view('listAds.contentPageAds', compact('category', 'cat'));
    }

    public function showAds(string $slug, int $id)
    {
        $ads = Ads::findOrFail($id);

        return view('showAds.showAdsPage', compact('ads'));
    }
}
