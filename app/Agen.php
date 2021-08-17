<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agen extends Model
{
	use LogsActivity;
    use SoftDeletes;
    protected $table = 'agen';

    
    protected static $logAttributes = ['nama', 'idkota','kode'];

    protected $fillable = [
        'nama', 'idkota','user_id','kode'
    ];
}
