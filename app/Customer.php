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

    protected static $logAttributes = ['nama','notelp','alamat','harga_koli_k','harga_koli_s','harga_koli_b','harga_koli_bb','harga_kg','harga_doc','harga_oa','rekening','bank','rekeningatasnama','can_access_satuan','jenis_out_area','kode','idkota'];

    protected $fillable = [
        'nama','notelp','alamat','harga_koli_k','harga_koli_s','harga_koli_b','harga_koli_bb','harga_kg','harga_doc','harga_oa','rekening','bank','rekeningatasnama','can_access_satuan','jenis_out_area','kode','idkota'
    ];
}
