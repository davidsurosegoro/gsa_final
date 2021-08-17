<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
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
        return view('pages.master.customer.create');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('pages.master.customer.edit',compact('customer'));
    }

    public function delete(Request $request){
        $customer = Customer::find($request->id)->delete();
    }

    public function save(Request $request){
        $access = FALSE;
        if($request->access == "on"){
            $access = TRUE; 
        }
        $username = strtolower(preg_replace('/\s+/', '_', $request->nama));
        $user = User::create([
            "username" => $username,
            "password" => '$2y$10$s.aYGxhPXfTPN3/Hf8i1t.UDIWZUFIOdxhUl6c56YcrF7kI0Y3g3W',
            "level" => 3
        ]);
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
            'harga_oa_ship' => substr(preg_replace('/[.,]/', '', $request->harga_oa_ship), 0, -2),
            'user_id' => $user->id,
            'can_access_satuan' => $access
        ]);
        return redirect('master/customer')->with('message','created');
    }

    public function datatables()
    {
        $customer = Customer::all();
        return Datatables::of($customer)
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
        ->rawColumns(['aksi'])
        ->make(true);
    }
}
