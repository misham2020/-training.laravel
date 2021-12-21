<?php

namespace App\AdsRepository;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdsRepository
{
    public function addAds($request)
    {
        $ads = new Ads();
        $title = $request->title;
        $cost = $request->cost;
        $user = Auth::user()->id;
        $ads->create([
            'title' => $title,
            'cost' => $cost,
            'user_id' => $user
        ]);
        $ads_id = DB::getPdo()->lastInsertId();
        return $ads_id;
    }

    public function addCatigory($request, int $ads_id)
    {
        $category = $request->category;
        foreach ($category as $key => $value) {
            DB::table('ads_category')->insert([
                'category_id' => $value,
                'ads_id' => $ads_id,
            ]);
        }
    }

    public function addImg($request, int $ads_id)
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $img = new image();
                $image = $image->store('uploads', 'public');
                $img->create([
                    'path' => $image,
                    'ads_id' => $ads_id
                ]);
            }
        }
    }

    public function listsModel($params): Collection
    {
        return $params::select(['title', 'id'])
            ->pluck('title', 'id');
    }

    public function lists(EloquentCollection $collection): Collection
    {
        return $collection
            ->pluck('title', 'id');
    }

    public function checkedLists(Collection $collectionAll, Collection $collectionCurrent)
    {
        dump($collectionCurrent);
        dd($collectionAll->map(function ($item, $key) use ($collectionCurrent) {
            if ($key === $collectionCurrent->get($key)->id) {

            }
        }));

        //return $collectionAll->

    }

    public function updateCategory_id(array $data, int $id)
    {
        $ads = Ads::findOrFail($id);

        foreach ($data['category'] as $value) {

            DB::table('ads_category')->updateOrInsert(
                ['category_id' => $value, 'ads_id' => $ads->id],

            );
        }

    }

    public function deleteCategory_id(array $data, int $id)

    {
        $category = Category::all()->reduce(function ($carry, $item) {
            $carry[$item->id] = $item->title;
            return $carry;
        }, []);
        foreach ($category as $key => $item) {
            foreach ($data['category'] as $value) {
                if ($key != $value) {
                    DB::table('ads_category')->where(['ads_id' => $id, 'category_id' => $key])->delete();
                }
            }
        }
    }

    public function updateImage($request, int $id)
    {
       if ($request->hasFile('images')) {
            $images = $request->file('images');
            $ads = Ads::findOrFail($id);
            $img = new Image();
            foreach ($images as $image) {
                $image = $image->store('uploads', 'public');
                Image::firstOrCreate([
                    'path' => $image,
                    'ads_id' => $ads->id]);
            }
        }
    }
}
