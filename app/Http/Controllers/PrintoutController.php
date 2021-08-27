<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Agen;
use App\Manifest;
use App\Awb;
use Carbon\Carbon;
use App\Kota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;

class PrintoutController extends Controller
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
    public function invoice($id)
    {
        $data=[];
        return view("pages.printout.invoice",$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manifest($id)
    {
        $data['manifest']   = Manifest::select(
                                DB::raw("DATE_FORMAT(manifest.created_at,'%d-%M-%Y') as tanggal_manifest"),
                                "manifest.*" , 
                                "kotaasal.kode as kodekotaasal",
                                "kotatujuan.kode as kodekotatujuan" ,
                                "kotaasal.nama as namakotaasal",
                                "kotatujuan.nama as namakotatujuan" ,
                                "users.nama as namauser",
                                "agen.nama as namaagen")
                            ->join('kota as kotaasal',      'kotaasal.id',     '=', 'manifest.id_kota_asal') 
                            ->join('kota as kotatujuan',    'kotatujuan.id',   '=', 'manifest.id_kota_tujuan') 
                            ->join("users",                 'users.id',        '=', 'manifest.dibuat_oleh')
                            ->join("users as agen",         'agen.id',         '=', 'manifest.dicek_oleh')
                            ->where('manifest.id',$id)
                            ->first(); 

        $data['awb'] =  Awb::select(
                                'awb.*',
                                'customer.nama as namacust',
                                'kotatujuan.nama as kotatujuan', 
                                DB::raw('(awb.qty_kecil + awb.qty_sedang + awb.qty_besar + awb.qty_besarbanget) as qtykoli')
                            )
                        ->join  ("customer",            'customer.id',      '=', 'awb.id_customer')
                        ->join  ("kota as kotatujuan",  'kotatujuan.id',    '=', 'awb.id_kota_tujuan') 
                        ->where ("awb.id_manifest",     '=' , $id)  
                        ->get(); 
        return view("pages.printout.manifest",$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awb($id)
    {
        $data=[];
        return view("pages.printout.awb",$data);
    }
    public function awbtri($id)
    {
        $data=[];
        return view("pages.printout.awbtri",$data);
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
}
