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
        return  'MNFST/'.sprintf("%08s", $res ).Manifest::randomChar();
    }
    
    public static function randomChar()
    {
        $seed       = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed); 
        $rand       = '';
        foreach (array_rand($seed, 3) as $k) $rand .= $seed[$k];
        return $rand;
    }
}
