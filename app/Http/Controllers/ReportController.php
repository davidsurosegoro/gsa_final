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
use Auth;

class ReportController extends Controller
{
    public function awb()
    {
        $customer = Customer::orderBy('nama','asc')->get();
        $agen = Agen::orderBy('nama','asc')->get();
        if((int) Auth::user()->level == 2){
            $customer = customer::find(Auth::user()->id_customer);
        }
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
        
        ->when((int) Auth::user()->level == 3 , function ($q) {
            return  //$q->where('id_agen_penerima', '=',request('id_agen_penerima'));
                $q->where (function($query)
                    {
                        $query  ->where('id_agen_penerima', '=', (int) Auth::user()->id_agen)
                                ->orWhere('id_agen_asal',   '=', (int) Auth::user()->id_agen);
                    });
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
        if((int) Auth::user()->level !== 1){
            $customer = customer::find(Auth::user()->id_customer);
        }
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
        $customer = Customer::where('is_agen',1)->get();
        if((int) Auth::user()->level !== 1){
            $agen = Agen::find(Auth::user()->id_agen);
        }
        return view('pages.report.bonus',compact('agen'));
    }

    public function bonus_grid(Request $request){
        $period = explode(" - ", $request->tanggal);
        $periode = [Carbon::createFromFormat('d/m/Y', $period[0])->toDateString(), Carbon::createFromFormat('d/m/Y', $period[1])->toDateString()];
        $query = ViewReportAwb::query();
        $query->when(request('id_agen_asal') !== '-', function ($q) {
            return $q->where('id_agen_asal', '=',request('id_agen_asal'))->orWhere('id_customer','=',request('id_agen_asal'));
        })
        ->when(request('id_agen_tujuan') !== '-', function ($q) {
            return $q->where('id_agen_penerima', '=',request('id_agen_tujuan'));
        });
        $awbs = $query->where('tanggal_awb','>=',$periode[0])->where('tanggal_awb','<=',$periode[1])->where('status_tracking','complete')->get();
        $bonus = array();
        $collection = new Collection;
        foreach($awbs as $a):
            $is_transit = "NO";
            $agen_asal = "GLOBAL SERVICE ASIA";
            $bonus = $this->hitungBonus($a);
            if(strtoupper($a->kota_transit) == 'SURABAYA'):
                $is_transit = "YES";
            endif;
            if($a->is_agen == 1):
                $agen_asal = $a->pengirim;
            endif;
            $collection->push([
                'bonus_gsa' => $bonus['bonus_gsa'],
                'bonus_agen_asal' => $bonus['bonus_agen_asal'],
                'bonus_agen_tujuan' => $bonus['bonus_agen_tujuan'],
                'total_harga' => $a->total_harga,
                'idr_oa' => $a->idr_oa,
                'pengirim' => $agen_asal,
                'kota_asal' => $a->kota_asal,
                'kota_tujuan' => $a->kota_tujuan,
                'noawb' => $a->noawb,
                'status_tracking' => $a->status_tracking,
                'agen_tujuan' => $a->agen_tujuan,
                'kota_transit' => $is_transit,
                'is_agen' => $a->is_agen
            ]);
        endforeach;
        $data['data']= $collection;
        return response()->json($data);
    }

    private function hitungBonus($awb){
        $array = array();
        $bonus_gsa = 0; $bonus_agen_asal = 0; $bonus_agen_tujuan = 0;
        if($awb->is_agen == 0){
            $agen = Agen::find($awb->id_agen_penerima);
            $bonus_agen_tujuan = $agen->presentase/100 * $awb->total_harga;
            $bonus_gsa = (100 - $agen->presentase)/100 * $awb->total_harga;
        }
        else{
            if(strtolower($awb->kota_asal) !== 'surabaya' && strtolower($awb->kota_tujuan) !== 'surabaya'){
                $bonus_gsa = 0.15 * $awb->total_harga;
                $bonus_agen_asal = 0.6 * $awb->total_harga;
                $bonus_agen_tujuan = 0.25 * $awb->total_harga;
            }
            else{
                $bonus_gsa = 0.3 * $awb->total_harga;
                $bonus_agen_asal = 0.7 * $awb->total_harga;
            }
        }
        $array['bonus_gsa'] = $bonus_gsa;
        $array['bonus_agen_asal'] = $bonus_agen_asal;
        $array['bonus_agen_tujuan'] = $bonus_agen_tujuan;
        return $array;
    }
}
