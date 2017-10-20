<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use Illuminate\Support\Facades\Storage;
use File;

class PictureController extends Controller
{
    static public function add(Request $request) {


        //Формируем случайное уникальное название файла
        $uid = md5(uniqid(rand(), true));
        $path = 'upload/images/notes/';
        $fileName = $uid.'.'.\File::extension($request->picture);
        $request->picture->move(public_path($path), $fileName);
        $picture = Picture::create(['path' => $path.$fileName]);
        return $picture->id;
    }

    static public function remove($id) {
        // Находим соответсвующую запись //
        $picture = Picture::find($id);
        // Удаляем файл физически с сервера , а также удаляем запись//
        if(File::delete($picture->path) && $picture->delete()) {
            return true;
        }
    }
}
