<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Agen;
use DB;
use App\Kota;
use Carbon\Carbon;
use App\ViewReportAwb;
use App\ViewReportManifest;
use App\ViewReportInvoice;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    public function awb()
    {
        $customer = Customer::orderBy('nama','asc')->get();
        $agen = Agen::orderBy('nama','asc')->get();
        return view('pages.report.awb',compact('customer','agen'));
    }

    public function awb_grid(Request $request)
    {
        $period = explode(" - ", $request->tanggal);
        $periode = [Carbon::createFromFormat('d/m/Y', $period[0])->toDateString(), Carbon::createFromFormat('d/m/Y', $period[1])->toDateString()];
        $query = ViewReportAwb::query();
        $query->when(request('id_customer') !== '-', function ($q) {
            return $q->where('id_customer', '=',request('id_customer'));
        })
        ->when(request('id_agen_penerima') !== '-', function ($q) {
            return $q->where('id_agen_penerima', '=',request('id_agen_penerima'));
        })
        ->when(request('status_tracking') !== '-', function ($q) {
            return $q->where('status_tracking', '=',request('status_tracking'));
        })
        ->when(request('noawb') !== null, function($q){
            return $q->where('noawb','like','%'.strtoupper(request('noawb')).'%');
        });
        $awbs = $query->where('tanggal_awb','>=',$periode[0])->where('tanggal_awb','<=',$periode[1])->get();
        $data['data']= $awbs;
        return response()->json($data);
    }

    public function manifest()
    {
        $kota = Kota::where('id','>',0)->orderBy('nama','asc')->get();
        return view('pages.report.manifest',compact('kota'));
    }

    public function manifest_grid(Request $request){

        $period = explode(" - ", $request->tanggal);
        $periode = [Carbon::createFromFormat('d/m/Y', $period[0])->toDateString(), Carbon::createFromFormat('d/m/Y', $period[1])->toDateString()];
        $query = ViewReportManifest::query();
        $query->when(request('id_kota_asal') !== '-', function ($q) {
            return $q->where('id_kota_asal', '=',request('id_kota_asal'));
        })
        ->when(request('id_kota_tujuan') !== '-', function ($q) {
            return $q->where('id_kota_tujuan', '=',request('id_kota_tujuan'));
        })
        ->when(request('status') !== '-', function ($q) {
            return $q->where('status', '=',request('status'));
        })
        ->when(request('kode_manifest') !== null, function($q){
            return $q->where('kode','like','%'.strtoupper(request('kode_manifest')).'%');
        });
        $awbs = $query->where('created_at','>=',$periode[0])->where('created_at','<=',$periode[1])->get();
        $data['data']= $awbs;
        return response()->json($data);
    }

    public function invoice(){
        
        $customer = Customer::orderBy('nama','asc')->get();
        return view('pages.report.invoice',compact('customer'));
    }

    public function invoice_grid(Request $request){
        $period = explode(" - ", $request->tanggal);
        $periode = [Carbon::createFromFormat('d/m/Y', $period[0])->toDateString(), Carbon::createFromFormat('d/m/Y', $period[1])->toDateString()];
        $query = ViewReportInvoice::query();
        $query->when(request('id_customer') !== '-', function ($q) {
            return $q->where('id_customer', '=',request('id_customer'));
        })
        ->when(request('metodepembayaran') !== '-', function ($q) {
            return $q->where('metodepembayaran', '=',request('metodepembayaran'));
        })
        ->when(request('status') !== '-', function ($q) {
            return $q->where('status', '=',request('status'));
        })
        ->when(request('kode_invoice') !== null, function($q){
            return $q->where('kode','like','%'.strtoupper(request('kode_invoice')).'%');
        });
        $awbs = $query->where('tanggal_invoice','>=',$periode[0])->where('tanggal_invoice','<=',$periode[1])->get();
        $data['data']= $awbs;
        return response()->json($data);
    }

    public function bonus(){
        $agen = Agen::orderBy('nama','asc')->get();
        return view('pages.report.bonus',compact('agen'));
    }

    public function bonus_grid(Request $request){
        $period = explode(" - ", $request->tanggal);
        $periode = [Carbon::createFromFormat('d/m/Y', $period[0])->toDateString(), Carbon::createFromFormat('d/m/Y', $period[1])->toDateString()];
        $query = ViewReportAwb::query();
        $query->when(request('id_agen_asal') !== '-', function ($q) {
            return $q->where('id_agen_asal', '=',request('id_agen_asal'));
        })
        ->when(request('id_agen_tujuan') !== '-', function ($q) {
            return $q->where('id_agen_tujuan', '=',request('id_agen_tujuan'));
        });
        $awbs = $query->where('tanggal_awb','>=',$periode[0])->where('tanggal_awb','<=',$periode[1])->get();
        $collection = new Collection;
        foreach($awbs as $a):
            $this->hitungBonus($a);
        endforeach;
        $data['data']= $awbs;
        return response()->json($data);
    }

    private function hitungBonus($awb){
        
    }
}
