<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Kota extends Model
{
	use LogsActivity;
    protected $table = 'kota';
}
