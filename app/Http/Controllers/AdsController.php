<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use App\Models\Flag;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    private $content;

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

        $this->content = view('index.index', compact('category', 'ads'))->render();
        return view('index.indexPage')->with('content',$this->content);
    }

    public function category()
    {

        $category = Category::withCount('ads')
            ->orderByDesc('ads_count')
            ->get();

        $this->content = view('category.listCatygory', compact('category'))->render();
        return view('index.indexPage')->with('content',$this->content);
    }

    public function ads()
    {
        $ads = Ads::query()->where('flags_id', $this->getStatusId())
            ->orderBy('title')
            ->paginate(15);

        $this->content = view('ads.ads', compact('ads'))->render();
        return view('index.indexPage')->with('content',$this->content);

    }

    public function showCategory(int $id)
    {
        $cat = Category::findOrFail($id);

        $category = Category::findOrFail($id)->ads()
            ->where('flags_id', $this->getStatusId())
            ->paginate(4);

        $this->content = view('listAds.listAds', compact('category', 'cat'))->render();
        return view('index.indexPage')->with('content',$this->content);


    }

    public function showAds(string $slug, int $id)
    {
        $ads = Ads::findOrFail($id);
        $this->content = view('showAds.showAds', compact( 'ads'))->render();
        return view('index.indexPage')->with('content',$this->content);
        //return view('showAds.showAdsPage', compact('ads'));
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

        $this->content = view('index.index', compact( 'category', 'ads'))->render();
        return view('index.indexPage')->with('content',$this->content);
        //return view('index.indexPage', compact('category', 'ads'));
    }

}
