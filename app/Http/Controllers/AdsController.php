<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use App\Models\Flag;
use Illuminate\Http\Request;

class AdsController extends Controller
{

    public function getStatusId()
    {
        return Flag::query()->where('name', 'работает')->first()->id;
    }

    public function index()
    {

        $ads = Ads::query()->where('flags_id', $this->getStatusId())
            ->paginate(5);

        $category = Category::withCount('ads')
            ->orderByDesc('ads_count')
            ->paginate(3);

        return view('index.indexPage', compact('category', 'ads'));
    }

    public function category()
    {

        $category = Category::withCount('ads')
            ->orderByDesc('ads_count')
            ->get();

        return view('category.contentPageCategory', compact('category'));
    }

    public function ads()
    {

        $ads = Ads::query()->where('flags_id', $this->getStatusId())
            ->orderBy('title')
            ->paginate(15);

        return view('ads.adsPage', compact('ads'));
    }

    public function showCategory(int $id)
    {
        $cat = Category::findOrFail($id);

        $category = Category::findOrFail($id)->ads()
            ->where('flags_id', $this->getStatusId())
            ->paginate(4);

        return view('listAds.contentPageAds', compact('category', 'cat'));
    }

    public function showAds(string $slug, int $id)
    {
        $ads = Ads::findOrFail($id);

        return view('showAds.showAdsPage', compact('ads'));
    }

    public function search(Request $request)
    {
        $category = Category::query()->withCount('ads')
            ->orderByDesc('ads_count')
            ->paginate(3);

        $search = $request->search;

        $ads = Ads::query()->where('flags_id', $this->getStatusId())
            ->where('title', 'LIKE', "%{$search}%")
            ->paginate(2);

        return view('index.indexPage', compact('category', 'ads'));
    }

}
