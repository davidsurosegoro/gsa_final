<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Kota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.master.customer.index');
    }

    public function create()
    {
        $kota = Kota::where('id','>',0)->get();
        return view('pages.master.customer.create',compact('kota'));
    }

    public function edit($id)
    {
        $kota = Kota::where('id','>',0)->get();
        $customer = Customer::find($id);
        return view('pages.master.customer.edit',compact('customer','kota'));
    }

    public function delete(Request $request){
        $customer = Customer::find($request->id);
        Customer::find($request->id)->delete();
        return response()->json(array('customer' => $customer));
    }

    public function save(Request $request){
        $access = FALSE;
        if($request->access == "on"){
            $access = TRUE; 
        }
        $is_agen = FALSE;
        if($request->is_agen == "on"){
            $is_agen = TRUE; 
        }
        $customer = Customer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'rekening' => $request->rekening,
            'bank' => $request->bank,
            'rekeningatasnama' => $request->rekeningatasnama,
            'harga_oa' => substr(preg_replace('/[.,]/', '', $request->harga_oa), 0, -2),
            'harga_koli_k' => substr(preg_replace('/[.,]/', '', $request->harga_koli_k), 0, -2),
            'harga_koli_s' => substr(preg_replace('/[.,]/', '', $request->harga_koli_s), 0, -2),
            'harga_koli_b' => substr(preg_replace('/[.,]/', '', $request->harga_koli_b), 0, -2),
            'harga_koli_bb' => substr(preg_replace('/[.,]/', '', $request->harga_koli_bb), 0, -2),
            'harga_kg' => substr(preg_replace('/[.,]/', '', $request->harga_kg), 0, -2),
            'harga_doc' => substr(preg_replace('/[.,]/', '', $request->harga_doc), 0, -2),
            'can_access_satuan' => $access,
            'kode' => $request->kode,
            'idkota' => $request->idkota,
            'jenis_out_area' => $request->jenis_out_area,
            'kodepos' => $request->kodepos,
            'is_agen' => $is_agen,
        ]);
        return redirect('master/customer')->with('message','created');
    }

    public function update(Request $request){
        $access = FALSE;
        if($request->access == "on"){
            $access = TRUE; 
        }
        $is_agen = FALSE;
        if($request->is_agen == "on"){
            $is_agen = TRUE; 
        }
        $customer  = Customer::find($request->id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'notelp' => $request->notelp,
            'rekening' => $request->rekening,
            'bank' => $request->bank,
            'rekeningatasnama' => $request->rekeningatasnama,
            'harga_oa' => substr(preg_replace('/[.,]/', '', $request->harga_oa), 0, -2),
            'harga_koli_k' => substr(preg_replace('/[.,]/', '', $request->harga_koli_k), 0, -2),
            'harga_koli_s' => substr(preg_replace('/[.,]/', '', $request->harga_koli_s), 0, -2),
            'harga_koli_b' => substr(preg_replace('/[.,]/', '', $request->harga_koli_b), 0, -2),
            'harga_koli_bb' => substr(preg_replace('/[.,]/', '', $request->harga_koli_bb), 0, -2),
            'harga_kg' => substr(preg_replace('/[.,]/', '', $request->harga_kg), 0, -2),
            'harga_doc' => substr(preg_replace('/[.,]/', '', $request->harga_doc), 0, -2),
            'can_access_satuan' => $access,
            'kode' => $request->kode,
            'idkota' => $request->idkota,
            'jenis_out_area' => $request->jenis_out_area,
            'kodepos' => $request->kodepos,
            'is_agen' => $is_agen,
        ]);
        return redirect('master/customer')->with('message','updated');
    }

    public function datatables()
    {
        $customer = Customer::all();
        return Datatables::of($customer)
        ->addColumn('akses_satuan', function($a){
            if($a->can_access_satuan):
                return '<span class="label label-lg label-success label-inline mr-2">Diberikan Hak Akses</span>';
            else:
                return '<span class="label label-lg label-danger label-inline mr-2">Tidak Diberikan</span>';
            endif;
        })
        ->addColumn('aksi', function ($a) {
            return '<div class="btn-group" role="group" aria-label="Basic example">
                <a href="'.url('master/customer/edit/'.$a['id']).'" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Customer">
                    <i class="flaticon-edit-1"></i>
                </a>
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Customer" onClick="deleteCustomer(' . $a['id'] . ')"> <i class="flaticon-delete"></i> </button>
                </div>';
        })
        ->addColumn('details_url', function($a) {
            return url('master/customer/data-harga/' . $a->id);
        })
        ->rawColumns(['aksi','akses_satuan'])
        ->make(true);
    }
}
