<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use DB;

class Detailqtyscanned extends Model
{
	use LogsActivity;
    protected $table = 'detail_qty_scanned';
 
}
