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
use App\Historyscanawb;
use Carbon\Carbon;
use Auth;
use App\Kota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kode)
    {
        //

        $data['statusada']          ='';
        $data['historyscanawb']     = Historyscanawb::select('history_scan_awb.*','awb.noawb as kodeawb','awb.diterima_oleh as diterima_oleh') 
                                        ->join("awb",'awb.id','=', 'history_scan_awb.idawb')
                                        ->where('awb.noawb', $kode)
                                        ->orderBy('history_scan_awb.id')
                                        ->get();
        if(count($data['historyscanawb'])==0){            
            $data['statusada']          ='Kode AWB/Resi '.$kode.' tidak ditemukan!';
        }  
        if($kode=='cek'){
            return view('pages.tracking.tracking');
        } 
        return view("pages.tracking.tracking",$data);
    }
    public function cari()
    {
        //
        return view('pages.tracking.tracking');
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
