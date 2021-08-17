<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
	use LogsActivity;
    use SoftDeletes;

    protected $table = 'customer';

    protected static $logAttributes = ['nama','notelp','alamat', 'user_id','harga_koli_k','harga_koli_s','harga_koli_b','harga_koli_bb','harga_kg','harga_doc','harga_oa','harga_oa_ship','rekening','bank','rekeningatasnama','can_access_satuan'];

    protected $fillable = [
        'nama','notelp','alamat', 'user_id','harga_koli_k','harga_koli_s','harga_koli_b','harga_koli_bb','harga_kg','harga_doc','harga_oa','harga_oa_ship','rekening','bank','rekeningatasnama','can_access_satuan'
    ];
}
