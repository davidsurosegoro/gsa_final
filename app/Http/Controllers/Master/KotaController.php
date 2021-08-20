<?php


namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Agen;
use App\Kota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master.kota.index');
    }
    public function datatables()
    {
        $kota = Kota::where('id' ,'>', '0');
        return Datatables::of($kota)
        ->addColumn('aksi', function ($a) {
            $status='nonaktif';
            if($a['status']=='nonaktif'){$status='aktif';}
            return '
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="'.url('master/kota/edit/'.$a['id']).'" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Customer">
                    <i class="flaticon-edit-1"></i>
                </a>
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Customer" onClick="deleteCustomer(\''.$status.'\',' . $a['id'] . ',\'' . $a['nama'] . '\')"> <i class="flaticon-delete"></i> </button>
            </div>';
        })         
        ->addColumn('aktifnonaktif', function ($a) {
            $aktifnonaktif='<div class="text-center alert alert-success m-0 p-1" role="alert">AKTIF</div>';
            if($a['status']=='nonaktif'){$aktifnonaktif='<div class="alert alert-danger m-0 p-1 text-center" role="alert">NONAKTIF</div>';}
            return $aktifnonaktif;
        })
        ->rawColumns(['aksi' ,'aktifnonaktif'])
        ->make(true);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['kota']      = Kota::find($id);
        return view("pages.master.kota.edit",$data);
    }

    public function save(Request $request)
    {   
        $kotacheck = Kota::select(DB::raw("count(*) as total"))->where("kode", $request['kode'])->get();
        if($kotacheck[0]['total'] > 0){
            return redirect('master/kota/edit/0')->withInput()->with('message','kodesudahada');
        }

        $kota = new Kota(); 
        $kota->nama          = ($request->nama)        ? $request->nama        : ''; 
        $kota->kode          = ($request->kode)        ? $request->kode        : ''; 
        $kota->keterangan    = ($request->keterangan)  ? $request->keterangan  : ''; 
        $kota->save();
        return redirect('master/kota')->with('message','created');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {   
        $kotacheck = Kota::select(DB::raw("count(*) as total"))->where("kode", $request['kode'])->where("id",'<>', $request['id'])->get();
        if($kotacheck[0]['total'] > 0){
            return redirect('master/kota/edit/'.$request['id'])->withInput()->with('message','kodesudahada');
        }

        $kota = Kota::where('id',$request['id'])->first(); 
        $kota->nama          = ($request->nama)        ? $request->nama        : ''; 
        $kota->kode          = ($request->kode)        ? $request->kode        : ''; 
        $kota->keterangan    = ($request->keterangan)  ? $request->keterangan  : ''; 
        $kota->save();
        return redirect('master/kota')->with('message','updated');
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
        $kota = Kota::where('id',$request['id'])->first(); 
        $kota->status = $request['status']; 
        $kota->save();

        // $kota = Kota::find($request->id)->delete(); 
        return response()->json(array('kota' => $kota));
    }
}