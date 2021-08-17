<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kota;
use App\Agen;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Spatie\Activitylog\Models\Activity;

class AgenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $kota = Kota::orderBy('nama','asc')->get();
        return view('pages.master.agen.index',compact('kota'));
    }

    public function save(Request $request){
        $username = strtolower(preg_replace('/\s+/', '_', $request->nama));
        $user = User::create([
            "username" => $username,
            "password" => '$2y$10$s.aYGxhPXfTPN3/Hf8i1t.UDIWZUFIOdxhUl6c56YcrF7kI0Y3g3W',
            "level" => 2
        ]);
        $agen = Agen::create([
            'nama' => $request->nama,
            'idkota' => $request->kota,
            'kode'  => $request->kode,
            'user_id' => $user->id
        ]);

        return redirect('master/agen')->with('message','created');
    }

    public function update(Request $request){
        $agen = Agen::find($request->id)->update([
            'nama' => mysql_escape_string($request->nama),
            'idkota' => $request->kota,
            'kode'  => $request->kode,
        ]);
        return redirect('master/agen')->with('message','updated');
    }

    public function edit(Request $request){
        $agen = Agen::find($request->id);
        return response()->json(array('agen' => $agen));
    }

    public function delete(Request $request){
        $agen = Agen::find($request->id);
        $user = User::where('id',$agen->user_id)->first();
        Agen::find($request->id)->delete();
        User::where('id',$agen->user_id)->delete();
        activity()->withProperties(['username yang terhapus' => $user->username], "deleted_users")->log('deleted_users');
        return response()->json(array('agen' => $agen));
    }

    public function datatables(){
        $agen = DB::SELECT('SELECT a.*,k.nama as nama_kota, u.username FROM agen a INNER JOIN kota k ON a.idkota = k.id INNER JOIN users u ON a.user_id = u.id WHERE a.deleted_at IS NULL');
        $agens = new Collection;
        foreach ($agen as $a):
            $agens->push([
                'id'  => $a->id,
                'kode'  => $a->kode,
                'nama_agen'  => $a->nama,
                'kota'  => $a->nama_kota,
                'username' => $a->username,
            ]);
        endforeach;
        return Datatables::of($agens)
            ->addColumn('aksi', function ($a) {
                return '<div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Agen">
                    <i class="flaticon-edit-1"  data-toggle="modal" data-target="#modal-edit-agen" onClick="editAgen(' . $a['id'] . ')"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Peta" onClick="deleteAgen(' . $a['id'] . ')"> <i class="flaticon-delete"></i> </button>
                </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
