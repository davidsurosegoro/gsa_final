<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Agen;
use App\Alamat;
use App\Kota;
use Auth;
use App\Kecamatan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;


class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('pages.master.alamat.index');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function datatables()
    { 
        $kota = Alamat::select("pelanggan_alamat.*", "kota.nama as namakota" )
                ->join('kota', 'kota.id', '=', 'pelanggan_alamat.idkota') 
                ->where('pelanggan_alamat.id' ,'>', '0')
                ->where('pelanggan_alamat.pelanggan_id' ,'=', Auth::user()->id)
                ->get();

    
        return Datatables::of($kota)
        ->addColumn('aksi', function ($a) { 
            
            return '
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="'.url('master/alamat/edit/'.$a['id']).'" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Customer">
                    <i class="flaticon-edit-1"></i>
                </a>
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Customer" onClick="deleteCustomer( ' . $a['id'] . ',\'' . $a['labelalamat'] . '\')"> <i class="flaticon-delete"></i> </button>
            </div>';
        })          
        ->rawColumns(['aksi'  ])
        ->make(true);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function save(Request $request)
    {    
        if($request->id == 0){
            $alamat = new Alamat();  
        }else{            
            $alamat = Alamat::where('id',$request['id'])->first(); 
        }
        $alamat->Pelanggan_id     =  Auth::user()->id; 
        $alamat->alamat           = ($request->alamat)        ? $request->alamat        : ''; 
        $alamat->kodepos          = ($request->kodepos)       ? $request->kodepos       : ''; 
        $alamat->labelalamat      = ($request->labelalamat)   ? $request->labelalamat   : ''; 
        $alamat->kecamatan        = ($request->kecamatan)     ? $request->kecamatan     : ''; 
        $alamat->oa               = ($request->oa)            ? $request->oa            : 0; 
        $alamat->idkota           = ($request->idkota)        ? $request->idkota        : 0; 
        $alamat->save();
        return redirect('master/alamat')->with('message','Alamat created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        //
        $data['kota']       = Kota::all();
        $data['kecamatan']  = kecamatan::orderBy('nama','asc')->get();
        $data['alamat']     = Alamat::find($id);
        return view("pages.master.alamat.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request){
        // $alamat = Alamat::find($request->id);
        // Alamat::find($request->id)->delete();
        Alamat::where('id',$request->id)->delete();
        return response()->json(array('alamat' => 'success'));
    }
}
