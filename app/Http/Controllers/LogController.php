<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;
use Yajra\Datatables\Datatables;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.log');
    }

    public function datatables()
    {
        $custom   = new Collection;
        $activity = Activity::orderBy('created_at', 'desc')->take(500)->get();
        foreach ($activity as $a):

            $user       = 'Tidak ada';
            $users      = User::where('id', $a->causer_id)->first();
            $desc       = '';
            $kets       = '';
            $properties = json_decode($a->properties);
            if (!empty($users)):
                $user = $users->nama;
            endif;
            if ($a->description == 'created'):
                if($a->subject_type == 'App\Awb'):
                    $desc = 'Membuat AWB Baru';
                    $kets = 'Nomor AWB terbuat <strong>'.$properties->attributes->noawb.'</strong>';
                elseif($a->subject_type == 'App\Manifest'):
                    $desc = 'Membuat Manifest Baru';
                    $kets = 'Nomor Manifest Terbuat <strong>' . $properties->attributes->kode . '</strong>';
                elseif($a->subject_type == 'App\Invoice'):
                    $desc = 'Membuat Invoice Baru';
                    $kets = 'Nomor Invoice Terbuat <strong>' . $properties->attributes->kode . '</strong>';
                endif;
            elseif ($a->description == 'updated'):
                if($a->subject_type == 'App\Awb'):
                    $desc = 'Mengubah data AWB nomor <strong> '.$properties->attributes->noawb.' </strong>';
                elseif($a->subject_type == 'App\Manifest'):
                    $desc = 'Mengubah data Manifest nomor <strong> '.$properties->attributes->kode.' </strong>';
                elseif($a->subject_type == 'App\Invoice'):
                    $desc = 'Mengubah data Invoice nomor <strong> '.$properties->attributes->kode.' </strong>';
                endif;
            endif;

            $tanggal = date('d F Y, H.i', strtotime($a->created_at));
            $custom->push([
                'user'        => $user,
                'description' => $desc,
                'tanggal'     => $tanggal,
                'keterangan'  => $kets,
                'dates'       => $a->created_at,
            ]);
        endforeach;
        return Datatables::of($custom)->rawColumns(['description', 'keterangan'])->make(true);
    }
}
