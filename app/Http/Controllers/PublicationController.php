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

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(AdsRepository $a_rep)
    {
        $this->a_rep = $a_rep;
    }

    public function index()
    {
        $user = Auth::user()->id;
        $ads = Ads::where('user_id', $user)->get();

        return view('publication.index.indexPage', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lists = $this->a_rep->listsCategory();

        return view('publication.create.createPage', compact('lists'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsRequest $request)
    {
        try {
            DB::beginTransaction();
            $ads_id = $this->a_rep->addAds($request);
            $this->a_rep->addCatigory($request, $ads_id);
            $this->a_rep->addImg($request, $ads_id);


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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cat = $this->a_rep->listsCategory();
        $ads = Ads::findOrFail($id);
        return view('publication.create.createPage', compact('ads', 'cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsRequest $request, $id)
    {
        $data = $request->except('_token', '_method');
        try {
            DB::beginTransaction();
            $ads = Ads::findOrFail($id);
            $ads = $ads->fill($data);
            $ads->update();
            if (isset($data['category'])) {
                $this->a_rep->deleteCategory_id($data, $id);
                $this->a_rep->updateCategory_id($data, $id);
            }
            $this->a_rep->updateImage($request, $id);
            DB::commit();
            return redirect(route('index.publication'))->with('success', "Объявление №".$ads->id." была успешно обновлено.");
        }
        catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $ads = Ads::find($id);
        $ads->delete();
        return redirect(route('index.publication'));

    }
}
