<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Agen;
use DB;
use Carbon\Carbon;
use App\ViewReportAwb;

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
        });
        $awbs = $query->where('tanggal_awb','>=',$periode[0])->where('tanggal_awb','<=',$periode[1])->get();
        $data['data']= $awbs;
        return response()->json($data);
    }
}
