<?php

namespace App\Http\Controllers;

use App\Agen;
use App\Alamat;
use App\Awb;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Kecamatan;
use App\Kota;
use App\Manifest;
use App\ViewAgenKota;
use App\Historyscanawb;
use App\Detailqtyscanned;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AwbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $is_akses_qty = "false";
        $hide_qty     = "false";
        $customer     = Customer::find(Auth::user()->id_customer);
        if (!empty($customer)):
            if ($customer->can_access_satuan == 1):
                $is_akses_qty = "true";
            endif;
            if ($customer->is_agen == 1):
                $hide_qty = "true";
            endif;
        else:
            if ((int) Auth::user()->level == 1):
                $is_akses_qty = "true";
            endif;
        endif;
        return view('pages.awb.index', compact('is_akses_qty', 'hide_qty'));
    }

    public function edit($id, $hilang)
    {

        $customer    = "";
        $agen_tujuan = "";
        $kota        = Kota::where('id', '>', 0)->get();
        if ((int) Auth::user()->level == 2):
            $customer = Customer::where('id', Auth::user()->id_customer)->first();
        elseif ((int) Auth::user()->level == 1):
            $customer = Customer::all();
        endif;
        $awb = Awb::find($id);

        $alamat_pengirim       = Alamat::where('alamat', $awb->alamat_pengirim)->first();
        $alamat_pengirim_array = "";
        if (!isset($alamat_pengirim)):
            $alamat_pengirim = "manual";
        else:
            $alamat_pengirim_array = Alamat::where('pelanggan_id', $alamat_pengirim->pelanggan_id)->get();
        endif;

        $alamat_tujuan       = Alamat::where('alamat', $awb->alamat_tujuan)->first();
        $alamat_tujuan_array = "";
        if (!isset($alamat_tujuan)):
            $alamat_tujuan = "manual";
        else:
            $alamat_tujuan_array = Alamat::where('pelanggan_id', $alamat_tujuan->pelanggan_id)->get();
        endif;
        $master_alamat = array();
        if ($id !== 0) {
            $master_alamat = Alamat::where('pelanggan_id', $awb->id_customer)->get();
        }
        $id               = $id;
        $kecamatan_tujuan = Kecamatan::where('idkota', $awb->id_kota_tujuan)->get();
        $agen_master      = ViewAgenKota::where('id', $awb->id_kota_tujuan)->get();
        $agen_tujuan      = Agen::find($awb->id_agen_penerima);
        if (empty($agen_tujuan)) {
            $agen_tujuan = ViewAgenKota::where('id', $awb->id_kota_tujuan)->get();
        }
        $hilang = $hilang;
        return view('pages.awb.create', compact('kota', 'hilang', 'customer', 'awb', 'agen_tujuan', 'agen_master', 'id', 'alamat_pengirim_array', 'kecamatan_tujuan', 'alamat_pengirim', 'alamat_tujuan_array', 'alamat_tujuan', 'master_alamat'));
    }

    public function save(Request $request)
    {
        $ada_faktur = 0;
        if ($request->ada_faktur == "on"):
            $ada_faktur = 1;
        endif;
        $noawb       = Awb::getNoAwb();
        $noawb      .= $this->randomChar();
        $kecamatan   = Kecamatan::find($request->id_kecamatan_tujuan);
        $charge_oa   = $kecamatan->oa;
        $created_at  = date("Y-m-d H:i:s", strtotime(date("Y-M-d H:i:s")) + 7 * 3600);
        $customer    = Customer::find($request->id_customer);
        $total_harga = array('total' => null, 'oa' => null);
        $harga_oa    = 0;
        $qty         = ($request->qty == null) ? 0 : $request->qty;
        if ($request->jenis_koli == "koli"):
            $request->qty_doc = 0;
            $request->qty_kg  = 0;
        elseif ($request->jenis_koli == "dokumen"):
            $request->qty_kecil        = 0;
            $request->qty_sedang       = 0;
            $request->qty_besar        = 0;
            $request->qty_besar_banget = 0;
            $request->qty_kg           = 0;
        elseif ($request->jenis_koli == "kg"):
            $request->qty_kecil        = 0;
            $request->qty_sedang       = 0;
            $request->qty_besar        = 0;
            $request->qty_besar_banget = 0;
            $request->qty_doc          = 0;
        else:
            $request->qty_kecil        = 0;
            $request->qty_sedang       = 0;
            $request->qty_besar        = 0;
            $request->qty_besar_banget = 0;
            $request->qty_doc          = 0;
            $request->qty_kg           = 0;
        endif;
        if ($customer->is_agen == 0):
            if ((int) Auth::user()->level == 1):
                $total_harga = $this->hitungHargaTotal($request->qty_kecil, $request->qty_sedang, $request->qty_besar, $request->qty_besar_banget, $request->qty_kg, $request->qty_doc, $customer, $charge_oa);
                $qty         = $request->qty_kecil + $request->qty_sedang + $request->qty_besar + $request->qty_besar_banget + $request->qty_kg + $request->qty_doc;
            endif;
            if ((int) Auth::user()->level == 2 && $customer->can_access_satuan == 1):
                $total_harga = $this->hitungHargaTotal($request->qty_kecil, $request->qty_sedang, $request->qty_besar, $request->qty_besar_banget, $request->qty_kg, $request->qty_doc, $customer, $charge_oa);
                $qty         = $request->qty_kecil + $request->qty_sedang + $request->qty_besar + $request->qty_besar_banget + $request->qty_kg + $request->qty_doc;
            endif;
        else:
            if ((int) Auth::user()->level == 1):
                $total_harga['total'] = substr(preg_replace('/[.,]/', '', $request->harga_total), 0, -2);
            endif;
        endif;
        if ($request->hilang == "hilang"):
            $total_harga['oa'] = 0;
        endif;
        $labelalamat = "";
        if($request->labelalamat !== "manual"):
            $masteralamat   = Alamat::where('alamat',$request->labelalamat)->first();
            $labelalamat    = $masteralamat->labelalamat;
        endif;
        if ($request->idawb == 0 || ($request->referensi !== "" && $request->referensi !== null)):
            $awb = Awb::create([
                'noawb'               => $noawb,
                'id_customer'         => $request->id_customer,
                'id_kota_tujuan'      => $request->id_kota_tujuan,
                'id_kota_asal'        => $request->id_kota_asal,
                'id_kota_transit'     => $request->id_kota_transit,
                'id_agen_asal'        => ($request->id_agen_asal == null) ? 0 : $request->id_agen_asal,
                'id_agen_penerima'    => ($request->id_agen_penerima == null) ? 0 : $request->id_agen_penerima,
                'charge_oa'           => $charge_oa,
                'nama_penerima'       => $request->nama_penerima,
                'alamat_tujuan'       => $request->alamat_tujuan,
                'notelp_penerima'     => $request->notelp_penerima,
                'kodepos_penerima'    => $request->kodepos_penerima,
                'nama_pengirim'       => $request->nama_pengirim,
                'alamat_pengirim'     => $request->alamat_pengirim,
                'kodepos_pengirim'    => $request->kodepos_pengirim,
                'notelp_pengirim'     => $request->notelp_pengirim,
                'keterangan'          => $request->keterangan,
                'total_harga'         => ($total_harga['total'] == null) ? 0 : $total_harga['total'],
                'tanggal_awb'         => date("Y-m-d", strtotime($request->tanggal_awb)),
                'created_by'          => Auth::user()->id,
                'status_invoice'      => 0,
                'status_tracking'     => ($request->referensi == null) ? 'booked' : 'complete',
                'status_manifest'     => 0,
                'status_paid_agen'    => 0,
                'qty_kecil'           => ($request->qty_kecil == null) ? 0 : $request->qty_kecil,
                'qty_sedang'          => ($request->qty_sedang == null) ? 0 : $request->qty_sedang,
                'qty_besar'           => ($request->qty_besar == null) ? 0 : $request->qty_besar,
                'qty_besarbanget'     => ($request->qty_besar_banget == null) ? 0 : $request->qty_besar_banget,
                'qty_kg'              => ($request->qty_kg == null) ? 0 : $request->qty_kg,
                'qty_doc'             => ($request->qty_doc == null) ? 0 : $request->qty_doc,
                'qty'                 => ($qty == null) ? 0 : $qty,
                'id_kecamatan_tujuan' => $request->id_kecamatan_tujuan,
                'created_at'          => $created_at,
                'idr_oa'              => ($total_harga['oa'] == null) ? 0 : $total_harga['oa'],
                'id_manifest'         => 0,
                'id_invoice'          => 0,
                'is_agen'             => $customer->is_agen,
                'ada_faktur'          => $ada_faktur,
                'referensi'           => $request->referensi,
                'jenis_koli'          => $request->jenis_koli,
                'labelalamat'         => $labelalamat,
            ]);
            $this->inserthistoryscan($awb->id,(($request->referensi == null) ? 'booked' : 'complete'),0);
            return redirect('awb')->with('message', 'created');
        else:
            $before_update = Awb::find($request->idawb);
            $awb           = Awb::find($request->idawb)->update([
                'id_customer'         => $request->id_customer,
                'id_kota_tujuan'      => $request->id_kota_tujuan,
                'id_kota_asal'        => $request->id_kota_asal,
                'id_kota_transit'     => $request->id_kota_transit,
                'id_agen_asal'        => ($request->id_agen_asal == null) ? 0 : $request->id_agen_asal,
                'id_agen_penerima'    => ($request->id_agen_penerima == null) ? 0 : $request->id_agen_penerima,
                'charge_oa'           => $charge_oa,
                'nama_penerima'       => $request->nama_penerima,
                'alamat_tujuan'       => $request->alamat_tujuan,
                'notelp_penerima'     => $request->notelp_penerima,
                'kodepos_penerima'    => $request->kodepos_penerima,
                'nama_pengirim'       => $request->nama_pengirim,
                'alamat_pengirim'     => $request->alamat_pengirim,
                'kodepos_pengirim'    => $request->kodepos_pengirim,
                'notelp_pengirim'     => $request->notelp_pengirim,
                'keterangan'          => $request->keterangan,
                'total_harga'         => ($total_harga['total'] == null) ? 0 : $total_harga['total'],
                'tanggal_awb'         => $before_update->tanggal_awb,
                'created_by'          => Auth::user()->id,
                'status_invoice'      => 0,
                'status_tracking'     => 'booked',
                'status_manifest'     => 0,
                'status_paid_agen'    => 0,
                'qty_kecil'           => ($request->qty_kecil == null) ? 0 : $request->qty_kecil,
                'qty_sedang'          => ($request->qty_sedang == null) ? 0 : $request->qty_sedang,
                'qty_besar'           => ($request->qty_besar == null) ? 0 : $request->qty_besar,
                'qty_besarbanget'     => ($request->qty_besar_banget == null) ? 0 : $request->qty_besar_banget,
                'qty_kg'              => ($request->qty_kg == null) ? 0 : $request->qty_kg,
                'qty_doc'             => ($request->qty_doc == null) ? 0 : $request->qty_doc,
                'qty'                 => ($qty == null) ? 0 : $qty,
                'id_kecamatan_tujuan' => $request->id_kecamatan_tujuan,
                'created_at'          => $created_at,
                'idr_oa'              => ($total_harga['oa'] == null) ? 0 : $total_harga['oa'],
                'id_manifest'         => 0,
                'id_invoice'          => 0,
                'tanggal_diterima'    => $before_update->tanggal_diterima,
                'is_agen'             => $customer->is_agen,
                'ada_faktur'          => $ada_faktur,
                'jenis_koli'          => $request->jenis_koli,
                'labelalamat'         => $labelalamat,
            ]);
            return redirect('awb')->with('message', 'updated');
        endif;
    }

    public function delete(Request $request)
    {
        $awb = DB::table('awb')->where('id', $request->id)->first();
        DB::table('awb')
            ->where('id', $request->id)
            ->update(['status_tracking' => 'cancel']);
        return response()->json(array('awb' => $awb));
    }

    public function updatemanifestqr(Request $request)
    {
        $kode          = $request->kode;
        $status        = Crypt::decrypt($request->status);
        $returnmessage = '';
        $typereturn    = ' ';
        $openmodal     = ($status == 'complete') ? 'open' : 'close';
        $manifest      = Manifest::where('kode', $request->kode)->first();
        $awb           = Awb::where('id_manifest', $manifest->id)->get();

        if (!$manifest) {
            $returnmessage = 'Kode MANIFEST ' . $kode . ' tidak ditemukan!';
            $typereturn    = 'statuserror';
        } else if ($manifest->id) {
            if ($manifest->status == $status) {
                $returnmessage = 'Kode AWB ' . $kode . ' Sudah berstatus ' . $status . '!';
                $typereturn    = 'statuswarning';
            } else {
                $manifest->status = $status;
                if ($status == 'arrived') {
                    $manifest->discan_terima_oleh        = (int) Auth::user()->id;
                    $manifest->discan_diterima_oleh_nama = Auth::user()->nama;
                    $manifest->tanggal_diterima          = Carbon::now()->addHours(7);
                }

                $manifest->save();
                if($status == 'delivering' ||$status == 'arrived'){
                    $this->inserthistoryscan(0,   (($status == 'delivering') ? 'loaded' : 'at-agen'),   $manifest['id'] );
                    DB::table('awb')->where('id_manifest', $manifest['id'])->update(['status_tracking' => (($status == 'delivering') ? 'loaded' : 'at-agen')]);
                }
                
                $data['success'] = $manifest->wasChanged('status');
                //---------------UPDATE STATUS_TRACKING DI TABLE AWB---------------------------------------------
                $returnmessage = 'Update Kode MANIFEST ' . $kode . ' ke ' . $status . ', sukses di update!';
                // echo($manifest['id']);
                $typereturn    = 'statussuccess';
            }

        }
        return response()->json(array($typereturn => $returnmessage, 'openmodal' => $openmodal, 'manifest' => $manifest, 'awb' => $awb));
    }
    
    public function updateawb(Request $request)
    {
        $kode          = $request->kode;
        $qty           = $request->qty;
        $status        = Crypt::decrypt($request->status);
        $returnmessage = '';
        $typereturn    = ' ';
        $openmodal     = 'close';
        $awb           = Awb::where('noawb', $request->kode)->first();

        if (!$awb) {
            //JIKA KODE TIDAK DITEMUKAN----------------------------------------
            $returnmessage = 'Kode AWB ' . $kode . ' tidak ditemukan!';
            $typereturn    = 'statuserror';
        } else if ($awb->id) {

            //------------HITUNG UNTUK MENDAPATKAN TOTAL QTY ORI--------------------------------
            //------------HITUNG UNTUK MENDAPATKAN TOTAL QTY ORI--------------------------------
            $qty_umum = $awb->qty;
            if($awb->qty_kecil > 0 || $awb->qty_sedang > 0 || $awb->qty_besar > 0 || $awb->qty_besarbanget > 0){
                $qty_umum = $awb->qty_kecil + $awb->qty_sedang + $awb->qty_besar + $awb->qty_besarbanget;
            }
            if($awb->qty_kg > 0){
                $qty_umum = 1;
            }
            if($awb->qty_doc > 0){
                $qty_umum = $awb->qty_doc;
            } 
            //--JIKA KODE AWB , dengan URUTAN ke sekian, sudah discan atau belum
            // $get_detail        = Detailqtyscanned::where('idawb',    '=', $awb->id)->where('status',   '=', $status);
            $qty_count_scanned = Detailqtyscanned::where('idawb',    '=', $awb->id)->where('status',   '=', $status)->where('qty_ke',   '=', $qty)->count();
            $total_scanned     = Detailqtyscanned::where('idawb',    '=', $awb->id)->where('status',   '=', $status)->count(); 
             
            if($qty_count_scanned>=1 && $qty != 'all'){
                $typereturn    = 'statuswarning';
                $returnmessage = 'Kode AWB ' . $kode . ', dengan urutan <b>ke-'.$qty.'</b>, Sudah discan ' . $status . '!';
                return response()->json(array($typereturn => $returnmessage, 'openmodal' => $openmodal, 'awb' => $awb));
            } 
            
            // if ($awb->status_tracking == $status) {
            //     //JIKA KODE TIDAK DITEMUKAN----------------------------------------
            //     $returnmessage = 'Kode AWB ' . $kode . ' Sudah berstatus ' . $status . '!';
            //     $typereturn    = 'statuswarning';
            // } 
            else {
                // dd($total_scanned);
                $awb->status_tracking = $status;
                $awb->save();

                if($total_scanned==0){
                    $this->inserthistoryscan($awb->id,$status,0);
                }
                for($i=1; $i<=($qty=='all' ? $qty_umum : 1);$i++){
                    $this->insertqty($status, $awb->id, $qty_umum, ($qty=='all' ? $i : $qty));
                }
                $total_scanned   = Detailqtyscanned::where('idawb',    '=', $awb->id)->where('status',   '=', $status)->count(); 
                $data['success'] = $awb->wasChanged('status_tracking');
                $returnmessage   = 'Update Kode AWB ' . $kode . ', ke ' . $status . ', dengan urutan ke-'.$qty.' sukses di update!';
                $typereturn      = 'statussuccess';
            }
            if ($status == 'complete' && ((int)$total_scanned == (int)$qty_umum)) {
                $awb->tanggal_diterima = Carbon::now()->addHours(7);
                $openmodal = 'open';
            }
        }
        return response()->json(array($typereturn => $returnmessage, 'openmodal' => $openmodal, 'awb' => $awb));
    }

    public function insertqty($status,$idawb,$qty_ori,$qty_ke)
    {
        $Detailqtyscanned           = new Detailqtyscanned();  
        $Detailqtyscanned->idawb    = $idawb;  
        $Detailqtyscanned->qty_ke   = $qty_ke;  
        $Detailqtyscanned->qty_ori  = $qty_ori;  
        $Detailqtyscanned->status   = $status;  
        $Detailqtyscanned->save();

    }
    
    public function inserthistoryscan($idawb,$tipe,$idmanifest)
    {
        if($idmanifest==0){
            $Historyscanawb             = new Historyscanawb();  
            $Historyscanawb->tipe       = $tipe;
            $Historyscanawb->iduser     = Auth::user()->id;
            $Historyscanawb->namauser   = Auth::user()->nama;
            $Historyscanawb->idawb      = $idawb;
            $Historyscanawb->created_at = Carbon::now()->addHours(7);            
            $Historyscanawb->save(); 
        }else{
            $awb_get_for_history['awb'] =  Awb::select('awb.*' )
                    ->where ("awb.id_manifest", '=' , $idmanifest)                    
                    ->get(); 
            foreach ($awb_get_for_history['awb'] as $item){  
                // dd($Historyscanawb);
                $Historyscanawb             = new Historyscanawb();  
                $Historyscanawb->tipe       = $tipe;
                $Historyscanawb->iduser     = Auth::user()->id;
                $Historyscanawb->namauser   = Auth::user()->nama;
                $Historyscanawb->idawb      = $item->id;
                $Historyscanawb->created_at = Carbon::now()->addHours(7);            
                $Historyscanawb->save(); 
                //------------HITUNG UNTUK MENDAPATKAN TOTAL QTY ORI--------------------------------
                //------------HITUNG UNTUK MENDAPATKAN TOTAL QTY ORI-------------------------------- 
                $qty_umum = $item->qty;
                if($item->qty_kecil > 0 || $item->qty_sedang > 0 || $item->qty_besar > 0 || $item->qty_besarbanget > 0){
                    $qty_umum = $item->qty_kecil + $item->qty_sedang + $item->qty_besar + $item->qty_besarbanget;
                }
                if($item->qty_kg > 0){
                    $qty_umum = 1;
                }
                if($item->qty_doc > 0){
                    $qty_umum = $item->qty_doc;
                }
                
                for($i=1; $i<= $qty_umum;$i++){
                    $this->insertqty($tipe, $item->id, $qty_umum,  $i);
                }

            }
        }
    }

    public function updatediterima(Request $request)
    {
        $returnmessage      = 'Data penerima berhasil disimpan';
        $typereturn         = 'statussuccess';
        $kode               = $request->kode;
        $awb                = Awb::where('noawb', $request->kode)->first();
        $awb->diterima_oleh = $request->diterima_oleh;

        $awb->save();

        return response()->json(array($typereturn => $returnmessage));
    }

    public function updatetomanifest(Request $request)
    {
        $returnmessage = '';
        $typereturn    = 'status';
        $kode          = $request->id;
        $awb           = Awb::where('id', $request->id)->first();
        if ($awb->status_tracking == 'booked') {
            $awb->status_tracking = 'at-manifest';
            $awb->save();
            $this->inserthistoryscan($awb->id,'at-manifest',0);
            $returnmessage = 'Status AWB berhasil dirubah ke "at-manifest"';
        }
        // else if($awb->status_tracking == 'at-manifest'){
        //     $returnmessage      = 'Status AWB sudah '.$awb->status_tracking;
        // }

        return response()->json(array($typereturn => $returnmessage));
    }

    public function manifest(Request $request)
    {
        Awb::find($request->id)->update([
            'status_tracking' => 'at-manifest',
            'status_manifest' => 1,
        ]);
        $awb = Awb::find($request->id);
        return response()->json(array('awb' => $awb));
    }

    public function filter_data_penerima(Request $request)
    {
        $customer = Alamat::where('alamat', $request->alamat)->first();
        return response()->json(array('customer' => $customer));
    }

    public function datatables()
    {
        $awb = DB::SELECT("SELECT a.*, ka.nama AS kota_asal,kt.nama AS kota_tujuan,ktt.nama AS kota_transit FROM awb a INNER JOIN kota ka ON (a.id_kota_asal = ka.id ) INNER JOIN kota kt ON (a.id_kota_tujuan = kt.id) LEFT JOIN kota ktt ON (a.id_kota_transit = ktt.id) WHERE a.id > 0 AND a.deleted_at IS NULL ORDER BY a.id DESC");
        if ((int) Auth::user()->level !== 1):
            //dd(Auth::user()->level);
            $awb = DB::SELECT("SELECT a.*, ka.nama AS kota_asal,kt.nama AS kota_tujuan,ktt.nama AS kota_transit FROM awb a INNER JOIN kota ka ON (a.id_kota_asal = ka.id ) INNER JOIN kota kt ON (a.id_kota_tujuan = kt.id) LEFT JOIN kota ktt ON (a.id_kota_transit = ktt.id) WHERE a.id_customer = " . Auth::user()->id_customer . " AND a.deleted_at IS NULL ORDER BY a.id DESC");
        endif;
        $awbs = new Collection;
        foreach ($awb as $a):
            $awbs->push([
                'id'              => $a->id,
                'noawb'           => $a->noawb,
                'nama_pengirim'   => $a->nama_pengirim,
                'kota_asal'       => $a->kota_asal,
                'kota_tujuan'     => $a->kota_tujuan,
                'kota_transit'    => $a->kota_transit,
                'tanggal_awb'     => date("d F Y", strtotime($a->tanggal_awb)),
                'status_tracking' => $a->status_tracking,
                'qty'             => $a->qty,
                'kecil'           => $a->qty_kecil,
                'sedang'          => $a->qty_sedang,
                'besar'           => $a->qty_besar,
                'besarbanget'     => $a->qty_besarbanget,
                'doc'             => $a->qty_doc,
                'kg'              => $a->qty_kg,
            ]);
        endforeach;
        return Datatables::of($awbs)
            ->addColumn('aksi', function ($a) {
                if ($a['status_tracking'] !== 'booked' && (int) (int) Auth::user()->level !== 1):
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                        <button  type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="modal" data-target="#modal-show" onClick="detail(' . $a['id'] . ',`' . $a['noawb'] . '`)" data-placement="bottom" title="Lihat Data"><i class="flaticon-eye"> </i></button>
                        </div>';
                elseif ($a['status_tracking'] == 'booked' && (int) Auth::user()->level == 1):
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href=' . url('awb/edit/' . $a['id'] . '/edit') . ' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                            <i class="flaticon-edit-1" ></i>
                        </a>
                        <button  type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" onClick="updateManifest(' . $a['id'] . ',`' . $a['noawb'] . '`)" data-placement="bottom" title="Ubah ke Manifested"><i class="flaticon-truck"> </i></button>
                        <a href=' . url('printout/awb/' . $a['id']) . ' target="_blank" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon2-print" ></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Peta" onClick="deleteAwb(' . $a['id'] . ',`' . $a['noawb'] . '`)"> <i class="flaticon-delete"></i> </button>
                        <a href=' . url('awb/edit/' . $a['id'] . '/hilang') . ' class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Input Barang Hilang">
                        <i class="flaticon-exclamation" ></i>
                        </a>
                        </div>';
                elseif ($a['status_tracking'] == 'booked' && (int) Auth::user()->level == 2):
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href=' . url('awb/edit/' . $a['id'] . '/edit') . ' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                            <i class="flaticon-edit-1" ></i>
                        </a>

                        <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Peta" onClick="deleteAwb(' . $a['id'] . ',`' . $a['noawb'] . '`)"> <i class="flaticon-delete"></i> </button></div>';
                elseif ($a['status_tracking'] !== 'booked' && (int) Auth::user()->level == 1):

                    return '<div class="btn-group" role="group" aria-label="Basic example">
                        <a href=' . url('awb/edit/' . $a['id'] . '/edit') . ' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                            <i class="flaticon-edit-1" ></i>
                        </a>
                        <a href=' . url('printout/awb/' . $a['id']) . ' target="_blank" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon2-print" ></i>
                        </a>

                        <a href=' . url('awb/edit/' . $a['id'] . '/hilang') . ' class="btn btn-sm btn-icon btn-bg-light btn-icon-danger btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Input Barang Hilang">
                        <i class="flaticon-exclamation" ></i>
                        </a>
                        </div>';
                endif;
            })
            ->addColumn('qty_stat', function ($a) {
                if ($a['qty'] !== 0 || $a['kecil'] !== 0 || $a['sedang'] !== 0 || $a['besar'] !== 0 || $a['besarbanget'] !== 0 || $a['doc'] !== 0 || $a['kg'] !== 0):
                    return '<span style="cursor:pointer;" data-toggle="modal" data-target="#modal-koli" onClick="modalKoli(' . $a['id'] . ')" class="label label-lg label-success label-inline mr-2"> Terisi </span>';
                else:
                    return '<span class="label label-lg label-danger label-inline mr-2"> Belum Terisi </span>';
                endif;
            })
            ->editColumn('kota_tujuan', function ($a) {
                $string = $a['kota_tujuan'];
                if ($a['kota_transit'] !== null):
                    $string .= '<span class="label label-info label-inline mr-2">Transit ' . $a['kota_transit'] . '</span>';
                endif;
                return $string;
            })
            ->editColumn('status_tracking', function ($a) {
                if ($a['status_tracking'] == 'booked'):
                    return '<span class="badge badge-info"><i class="fas fa-clipboard-list"  style="color:white;"></i>&nbsp;' . $a['status_tracking'] . '</span>';
                elseif ($a['status_tracking'] == 'at-manifest'):
                    return '<span class="badge badge-dark"><i class="fa fa-truck"  style="color:white;"></i>&nbsp;' . $a['status_tracking'] . '</span>';
                elseif ($a['status_tracking'] == 'loaded'):
                    return '<span class="badge badge-primary"><i class="fas fa-truck-loading"  style="color:white;"></i>&nbsp;' . $a['status_tracking'] . '</span>';
                elseif ($a['status_tracking'] == 'at-agen'):
                    return '<span class="badge badge-dark"><i class="fas fa-user-friends"  style="color:white;"></i>&nbsp;' . $a['status_tracking'] . '</span>';
                elseif ($a['status_tracking'] == 'delivery-by-courier'):
                    return '<span class="badge badge-warning"><i class="fa fa-motorcycle"  style="color:white;"></i>&nbsp;' . $a['status_tracking'] . '</span>';
                elseif ($a['status_tracking'] == 'complete'):
                    return '<span class="badge badge-success"><i class="fa fa-check-circle"  style="color:white;"></i>&nbsp;' . $a['status_tracking'] . '</span>';
                elseif ($a['status_tracking'] == 'cancel'):
                    return '<span class="badge badge-danger"><i class="fa fa-times-circle"  style="color:white;"></i>&nbsp;' . $a['status_tracking'] . '</span>';
                endif;
            })
            ->rawColumns(['kota_tujuan', 'aksi', 'qty_stat', 'status_tracking'])
            ->make(true);
    }

    public function koli(Request $request)
    {
        $awb = Awb::find($request->id);
        return response()->json(array('awb' => $awb));
    }

    public function show(Request $request)
    {
        $awb          = Awb::find($request->id);
        $kota_tujuan  = Kota::find($awb->id_kota_tujuan);
        $kota_asal    = Kota::find($awb->id_kota_asal);
        $kota_transit = Kota::find($awb->id_kota_transit);
        $agen_tujuan  = Agen::find($awb->id_agen_penerima);
        $view         = (string) view('pages.awb.ajax.show', compact('kota_asal', 'kota_transit', 'kota_tujuan', 'awb', 'agen_tujuan'));
        return response()->json(array('view' => $view));
    }

    public function filter_kota_agen(Request $request)
    {
        $kota           = ViewAgenKota::where('id', $request->kota_id)->get();
        $kecamatan      = Kecamatan::where('idkota', $request->kota_id)->get();
        $view           = (string) view('pages.awb.ajax.filter_kota_agen', compact('kota'));
        $view_kecamatan = (string) view('pages.awb.ajax.filter_kecamatan', compact('kecamatan'));
        return response()->json(array('view' => $view, 'view_kecamatan' => $view_kecamatan));
    }

    public function filter_customer(Request $request)
    {
        $customer   = Customer::find($request->customer_id);
        $alamat     = Alamat::where('pelanggan_id', $request->customer_id)->orderBy('id', 'asc')->get();
        $cbo_alamat = (string) view('pages.awb.ajax.cbo_alamat', compact('alamat'));
        return response()->json(array('data' => $customer, 'alamat' => $cbo_alamat, 'count_alamat' => count($alamat)));
    }

    public function filter_alamat(Request $request)
    {
        $alamat = Alamat::find($request->alamat_id);
        return response()->json(array('data' => $alamat));
    }

    public function updateHarga($id)
    {
        $customer = Customer::find($awb->id_customer);
        //dd($customer);
        $total = $this->hitungHargaTotal($awb->qty_kecil, $awb->qty_sedang, $awb->qty_besar, $awb->qty_besarbanget, $awb->qty_kg, $awb->qty_doc, $customer, $awb->charge_oa);
    }

    private function hitungHargaTotal($qty_kecil, $qty_sedang, $qty_besar, $qty_besar_banget, $qty_kg, $qty_dokumen, $customer, $charge_oa)
    {
        $harga_kg = 0;
        $harga_oa = 0;
        if ($qty_kg > 2):
            $harga_kg = $customer->harga_kg * 2 + (2000 * ($qty_kg - 2));
        else:
            $harga_kg = $customer->harga_kg * $qty_kg;
        endif;
        $harga_total = ($qty_kecil * $customer->harga_koli_k) + ($qty_sedang * $customer->harga_koli_s) + ($qty_besar * $customer->harga_koli_b) + ($qty_besar_banget * $customer->harga_koli_bb) + ($qty_dokumen * $customer->harga_doc) + $harga_kg;
        if ($charge_oa == 1):
            if ($customer->jenis_out_area == "shipment"):
                $harga_oa = 0;
            elseif ($customer->jenis_out_area == "resi"):
                $harga_oa = $customer->harga_oa;
            elseif ($customer->jenis_out_area == "koli"):
                $harga_oa = ($qty_kecil + $qty_sedang + $qty_besar + $qty_besar_banget + $qty_dokumen + $qty_kg) * $customer->harga_oa;
            endif;
        endif;
        $harga_total = $harga_total + $harga_oa;
        $tots        = array('total' => $harga_total, 'oa' => $harga_oa);
        return $tots;
    }

    private function randomChar()
    {
        $seed       = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed); 
        $rand       = '';
        foreach (array_rand($seed, 3) as $k) $rand .= $seed[$k];
        return $rand;
    }
}
