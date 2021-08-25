<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Kecamatan;
use Illuminate\Support\Facades\Hash;
use App\Agen;
use App\Kota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
         $data['kecamatan']      = Kecamatan::find($id);
         return view("pages.master.kota.edit",$data);
    }
    public function datatables(Request $request)
    {
        $kecamatan = Kecamatan::where('idkota', $request->id)->orderBy('id','desc')->get();
        return response()->json(array('data' => $kecamatan));
    }
    public function save(Request $request)
    {   if($request->idkec && $request->idkec > 0){
            $kota = Kecamatan::where('id',$request['idkec'])->first(); 
        }else{
            $kota = new Kecamatan(); 
        }
        $kota->nama          = ($request->nama)        ? $request->nama        : ''; 
        $kota->idkota        = ($request->idkota)      ? $request->idkota      : ''; 
        $kota->oa            = ($request->oa)          ? $request->oa          : 0;  
        $kota->save();
        return response()->json(array('success' => 'success'));
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

    public function delete(Request $request){
        $kecamatan = Kecamatan::find($request->id);
        Kecamatan::find($request->id)->delete();
        return response()->json(array('customer' => $kecamatan));
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
}
