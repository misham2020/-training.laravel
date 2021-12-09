<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function destroy($id)
    {
        //
        $img = Image::find($id);
        $img->delete();
        return redirect()->back();

    }
}
