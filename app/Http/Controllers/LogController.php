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

    public function datatables_log()
    {
        $custom   = new Collection;
        $activity = Activity::orderBy('created_at', 'desc')->take(5000)->get();
        foreach ($activity as $a):

            $user       = 'Tidak ada';
            $users      = User::where('id', $a->causer_id)->first();
            $desc       = '';
            $kets       = '';
            $properties = json_decode($a->properties);
            if (!empty($users)):
                $user = $users->name;
            endif;
            //
            if ($a->description == 'attribut_added'):
                $desc = 'Menambahkan Attribut pada peta <strong> ' . $properties->table_name . '</strong>';
                $kets = '';
            elseif ($a->description == 'attribut_updated'):
                $desc = 'Mengubah Attribut pada peta <strong> ' . $properties->table_name . '</strong>';
            elseif ($a->description == 'created' && $a->subject_type == "App\Map"):
                $desc = 'Tercatat Membuat layer baru';
                $kets = 'Telah Membuat layer baru <strong> ' . $properties->attributes->nama_peta . '</strong>';
            elseif ($a->description == 'updated' && $a->subject_type == "App\Map"):
                $desc = 'Tercatat Mengupdate layer';
                $kets = 'Telah Mengubah layer <strong> ' . $properties->attributes->nama_peta . '</strong>';
            elseif ($a->description == 'deleted' && $a->subject_type == "App\Map"):
                $desc = 'Tercatat Menghapus Layer';
                $kets = 'Telah Menghapus layer <strong> ' . $properties->attributes->nama_peta . '</strong>';
            else:
                $desc = $a->description;
            endif;

            $tanggal = date('d F Y', strtotime($a->created_at));
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
