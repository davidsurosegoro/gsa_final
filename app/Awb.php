<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Awb extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected $table = 'awb';


    protected static $logAttributes = ['noawb', 'id_customer', 'id_kota_tujuan', 'id_kota_asal', 'id_kota_transit', 'id_agen_asal', 'id_agen_penerima', 'charge_oa', 'alamat_tujuan', 'notelp_penerima', 'nama_penerima', 'nama_pengirim', 'keterangan', 'total_harga', 'tanggal_awb', 'status_invoice', 'status_tracking', 'status_manifest', 'status_paid_agen', 'qty_kecil', 'qty_sedang', 'qty_besar', 'qty_besarbanget', 'qty_kg', 'qty_doc', 'qty', 'created_by', 'updated_by', 'kodepos_penerima','idr_oa','id_manifest','id_invoice','kodepos_pengirim','notelp_pengirim','alamat_pengirim','tanggal_diterima','id_kecamatan_tujuan','deleted_at','is_agen','ada_faktur','referensi','jenis_koli'];


    protected $fillable = [
        'noawb', 'id_customer', 'id_kota_tujuan', 'id_kota_asal', 'id_kota_transit', 'id_agen_asal', 'id_agen_penerima', 'charge_oa', 'alamat_tujuan', 'notelp_penerima', 'nama_penerima', 'nama_pengirim', 'keterangan', 'total_harga', 'tanggal_awb', 'status_invoice', 'status_tracking', 'status_manifest', 'status_paid_agen', 'qty_kecil', 'qty_sedang', 'qty_besar', 'qty_besarbanget', 'qty_kg', 'qty_doc', 'qty', 'created_by', 'updated_by', 'kodepos_penerima','idr_oa','id_manifest','id_invoice','kodepos_pengirim','notelp_pengirim','alamat_pengirim','tanggal_diterima','id_kecamatan_tujuan','created_at','deleted_at','is_agen','ada_faktur','referensi','jenis_koli'
    ];

    public static function getNoAwb()
    {
        $res = DB::table('awb')->count();
        return  sprintf("%08s", $res );
    }
}
