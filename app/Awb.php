<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Awb extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected $table = 'awb';


    protected static $logAttributes = ['noawb', 'id_customer', 'id_kota_tujuan', 'id_kota_asal', 'id_kota_transit', 'id_agen_asal', 'id_agen_penerima', 'charge_oa', 'alamat_tujuan', 'notelp_penerima', 'nama_penerima', 'nama_pengirim', 'keterangan', 'total_harga', 'tanggal_awb', 'status_invoice', 'status_tracking', 'status_manifest', 'status_paid_agen', 'qty_kecil', 'qty_sedang', 'qty_besar', 'qty_besarbanget', 'qty_kg', 'qty_doc', 'qty', 'created_by', 'updated_by', 'kodepos_penerima'];

    protected $fillable = [
        'noawb', 'id_customer', 'id_kota_tujuan', 'id_kota_asal', 'id_kota_transit', 'id_agen_asal', 'id_agen_penerima', 'charge_oa', 'alamat_tujuan', 'notelp_penerima', 'nama_penerima', 'nama_pengirim', 'keterangan', 'total_harga', 'tanggal_awb', 'status_invoice', 'status_tracking', 'status_manifest', 'status_paid_agen', 'qty_kecil', 'qty_sedang', 'qty_besar', 'qty_besarbanget', 'qty_kg', 'qty_doc', 'qty', 'created_by', 'updated_by', 'kodepos_penerima'
    ];
}
