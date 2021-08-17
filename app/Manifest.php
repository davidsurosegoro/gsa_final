<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Manifest extends Model
{
	use LogsActivity;
    protected $table = 'manifest';
}
