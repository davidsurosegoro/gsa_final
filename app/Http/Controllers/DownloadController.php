<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Map;
use App\Token;

class DownloadController extends Controller
{
    public function download_lidar(Request $request)
    {
        $token_db = Token::first();
        if ($token_db->token == md5($request->token)):
            return response()->download(storage_path("app/public/SURABAYA_JPEG.tif"));
        endif;
    }

    public function lidar_form()
    {
        return view('pages.popup.download.lidar');
    }
}
