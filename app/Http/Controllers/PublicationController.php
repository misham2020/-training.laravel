<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Flag;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AdsRepository\AdsRepository;
use App\Http\Requests\AdsRequest;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Mixed_;

class PublicationController extends Controller
{
    /** @var AdsRepository */
    private $adsRepository;


    public function __construct(AdsRepository $adsRepository)
    {
        $this->adsRepository = $adsRepository;
        $this->adsRepository->change_flag();
    }

    public function index(): View
    {
        $user = Auth::user()->id;

        $ads = Ads::query()->where('user_id', $user)->get();

        return view('publication.index.indexPage', compact('ads'));
    }

    public function create(): View

    {
        $class = Category::class;
        $lists = $this->adsRepository->listsModel($class);

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
        $class = Category::class;
        $listsModel = $this->adsRepository->listsModel($class);
        $adsCategories = Ads::findOrFail($id)->cat()->get();
        $cat = $this->adsRepository->checkedLists($listsModel, $adsCategories);
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
        $ads = Ads::find($id);
        $ads->delete();
        return redirect(route('index.publication'));

    }
}
