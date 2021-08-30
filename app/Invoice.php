<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use DB;

class Invoice extends Model
{
	use LogsActivity;
    protected $table = 'invoice';

    public static function getNoInvoice()
    {
        $res = DB::table('invoice')->count();
        return  sprintf("%04s", $res  ).'/INV/GSA/'.Carbon::now()->month.'/'.Carbon::now()->year;
    }
}
