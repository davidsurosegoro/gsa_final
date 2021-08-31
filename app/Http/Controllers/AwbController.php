<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Kota;
use App\Kecamatan;
use App\Customer;
use App\Awb;
use App\Agen;
use App\Alamat;
use App\ViewAgenKota;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;


class AwbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $is_akses_qty = "false"; $hide_qty = "false";
        $customer = Customer::find(Auth::user()->id_customer);
        if(!empty($customer)):
            if($customer->can_access_satuan == "1"):
                $is_akses_qty = "true";
            endif;
            if($customer->is_agen == "1"):
                $hide_qty = "true";
            endif;
        else:
            if(Auth::user()->level == "1"):
                $is_akses_qty = "true";
            endif;
        endif;
        return view('pages.awb.index',compact('is_akses_qty','hide_qty'));
    }

    public function edit($id){
        
        $customer = ""; $agen_tujuan = "";
        $kota = Kota::where('id','>',0)->get();
        if (Auth::user()->level == "2") :
            $customer = Customer::where('id', Auth::user()->id_customer)->first();
        elseif (Auth::user()->level == "1") :
            $customer = Customer::all();
        endif;
        $awb = Awb::find($id);

        $alamat_pengirim = Alamat::where('alamat',$awb->alamat_pengirim)->first();
        $alamat_pengirim_array = "";
        if(!isset($alamat_pengirim)):
            $alamat_pengirim = "manual";
        else:
            $alamat_pengirim_array = Alamat::where('pelanggan_id',$alamat_pengirim->pelanggan_id)->get();
        endif;

        $alamat_tujuan = Alamat::where('alamat',$awb->alamat_tujuan)->first();
        $alamat_tujuan_array = "";
        if(!isset($alamat_tujuan)):
            $alamat_tujuan = "manual";
        else:
            $alamat_tujuan_array = Alamat::where('pelanggan_id',$alamat_tujuan->pelanggan_id)->get();
        endif;
        $master_alamat = array();
        if($id !== 0){
            $master_alamat = Alamat::where('pelanggan_id',$awb->id_customer)->get();
        }
        $id = $id;
        $kecamatan_tujuan = Kecamatan::where('idkota',$awb->id_kota_tujuan)->get();
        $agen_master = ViewAgenKota::where('id',$awb->id_kota_tujuan)->get();
        $agen_tujuan = Agen::find($awb->id_agen_penerima);
        if(empty($agen_tujuan)){
            $agen_tujuan = ViewAgenKota::where('id',$awb->id_kota_tujuan)->get();
        }
        
        return view('pages.awb.create',compact('kota', 'customer','awb','agen_tujuan','agen_master','id','alamat_pengirim_array','kecamatan_tujuan','alamat_pengirim','alamat_tujuan_array','alamat_tujuan','master_alamat'));
    }

    public function save(Request $request)
    {
        $kecamatan = Kecamatan::find($request->id_kecamatan_tujuan);
        $charge_oa = $kecamatan->oa;
        $created_at = date( "Y-m-d H:i:s", strtotime( date( "Y-M-d H:i:s") ) + 7 * 3600 );
        $customer = Customer::find($request->id_customer);
        $total_harga = 0; $harga_oa = 0;
        $qty = ($request->qty == null) ? 0 : $request->qty;
        if (Auth::user()->level == "1") :
            $total_harga = $this->hitungHargaTotal($request->qty_kecil, $request->qty_sedang, $request->qty_besar, $request->qty_besar_banget, $request->qty_kg, $request->qty_dokumen, $customer, $charge_oa);
            $qty = $request->qty_kecil + $request->qty_sedang + $request->qty_besar + $request->qty_besar_banget + $request->qty_kg + $request->qty_doc;
        endif;
        if(Auth::user()->level == "3" && $customer->can_access_satuan == 1):
            $total_harga = $this->hitungHargaTotal($request->qty_kecil, $request->qty_sedang, $request->qty_besar, $request->qty_besar_banget, $request->qty_kg, $request->qty_dokumen, $customer, $charge_oa);
            $qty = $request->qty_kecil + $request->qty_sedang + $request->qty_besar + $request->qty_besar_banget + $request->qty_kg + $request->qty_doc;
        endif;
        if($request->idawb == 0):
            $awb = Awb::create([
                'noawb' => $request->noawb,
                'id_customer' => $request->id_customer,
                'id_kota_tujuan' => $request->id_kota_tujuan,
                'id_kota_asal' => $request->id_kota_asal,
                'id_kota_transit' => $request->id_kota_transit,
                'id_agen_asal' => ($request->id_agen_asal == null) ?  0 : $request->id_agen_asal,
                'id_agen_penerima' => ($request->id_agen_penerima == null) ?  0 : $request->id_agen_penerima,
                'charge_oa' => $charge_oa,
                'nama_penerima' => $request->nama_penerima,
                'alamat_tujuan' => $request->alamat_tujuan,
                'notelp_penerima' => $request->notelp_penerima,
                'kodepos_penerima' => $request->kodepos_penerima,
                'nama_pengirim' => $request->nama_pengirim,
                'alamat_pengirim' => ($request->alamat_pengirim_auto == "manual") ?  $request->alamat_pengirim : $request->alamat_pengirim_auto,
                'kodepos_pengirim' => $request->kodepos_pengirim,
                'notelp_pengirim' => $request->notelp_pengirim,
                'keterangan' => $request->keterangan,
                'total_harga' => ($total_harga['total'] == null) ? 0 : $total_harga['total'],
                'tanggal_awb' => date("Y-m-d", strtotime($request->tanggal_awb)),
                'created_by' => Auth::user()->id,
                'status_invoice' => 0,
                'status_tracking' => 'booked',
                'status_manifest' => 0,
                'status_paid_agen' => 0,
                'qty_kecil' => ($request->qty_kecil == null) ? 0 : $request->qty_kecil,
                'qty_sedang' => ($request->qty_sedang == null) ? 0 : $request->qty_sedang,
                'qty_besar' => ($request->qty_besar == null) ? 0 : $request->qty_besar,
                'qty_besarbanget' => ($request->qty_besar_banget == null) ? 0 : $request->qty_besar_banget,
                'qty_kg' => ($request->qty_kg == null) ? 0 : $request->qty_kg,
                'qty_doc' => ($request->qty_doc == null) ? 0 : $request->qty_doc,
                'qty' => ($qty == null) ? 0 : $qty,
                'id_kecamatan_tujuan' => $request->id_kecamatan_tujuan,
                'created_at' => $created_at,
                'idr_oa' => ($total_harga['oa'] == null) ? 0 : $total_harga['oa'],
                'id_manifest' => 0,
                'id_invoice' => 0,
            ]);
            return redirect('awb')->with('message', 'created');
        else:
            $before_update = Awb::find($request->idawb);
            $awb = Awb::find($request->idawb)->update([
            'noawb' => $request->noawb,
            'id_customer' => $request->id_customer,
            'id_kota_tujuan' => $request->id_kota_tujuan,
            'id_kota_asal' => $request->id_kota_asal,
            'id_kota_transit' => $request->id_kota_transit,
            'id_agen_asal' => ($request->id_agen_asal == null) ?  0 : $request->id_agen_asal,
            'id_agen_penerima' => ($request->id_agen_penerima == null) ?  0 : $request->id_agen_penerima,
            'charge_oa' => $charge_oa,
            'nama_penerima' => $request->nama_penerima,
            'alamat_tujuan' => $request->alamat_tujuan,
            'notelp_penerima' => $request->notelp_penerima,
            'kodepos_penerima' => $request->kodepos_penerima,
            'nama_pengirim' => $request->nama_pengirim,
            'alamat_pengirim' => ($request->alamat_pengirim_auto == "manual") ?  $request->alamat_pengirim : $request->alamat_pengirim_auto,
            'kodepos_pengirim' => $request->kodepos_pengirim,
            'notelp_pengirim' => $request->notelp_pengirim,
            'keterangan' => $request->keterangan,
            'total_harga' => ($total_harga['total'] == null) ? 0 : $total_harga['total'],
            'tanggal_awb' => $before_update->tanggal_awb,
            'created_by' => Auth::user()->id,
            'status_invoice' => 0,
            'status_tracking' => 'booked',
            'status_manifest' => 0,
            'status_paid_agen' => 0,
            'qty_kecil' => ($request->qty_kecil == null) ? 0 : $request->qty_kecil,
            'qty_sedang' => ($request->qty_sedang == null) ? 0 : $request->qty_sedang,
            'qty_besar' => ($request->qty_besar == null) ? 0 : $request->qty_besar,
            'qty_besarbanget' => ($request->qty_besar_banget == null) ? 0 : $request->qty_besar_banget,
            'qty_kg' => ($request->qty_kg == null) ? 0 : $request->qty_kg,
            'qty_doc' => ($request->qty_doc == null) ? 0 : $request->qty_doc,
            'qty' => ($qty == null) ? 0 : $qty,
            'id_kecamatan_tujuan' => $request->id_kecamatan_tujuan,
            'created_at' => $created_at,
            'idr_oa' => ($total_harga['oa'] == null) ? 0 : $total_harga['oa'],
            'id_manifest' => 0,
            'id_invoice' => 0,
            'tanggal_diterima' => $before_update->tanggal_diterima
        ]);
            return redirect('awb')->with('message', 'updated');
        endif;
    }

    public function delete(Request $request){
        $awb =  DB::table('awb')->where('id', $request->id)->first();
        DB::table('awb')
              ->where('id', $request->id)
              ->update(['deleted_at' => date( "Y-m-d H:i:s", strtotime( date( "Y-M-d H:i:s") ) + 7 * 3600 )]);
        return response()->json(array('awb' => $awb));
    }

    public function updateawb(Request $request){
        $kode                   = $request->kode;
        $status                 =  Crypt::decrypt($request->status);
        $returnmessage          = '';
        $typereturn             = ' ';
        $openmodal              = ($status=='complete') ? 'open' : 'close';
        //check apakah status sudah seperti yang direquest untuk diganti
        
        $awb                    =  Awb::where('noawb', $request->kode)->first();
        if(!$awb){
            $returnmessage = 'Kode AWB '.$kode.' tidak ditemukan!';
            $typereturn    = 'statuserror';
        }else if($awb->id){
            if($awb->status_tracking == $status){
                $returnmessage = 'Kode AWB '.$kode.' Sudah berstatus '.$status.'!';
                $typereturn    = 'statuswarning';
            }else{
                $awb->status_tracking   = $status;
                
                $awb->save();
        
                $data['success']        =$awb->wasChanged('status_tracking');
                $returnmessage = 'Update Kode AWB '.$kode.' ke '.$status.', sukses di update!';
                $typereturn    = 'statussuccess';
            }
            if($status=='complete'){
                $awb->tanggal_diterima = Carbon::now()->addHours(7);
            }
        } 
        return response()->json(array($typereturn => $returnmessage, 'openmodal'=>$openmodal,'awb'=>$awb));
    }
    public function updatediterima(Request $request){
        $returnmessage      = 'Data penerima berhasil disimpan';
        $typereturn         = 'statussuccess';
        $kode               = $request->kode; 
        $awb                =  Awb::where('noawb', $request->kode)->first();
        $awb->diterima_oleh = $request->diterima_oleh;
        
        $awb->save();
         
        return response()->json(array($typereturn => $returnmessage ));
    }

    public function manifest(Request $request){
        Awb::find($request->id)->update([
            'status_tracking' => 'at-manifest',
            'status_manifest' => 1
        ]);
        $awb = Awb::find($request->id);
        return response()->json(array('awb' => $awb));
    }

    public function filter_data_penerima(Request $request)
    {
        $customer = Alamat::where('alamat',$request->alamat)->first();
        return response()->json(array('customer' => $customer));
    }

    public function datatables()
    {
        $awb = DB::SELECT("SELECT a.*, ka.nama AS kota_asal,kt.nama AS kota_tujuan,ktt.nama AS kota_transit FROM awb a INNER JOIN kota ka ON (a.id_kota_asal = ka.id ) INNER JOIN kota kt ON (a.id_kota_tujuan = kt.id) LEFT JOIN kota ktt ON (a.id_kota_transit = ktt.id) WHERE a.id > 0 AND a.deleted_at IS NULL ORDER BY a.id DESC");
        if (Auth::user()->level !== "1") :
            //dd(Auth::user()->level);
            $awb = DB::SELECT("SELECT a.*, ka.nama AS kota_asal,kt.nama AS kota_tujuan,ktt.nama AS kota_transit FROM awb a INNER JOIN kota ka ON (a.id_kota_asal = ka.id ) INNER JOIN kota kt ON (a.id_kota_tujuan = kt.id) LEFT JOIN kota ktt ON (a.id_kota_transit = ktt.id) WHERE a.id_customer = ".Auth::user()->id_customer." AND a.deleted_at IS NULL ORDER BY a.id DESC");
        endif;
        $awbs = new Collection;
        foreach ($awb as $a) :
            $awbs->push([
                'id'    => $a->id,
                'noawb' => $a->noawb,
                'nama_pengirim' => $a->nama_pengirim,
                'kota_asal' => $a->kota_asal,
                'kota_tujuan' => $a->kota_tujuan,
                'kota_transit' => $a->kota_transit,
                'tanggal_awb' => date("d F Y", strtotime($a->tanggal_awb)),
                'status_tracking' => $a->status_tracking,
                'qty' => $a->qty,
                'kecil' => $a->qty_kecil,
                'sedang' => $a->qty_sedang,
                'besar' => $a->qty_besar,
                'besarbanget' => $a->qty_besarbanget,
                'doc' => $a->qty_doc,
                'kg' => $a->qty_kg,
            ]);
        endforeach;
        
        return Datatables::of($awbs)
            ->addColumn('aksi', function ($a) {
                if ($a['status_tracking'] !== 'booked' && Auth::user()->level !== "1") :
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                    <button  type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" onClick="detail('.$a['id'].',`'.$a['noawb'].'`)" data-placement="bottom" title="Lihat Data"><i class="flaticon-eye"> </i></button>
                    </div>';
                elseif ($a['status_tracking'] == 'booked' && Auth::user()->level == "1") :
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                    <a href='.url('awb/edit/'.$a['id']).' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon-edit-1" ></i>
                    </a>
                    <button  type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" onClick="updateManifest('.$a['id'].',`'.$a['noawb'].'`)" data-placement="bottom" title="Ubah ke Manifested"><i class="flaticon-truck"> </i></button>
                    <a href='.url('printout/awb/'.$a['id']).' target="_blank" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                    <i class="flaticon2-print" ></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Peta" onClick="deleteAwb(' . $a['id'] . ',`'.$a['noawb'].'`)"> <i class="flaticon-delete"></i> </button>
                    </div>';
                elseif ($a['status_tracking'] == 'booked' && Auth::user()->level == "2") :
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                    <a href='.url('awb/edit/'.$a['id']).' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon-edit-1" ></i>
                    </a> 
                    
                    <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Peta" onClick="deleteAwb(' . $a['id'] . ',`'.$a['noawb'].'`)"> <i class="flaticon-delete"></i> </button></div>';
                elseif ($a['status_tracking'] !== 'booked' && Auth::user()->level == "1") :
                    
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                    <a href='.url('awb/edit/'.$a['id']).' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon-edit-1" ></i>
                    </a>
                    <a href='.url('printout/awb/'.$a['id']).' target="_blank" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                    <i class="flaticon2-print" ></i>
                    </a>
                
                    </div>';
                endif;
            })
            ->addColumn('qty_stat',function($a){
                if($a['qty'] !== 0 || $a['kecil'] !== 0 || $a['sedang'] !== 0 || $a['besar'] !== 0 || $a['besarbanget'] !== 0 || $a['doc'] !== 0 || $a['kg'] !== 0 ):
                    return '<span style="cursor:pointer;" data-toggle="modal" data-target="#modal-koli" onClick="modalKoli('.$a['id'].')" class="label label-lg label-success label-inline mr-2"> Terisi </span>';
                else:
                    return '<span class="label label-lg label-danger label-inline mr-2"> Belum Terisi </span>';
                endif;
            })
            ->editColumn('kota_tujuan', function ($a) {
                $string = $a['kota_tujuan'];
                if ($a['kota_transit'] !== null) :
                    $string .= '<span class="label label-info label-inline mr-2">Transit ' . $a['kota_transit'] . '</span>';
                endif;
                return $string;
            })
            ->rawColumns(['kota_tujuan', 'aksi','qty_stat'])
            ->make(true);
    }

    public function koli(Request $request){
        $awb = Awb::find($request->id);
        return response()->json(array('awb' => $awb));
    }

    public function filter_kota_agen(Request $request)
    {
        $kota = ViewAgenKota::where('id', $request->kota_id)->get();
        $kecamatan = Kecamatan::where('idkota',$request->kota_id)->get();
        $view     = (string) view('pages.awb.ajax.filter_kota_agen', compact('kota'));
        $view_kecamatan     = (string) view('pages.awb.ajax.filter_kecamatan', compact('kecamatan'));
        return response()->json(array('view' => $view,'view_kecamatan' => $view_kecamatan));
    }

    public function filter_customer(Request $request){
        $customer = Customer::find($request->customer_id);
        $alamat = Alamat::where('pelanggan_id',$request->customer_id)->orderBy('id','asc')->get();
        $cbo_alamat     = (string) view('pages.awb.ajax.cbo_alamat', compact('alamat'));
        return response()->json(array('data' => $customer,'alamat' => $cbo_alamat,'count_alamat' => count($alamat)));
    }

    public function filter_alamat(Request $request){
        $alamat = Alamat::find($request->alamat_id);
        return response()->json(array('data' => $alamat));
    }

    private function hitungHargaTotal($qty_kecil, $qty_sedang, $qty_besar, $qty_besar_banget, $qty_kg, $qty_dokumen, $customer, $charge_oa)
    {
        $harga_kg = 0;
        $harga_oa = 0;
        if($qty_kg > 2):
            $harga_kg = $customer->harga_kg * 2 + (2000 *($qty_kg - 2));
        else:
            $harga_kg = $customer->harga_kg * $qty_kg; 
        endif;
        $harga_total = ($qty_kecil * $customer->harga_koli_k) + ($qty_sedang * $customer->harga_koli_s) + ($qty_besar * $customer->harga_koli_b) + ($qty_besar_banget * $customer->harga_koli_bb)  + ($qty_dokumen * $customer->harga_doc) + $harga_kg;
        if ($charge_oa == "1") :
            if ($customer->jenis_out_area == "shipment") :
                $harga_oa = 0;
            elseif ($customer->jenis_out_area == "resi") :
                $harga_oa = $customer->harga_oa;
            elseif ($customer->jenis_out_area == "koli") :
                $harga_oa = ($qty_kecil + $qty_sedang + $qty_besar + $qty_besar_banget + $qty_dokumen + $qty_kg) * $customer->harga_oa;
            endif;
        endif;
        $harga_total = $harga_total + $harga_oa;
        $tots = array('total' => $harga_total, 'oa' => $harga_oa);
        return $tots;
    }
}
