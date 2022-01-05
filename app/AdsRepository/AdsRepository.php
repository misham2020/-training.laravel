<?php

namespace App\AdsRepository;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Flag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdsRepository
{
    const MONTH = 60 * 60 * 24 * 30;
    const WEEK = 60 * 60 * 24 * 7;
    const DAY = 60 * 60 * 24;

    public function getStatusId($status)
    {
        return Flag::query()->where('name', $status)->first()->id;
    }

    public function addAds($request)
    {
        $ads = new Ads();
        $flag = $this->getStatusId('work');
        $title = $request->title;
        $cost = $request->cost;
        $user = Auth::user()->id;
        $ads->create([
            'title' => $title,
            'cost' => $cost,
            'user_id' => $user,
            'flags_id' => $flag
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

    public function change_flag()
    {
        $flag = $this->getStatusId('rejection');
        $now_time = now()->timestamp;
        $ads = Ads::all();
        ($ads->map(function ($item) use ($now_time, $flag) {
            $time = ($item->created_at)->timestamp;
            $dif_time = $now_time - $time;
            if ($dif_time > self::MONTH) {
                $ads = Ads::find($item->id);
                Ads::where('id', $ads->id)->update(['flags_id' => $flag]);
            }
        }));
    }

    public function listsModel($class): Collection
    {
        return $class::select(['title', 'id'])
            ->pluck('title', 'id');
    }

    public function lists(EloquentCollection $collection): Collection
    {
        return $collection
            ->pluck('title', 'id');
    }

    public function checkedLists(Collection $collectionAll, Collection $collectionCurrent)
    {
        ($collectionAll->transform(function ($item1, $key1) use ($collectionCurrent) {
            $item1 = collect($item1);
            foreach ($collectionCurrent as $item) {
                if ($item->id === $key1) {
                    return $item1->put($key1, 'checked')->values();
                }
            }
            return $item1->filter()->put($key1, false)->values();

        }));
        return $collectionAll;
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
        $class = Category::class;
        $category = $this->listsModel($class);
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
