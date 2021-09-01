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
        $res = DB::table('manifest')->count();
        return  sprintf("%08s", $res );
    }
}
