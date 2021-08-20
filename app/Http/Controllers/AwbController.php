<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Kota;
use App\Customer;
use App\Awb;
use App\Agen;
use App\ViewAgenKota;
use Illuminate\Support\Collection;
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
        return view('pages.awb.index');
    }

    public function create()
    {
        $customer;
        $kota = Kota::all();
        if (Auth::user()->level == 3) :
            $customer = Customer::where('id', Auth::user()->id_customer)->first();
        elseif (Auth::user()->level == 1) :
            $customer = Customer::all();
        endif;
        return view('pages.awb.create', compact('kota', 'customer'));
    }

    public function edit($id){
        
        $customer;
        $customer;
        $kota = Kota::all();
        if (Auth::user()->level == 3) :
            $customer = Customer::where('id', Auth::user()->id_customer)->first();
        elseif (Auth::user()->level == 1) :
            $customer = Customer::all();
        endif;
        $awb = Awb::find($id);
        $agen_asal = Agen::find($awb->id_agen_asal);
        $agen_tujuan = Agen::find($awb->id_agen_tujuan);
        return view('pages.awb.edit',compact('kota', 'customer','awb','agen_asal','agen_tujuan'));
    }

    public function save(Request $request)
    {
        $charge_oa = FALSE;
        if ($request->charge_oa == "on") {
            $charge_oa = TRUE;
        }
        $customer = Customer::find($request->id_customer);
        $total_harga = 0;
        $qty = ($request->qty == null) ? 0 : $request->qty;
        if (Auth::user()->level == 1) :
            $total_harga = $this->hitungHargaTotal($request->qty_kecil, $request->qty_sedang, $request->qty_besar, $request->qty_besar_banget, $request->qty_kg, $request->qty_dokumen, $customer, $request->charge_oa);
        endif;
        if(Auth::user()->level == 3 && $customer->can_access_satuan == 1):
            $qty = $request->qty_kecil + $request->qty_sedang + $request->qty_besar + $request->qty_besar_banget + $request->qty_kg + $request->qty_doc;
        endif;
        $awb = Awb::create([
            'noawb' => $request->noawb,
            'id_customer' => $request->id_customer,
            'id_kota_tujuan' => $request->id_kota_tujuan,
            'id_kota_asal' => $request->id_kota_asal,
            'id_kota_transit' => $request->id_kota_transit,
            'id_agen_asal' => ($request->id_agen_asal == null) ?  0 : $request->id_agen_asal,
            'id_agen_penerima' => ($request->id_agen_penerima == null) ?  0 : $request->id_agen_penerima,
            'charge_oa' => $charge_oa,
            'alamat_tujuan' => $request->alamat_tujuan,
            'notelp_penerima' => $request->notelp_penerima,
            'nama_penerima' => $request->nama_penerima,
            'nama_pengirim' => $customer->nama,
            'keterangan' => $request->keterangan,
            'total_harga' => $total_harga,
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
            'kodepos_penerima' => $request->kodepos_penerima,
        ]);

        return redirect('awb')->with('message', 'created');
    }

    public function datatables()
    {
        $awb = DB::SELECT("SELECT a.*, ka.nama AS kota_asal,kt.nama AS kota_tujuan,ktt.nama AS kota_transit FROM awb a INNER JOIN kota ka ON (a.id_kota_asal = ka.id ) INNER JOIN kota kt ON (a.id_kota_tujuan = kt.id) LEFT JOIN kota ktt ON (a.id_kota_transit = ktt.id)");
        if (Auth::user()->level !== 1) :
            $awb = DB::SELECT("SELECT a.*, ka.nama AS kota_asal,kt.nama AS kota_tujuan,ktt.nama AS kota_transit FROM awb a INNER JOIN kota ka ON (a.id_kota_asal = ka.id ) INNER JOIN kota kt ON (a.id_kota_tujuan = kt.id) LEFT JOIN kota ktt ON (a.id_kota_transit = ktt.id)");
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
                'qty' => $a->qty
            ]);
        endforeach;
        
        return Datatables::of($awbs)
            ->addColumn('aksi', function ($a) {
                if ($a['status_tracking'] !== 'booked' && Auth::user()->level !== 1) :
                    return '<span class="label label-info label-inline mr-2">' . $a['status_tracking'] . '</span>';
                elseif ($a['status_tracking'] == 'booked' && Auth::user()->level == 1) :
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                    <a href='.url('awb/edit/'.$a['id']).' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon-edit-1" ></i>
                    </a>
                    <button  type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Ubah ke Manifested"><i class="flaticon-truck"> </i></button>
                    </div>';
                elseif ($a['status_tracking'] == 'booked' && Auth::user()->level == 3) :
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                    <a href='.url('awb/edit/'.$a['id']).' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon-edit-1" ></i>
                    </a> </div>';
                elseif ($a['status_tracking'] !== 'booked' && Auth::user()->level == 1) :
                    
                    return '<div class="btn-group" role="group" aria-label="Basic example">
                    <a href='.url('awb/edit/'.$a['id']).' class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit AWB">
                        <i class="flaticon-edit-1" ></i>
                    </a>
                    </div>';
                endif;
            })
            ->editColumn('kota_tujuan', function ($a) {
                $string = $a['kota_tujuan'];
                if ($a['kota_transit'] !== null) :
                    $string .= '<span class="label label-info label-inline mr-2">Transit ' . $a['kota_transit'] . '</span>';
                endif;
                return $string;
            })
            ->rawColumns(['kota_tujuan', 'aksi'])
            ->make(true);
    }

    public function filter_kota_agen(Request $request)
    {
        $kota = ViewAgenKota::where('id', $request->kota_id)->get();
        $view     = (string) view('pages.awb.ajax.filter_kota_agen', compact('kota'));
        return response()->json(array('view' => $view));
    }

    private function hitungHargaTotal($qty_kecil, $qty_sedang, $qty_besar, $qty_besar_banget, $qty_kg, $qty_dokumen, $customer, $charge_oa)
    {
        $harga_total = ($qty_kecil * $customer->harga_koli_k) + ($qty_sedang * $customer->harga_koli_s) + ($qty_besar * $customer->harga_koli_b) + ($qty_besar_banget * $customer->harga_koli_bb)  + ($qty_kg * $customer->harga_kg) + ($qty_dokumen * $customer->harga_doc);
        if ($charge_oa == "on") :
            if ($customer->jenis_out_area == "shipment") :
                $harga_total = $harga_total + $customer->harga_oa_ship;
            elseif ($customer->jenis_out_area == "resi") :
                $harga_total = $harga_total + $customer->harga_oa;
            else :
                $harga_total = $harga_total + $harga_total;
            endif;
        endif;
        return $harga_total;
    }
}
