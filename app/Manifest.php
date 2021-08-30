<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use DB;

class Manifest extends Model
{
	use LogsActivity;
    protected $table = 'manifest';

    public static function getNoManifest()
    {
        $res = DB::table("manifest")->select(DB::raw("kode"))
            ->orderBy('kode', 'desc')->first();
        $res = ($res && $res ='') ? 0 : $res;
        return  sprintf("%08s", $res ? $res->kode + 1 : 1);
    }
}
