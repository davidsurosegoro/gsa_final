<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Alamat extends Model
{
	use LogsActivity;
    protected $table = 'pelanggan_alamat';
}
