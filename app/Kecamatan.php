<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Kecamatan extends Model
{
	use LogsActivity;
    protected $table = 'kecamatan';
}
