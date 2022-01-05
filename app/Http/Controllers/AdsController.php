<?php

namespace App\Http\Controllers;

use App\AdsRepository\AdsRepository;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Flag;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    private $adsRepository;
    private $content;


    public function __construct(AdsRepository $adsRepository)
    {
        $this->adsRepository = $adsRepository;
    }

    public function index()
    {
        $ads = Ads::query()->where('flags_id', $this->adsRepository->getStatusId('work'))
            ->paginate(5);

        $category = Category::withCount('ads')
            ->orderByDesc('ads_count')
            ->paginate(3);

        $this->content = view('ads.index', compact('category', 'ads'))->render();
        return view('indexPage')->with('content',$this->content);
    }

    public function category()
    {

        $category = Category::withCount('ads')
            ->orderByDesc('ads_count')
            ->get();

        $this->content = view('ads.listCatygory', compact('category'))->render();
        return view('indexPage')->with('content',$this->content);
    }

    public function ads()
    {
        $ads = Ads::query()->where('flags_id', $this->adsRepository->getStatusId('work'))
            ->orderBy('title')
            ->paginate(15);

        $this->content = view('ads.ads', compact('ads'))->render();
        return view('indexPage')->with('content',$this->content);

    }

    public function showCategory(int $id)
    {
        $cat = Category::findOrFail($id);

        $category = Category::findOrFail($id)->ads()
            ->where('flags_id', $this->adsRepository->getStatusId('work'))
            ->paginate(4);

        $this->content = view('ads.listAds', compact('category', 'cat'))->render();
        return view('indexPage')->with('content',$this->content);


    }

    public function showAds(string $slug, int $id)
    {
        $ads = Ads::findOrFail($id);
        $this->content = view('ads.showAds', compact( 'ads'))->render();
        return view('indexPage')->with('content',$this->content);

    }

    public function search(Request $request)
    {
        $category = Category::query()->withCount('ads')
            ->orderByDesc('ads_count')
            ->paginate(3);

        $search = $request->search;

        $ads = Ads::query()->where('flags_id', $this->adsRepository->getStatusId('work'))
            ->where('title', 'LIKE', "%{$search}%")
            ->paginate(2);

        $this->content = view('ads.index', compact( 'category', 'ads'))->render();
        return view('indexPage')->with('content',$this->content);

    }
}
