<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Agen;
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
        $data=[];
        return view("pages.printout.manifest",$data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function awb($id)
    {
        $awb = DB::SELECT("SELECT
                            a.*,
                            k1.kode AS kota_tujuan_kode,
                            k2.kode AS kota_asal_kode
                            FROM
                                awb a
                            LEFT JOIN kota k1 ON a.id_kota_tujuan = k1.id
                            LEFT JOIN kota k2 ON a.id_kota_asal = k2.id
                            WHERE a.id = ".$id." ");
        return view("pages.printout.awb",compact('awb'));
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
