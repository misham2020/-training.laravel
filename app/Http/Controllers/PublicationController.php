<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AdsRepository\AdsRepository;
use App\Http\Requests\AdsRequest;
use Illuminate\View\View;

class PublicationController extends Controller
{
    /** @var AdsRepository */
    private $adsRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(AdsRepository $adsRepository)
    {
        $this->adsRepository = $adsRepository;
    }

    public function index()
    {
        $user = Auth::user()->id;
        $ads = Ads::where('user_id', $user)->get();

        return view('publication.index.indexPage', compact('ads'));
    }

    public function create()

    {
        $params = Category::class;
        $lists = $this->adsRepository->listsModel($params);

        return view('publication.create.createPage', compact('lists'));

    }


    public function store(AdsRequest $request)
    {
        try {
            DB::beginTransaction();
            $ads_id = $this->adsRepository->addAds($request);
            $this->adsRepository->addCatigory($request, $ads_id);
            $this->adsRepository->addImg($request, $ads_id);


            DB::commit();
            return redirect(route('index.publication'))->with('success', "Запись была успешно добавлена.");
        }
        catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
        }

        //return redirect(route('index.publication'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $params = Category::class;
        $cat = $this->adsRepository->listsModel($params);
        $ads = Ads::findOrFail($id);
        $adsCategories = Ads::findOrFail($id)->cat()->get();

        //$categoriesList = $this->adsRepository->checkedLists($cat, $adsCategories);
        $cat = $this->adsRepository->checkedLists($cat, $adsCategories);
        /*
        foreach ($cat as $key1 => $value1) {
            foreach ($ads_cat as $key => $value) {
                if ($key == $key1)
                    $cat[$key1] = ['title' => $value1, 'checked' => true];
                else
                    $cat[$key1] = ['title' => $value1, 'checked' => false];
            }
        }*/

        $ads = Ads::findOrFail($id);
        return view('publication.create.createPage', compact('ads', 'cat'));
    }

    public function update(AdsRequest $request, int $id)
    {
        $data = $request->except('_token', '_method');
        try {
            DB::beginTransaction();
            $ads = Ads::findOrFail($id);
            if (isset($ads)) {
                $ads = $ads->fill($data);
                $ads->update();
            }
            if (isset($data['category'])) {
                $this->adsRepository->deleteCategory_id($data, $id);
                $this->adsRepository->updateCategory_id($data, $id);
            }
            $this->adsRepository->updateImage($request, $id);
            DB::commit();
            return redirect(route('index.publication'))->with('success', "Объявление №".$ads->id." была успешно обновлено.");
        }
        catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
        }

    }


    public function destroy(int $id)
    {
        //
        $ads = Ads::find($id);
        $ads->delete();
        return redirect(route('index.publication'));

    }
}
