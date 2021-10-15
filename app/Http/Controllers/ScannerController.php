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
use App\Detailqtyscanned;
use App\Historyscanawb;
use App\Kota;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;
use Auth;

class ScannerController extends Controller
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
    public function awb($status)
    {   $data['status']               = $status;
        $data['awbbelumditerima']     =  Awb::cek_penerima_kosong(); 
        
        // echo Crypt::decrypt($status);
        return view('pages.scanner.qrawb',$data); 
    }
    
    public function awbtest($status)
    {   $data['status']=$status;
        // echo Crypt::decrypt($status);
        return view('pages.scanner.qr-testing',$data); 
    }
    public function manifest($status)
    {   $data['status']=$status;
        // echo Crypt::decrypt($status);
        return view('pages.scanner.qrmanifest',$data); 
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
