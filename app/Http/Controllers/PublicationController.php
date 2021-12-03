<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::all();
        $category = Category::all();
        return view('publication.index.indexPage', compact('ads', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lists = Category::select(['title','id'])->get()->reduce(function ($carry, $item) {
        $carry[$item->id] = $item->title;
        return $carry;
        }, []);

       return view('publication.create.createPage' , compact('lists'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')) {
			$image = $request->file('image');
        }
        $title = $request->input('title');
        $cost = $request->input('cost');
        $user = Auth::user()->id;
        $ads = new Ads;
        $ads->create([
            'title' => $title,
            'cost' => $cost,
            'user_id' => $user
        ]);
        $ads_id = DB::getPdo()->lastInsertId();
        $category_id = $request->input('category_id');
        DB::table('ads_category')->insert([
            'category_id' => $category_id,
            'ads_id' => $ads_id,
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
