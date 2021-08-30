<?php

namespace App\Http\Controllers\Master;

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

class ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master.manifest.index');
    }
    
    public function datatables()
    { 
        $manifest = Manifest::select(DB::raw("DATE_FORMAT(manifest.created_at,'%d-%M-%Y') as tanggal_manifest"),"manifest.*" , "kotaasal.kode as kodekotaasal","kotatujuan.kode as kodekotatujuan" ,"users.nama as namauser")
                ->join('kota as kotaasal',      'kotaasal.id',     '=', 'manifest.id_kota_asal') 
                ->join('kota as kotatujuan',    'kotatujuan.id',   '=', 'manifest.id_kota_tujuan') 
                ->join("users",                 'users.id',        '=', 'manifest.dibuat_oleh')
                ->where('manifest.id' ,'>', '0')
                ->orderBy('manifest.id' , 'desc')
                ->get();

        return Datatables::of($manifest)
        ->addColumn('aksi', function ($a) { 
            
            return '
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="'.url('printout/manifest/'.$a['id']).'" target="blank" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Customer">
                    <i class="fa fa-print" aria-hidden="true"></i>
                </a>
                <button 
                    type            = "button" 
                    class           = "btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success openstatus"   
                    idmanifest      = "' . $a['id'] . ' " 
                    kodemanifest    = "' . $a['kode'] . ' " 
                    tanggalmanifest = "' . $a['tanggal_manifest'] . ' " 
                    kodekotaasal    = "' . $a['kodekotaasal'] . ' " 
                    kodekotatujuan  = "' . $a['kodekotatujuan'] . ' " 
                    status          = "' . $a['status'] . '" 
                    data-toggle     = "modal" 
                    data-target     = ".bd-example-modal-lg"> 
                        <i class="fa fa-edit" aria-hidden="true"></i> 
                </button>
            </div>';
        })          
        ->addColumn('status_info', function ($a) { 
            $status='<span class="badge badge-success"> <i class="fa fa-check"  style="color:white;"></i>&nbsp;'.$a['status'].'</span>';
            if($a['status']=='delivering'){
                $status='<span class="badge badge-info"><i class="fa fa-truck"  style="color:white;"></i>&nbsp;'.$a['status'].'</span>';
            }else if($a['status']=='arrived'){
                $status='<span class="badge badge-primary"><i class="fa fa-university"  style="color:white;"></i>&nbsp;'.$a['status'].'</span>';
            }
            return $status;
        })          
        ->rawColumns(['aksi','status_info'])
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
    }
    public function updatestatus(Request $request)
    { 
        $manifest = Manifest::where('id',$request['idmanifest'])->first(); 
        $manifest->status = $request['status'];
        $manifest->save();
        return response()->json(array('success' => 'success'));
    }
    public function save(Request $request)
    {    
        if($request->id == 0){
            $manifest = new Manifest();  
        }else{            
            $manifest = Manifest::where('id',$request['id'])->first(); 
        }
        $manifest->kode                 = Manifest::getNoManifest(); 
        $manifest->status               = ($request->status)            ? $request->status              : 'checked';  
        $manifest->supir                = ($request->supir)             ? $request->supir               : ''; 
        $manifest->keterangan           = ($request->keterangan)        ? $request->keterangan          : ''; 
        $manifest->id_kota_asal         = ($request->id_kota_asal)      ? $request->id_kota_asal        : 0; 
        $manifest->id_kota_tujuan       = ($request->id_kota_tujuan)    ? $request->id_kota_tujuan      : 0; 
        $manifest->dibuat_oleh          = ($request->dibuat_oleh)       ? $request->dibuat_oleh         : 0; 
        $manifest->dicek_oleh           = ($request->dicek_oleh)        ? $request->dicek_oleh          : 0; 
        $manifest->id_agen_penerima     = ($request->id_agen_penerima)  ? $request->id_agen_penerima    : 0; 
        $manifest->jumlah_kg            = ($request->jumlah_kg)         ? $request->jumlah_kg           : 0; 
        $manifest->jumlah_koli          = ($request->jumlah_koli)       ? $request->jumlah_koli         : 0; 
        $manifest->jumlah_doc           = ($request->jumlah_doc)        ? $request->jumlah_doc          : 0; 
        $manifest->created_at           = Carbon::now()->addHours(7); 
        $manifest->tanggal_pengiriman   = Carbon::now()->addHours(7); 
        $manifest->save();

        $data['awb'] =  Awb::select('awb.*' )
                    ->where ("awb.status_tracking",     '=' , 'booked')
                    ->where ("awb.id_manifest",         '=' , 0) 
                    ->where ("awb.id_kota_tujuan",      '=' , $manifest['id_kota_tujuan']) 
                    ->where ("awb.id_kota_asal",        '=' , $manifest['id_kota_asal']) 
                    ->where (function($query)
                                {
                                    $query  ->where('awb.created_at', '<=', Carbon::now()->hour(15)->minute(0)->second(0))
                                            ->where('awb.created_at', '>',  Carbon::yesterday()->hour(15)->minute(0)->second(0));
                                })
                    ->get();
        echo $manifest['id_kota_tujuan'].'tujuan<br>asal';
        echo $manifest['id_kota_asal'];
        foreach ($data['awb'] as $item){  
            $item['id_manifest']     = $manifest['id'];
            $item['status_tracking'] = 'at-manifest';            
            $item->save();
            echo $item;
        }
        $data['awb_update'] =  Awb::select(DB::raw("customer.id as idcust,ROUND((customer.harga_oa / count(awb.id)),2) as dividedoa,count(awb.id) as total"))
                    ->join  ("customer as customer",  'customer.id',    '=', 'awb.id_customer')
                    ->where ("awb.status_tracking", '=' , 'at-manifest')
                    ->where ("awb.id_manifest",             '=' , $manifest['id']) 
                    ->where ("customer.jenis_out_area",     '=' , 'shipment')  
                    ->where ("awb.id_kota_tujuan",          '=' , $manifest['id_kota_tujuan']) 
                    ->where ("awb.id_kota_asal",            '=' , $manifest['id_kota_asal']) 
                    ->orderBy('id_customer','desc')
                    ->groupBY('customer.id','customer.harga_oa')
                    ->get();
                    
        foreach ($data['awb_update'] as $item){  
            DB::table('awb')
              ->where('id_manifest', $manifest['id'])
              ->where('id_customer', $item['idcust'])
              ->update(
                        [   'idr_oa'      =>  $item['dividedoa'],
                            'total_harga' => DB::raw('awb.total_harga+'.$item['dividedoa']),
                        ]
                    );
        }
        return redirect('master/manifest')->with('message','Manifest created');
    }

    public function edit($kotaasal,$kotatujuan)
    {
        //
        $data['manifest']   = Manifest::find(0); 
        $data['kotaasal']   = Kota::where('id','=',$kotaasal)->get(); 
        $data['kotatujuan'] = Kota::where('id','=',$kotatujuan)->get(); 
        
        $data['awb'] =  Awb::select(
                                'awb.*',
                                'customer.nama as namacust',
                                'kotatujuan.nama as kotatujuan', 
                                DB::raw('(awb.qty_kecil + awb.qty_sedang + awb.qty_besar + awb.qty_besarbanget) as qtykoli')
                            )
                        ->join  ("customer",            'customer.id',      '=', 'awb.id_customer')
                        ->join  ("kota as kotatujuan",  'kotatujuan.id',    '=', 'awb.id_kota_tujuan')
                        ->where ("awb.status_tracking", '=' , 'booked')
                        ->where ("awb.id_manifest",     '=' , 0)
                        ->where ("awb.id_kota_asal",    '=' , $kotaasal)
                        ->where ("awb.id_kota_tujuan",  '=' , $kotatujuan)
                        ->where (function($query)
                                    {
                                        $query  ->where('awb.created_at', '<=', Carbon::now()->hour(15)->minute(0)->second(0))
                                                ->where('awb.created_at', '>',  Carbon::yesterday()->hour(15)->minute(0)->second(0));
                                    })
                        ->get(); 
        // echo $data['awb'];
        return view("pages.master.manifest.edit",$data);
        //
    }
    public function grouping()
    {   
        $data['awb'] =  Awb::select(DB::raw("
                            kotaasal.id as idkotaasal, 
                            kotatujuan.id as idkotatujuan,
                            kotaasal.kode as kotaasal,
                            kotatujuan.kode as kotatujuan,
                            count(awb.id) as total"))
                        ->join  ("kota as kotaasal",   'kotaasal.id',   '=', 'awb.id_kota_asal')
                        ->join  ("kota as kotatujuan", 'kotatujuan.id', '=', 'awb.id_kota_tujuan')
                        ->where ("awb.status_tracking", '=' , 'booked')
                        ->where ("awb.id_manifest",     '=' , 0)
                        ->where (function($query)
                                    {
                                        $query  ->where('awb.created_at', '<=', Carbon::now()->hour(15)->minute(0)->second(0))
                                                ->where('awb.created_at', '>',  Carbon::yesterday()->hour(15)->minute(0)->second(0));
                                    })
                        ->groupBy("kotaasal.kode" , "kotatujuan.kode","kotaasal.id" , "kotatujuan.id")
                        ->get(); 
        // echo Carbon::now()->hour(15)->minute(0)->second(0);
        // echo Carbon::now()->addHours(7);
        // echo Carbon::now()->hour(15)->minute(0)->second(0).'<br>';
        // echo Carbon::yesterday()->hour(15)->minute(0)->second(0);
        return view("pages.master.manifest.grouping",$data);
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
