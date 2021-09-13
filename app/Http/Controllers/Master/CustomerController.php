<?php

namespace App\Http\Controllers\Master;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Kota;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('pages.master.customer.index');
    }

    public function create()
    {
        $kota = Kota::where('id', '>', 0)->get();
        return view('pages.master.customer.create', compact('kota'));
    }

    public function edit($id)
    {
        $kota     = Kota::where('id', '>', 0)->get();
        $customer = Customer::find($id);
        return view('pages.master.customer.edit', compact('customer', 'kota'));
    }

    public function delete(Request $request)
    {
        $customer = Customer::find($request->id);
        Customer::find($request->id)->delete();
        return response()->json(array('customer' => $customer));
    }

    public function save(Request $request)
    {
        $access = false;
        if ($request->access == "on") {
            $access = true;
        }
        $is_agen = false;
        if ($request->is_agen == "on") {
            $is_agen = true;
        }
        $customer = Customer::create([
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'notelp'            => $request->notelp,
            // 'rekening'          => $request->rekening,
            // 'bank'              => $request->bank,
            // 'rekeningatasnama'  => $request->rekeningatasnama,
            'harga_oa'          => str_replace(',', '', $request->harga_oa),
            'harga_koli_k'      => str_replace(',', '', $request->harga_koli_k),
            'harga_koli_s'      => str_replace(',', '', $request->harga_koli_s),
            'harga_koli_b'      => str_replace(',', '', $request->harga_koli_b),
            'harga_koli_bb'     => str_replace(',', '', $request->harga_koli_bb),
            'harga_kg'          => str_replace(',', '', $request->harga_kg),
            'harga_doc'         => str_replace(',', '', $request->harga_doc),
            'can_access_satuan' => $access,
            'kode'              => $request->kode,
            'idkota'            => $request->idkota,
            'jenis_out_area'    => $request->jenis_out_area,
            'kodepos'           => $request->kodepos,
            'is_agen'           => $is_agen,
        ]);
        return redirect('master/customer')->with('message', 'created');
    }

    public function update(Request $request)
    {
        $access = false;
        if ($request->access == "on") {
            $access = true;
        }
        $is_agen = false;
        if ($request->is_agen == "on") {
            $is_agen = true;
        }
        $customer = Customer::find($request->id)->update([
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'notelp'            => $request->notelp,
            // 'rekening'          => $request->rekening,
            // 'bank'              => $request->bank,
            // 'rekeningatasnama'  => $request->rekeningatasnama,
            'harga_oa'          => str_replace(',', '', $request->harga_oa),
            'harga_koli_k'      => str_replace(',', '', $request->harga_koli_k),
            'harga_koli_s'      => str_replace(',', '', $request->harga_koli_s),
            'harga_koli_b'      => str_replace(',', '', $request->harga_koli_b),
            'harga_koli_bb'     => str_replace(',', '', $request->harga_koli_bb),
            'harga_kg'          => str_replace(',', '', $request->harga_kg),
            'harga_doc'         => str_replace(',', '', $request->harga_doc),
            'can_access_satuan' => $access,
            'kode'              => $request->kode,
            'idkota'            => $request->idkota,
            'jenis_out_area'    => $request->jenis_out_area,
            'kodepos'           => $request->kodepos,
            'is_agen'           => $is_agen,
        ]);
        return redirect('master/customer')->with('message', 'updated');
    }

    public function datatables()
    {
        $customer = Customer::all();
        return Datatables::of($customer)
            ->addColumn('akses_satuan', function ($a) {
                if ($a->can_access_satuan):
                    return '<span class="label label-lg label-success label-inline mr-2">Diberikan Hak Akses</span>';
                else:
                    return '<span class="label label-lg label-danger label-inline mr-2">Tidak Diberikan</span>';
                endif;
            })
            ->addColumn('aksi', function ($a) {
                return '<div class="btn-group" role="group" aria-label="Basic example">
                <a href="' . url('master/customer/edit/' . $a['id']) . '" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Customer">
                    <i class="flaticon-edit-1"></i>
                </a>
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Customer" onClick="deleteCustomer(' . $a['id'] . ')"> <i class="flaticon-delete"></i> </button>
                </div>';
            })
            ->addColumn('details_url', function ($a) {
                return url('master/customer/data-harga/' . $a->id);
            })
            ->rawColumns(['aksi', 'akses_satuan'])
            ->make(true);
    }
}
