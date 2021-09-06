<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use DB;

class Historyscanawb extends Model
{
	use LogsActivity;
    protected $table = 'history_scan_awb';
 
}
