<?php

namespace App\Http\Controllers\Master;

use App\Agen;
use App\Http\Controllers\Controller;
use App\Kota;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AgenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kota = Kota::orderBy('nama', 'asc')->get();
        return view('pages.master.agen.index', compact('kota'));
    }

    public function save(Request $request)
    {
        $agen = Agen::create([
            'nama'       => $request->nama,
            'kode'       => $request->kode,
            'alamat'     => $request->alamat,
            'no_telp'    => $request->no_telp,
            'presentase' => $request->presentase,
            'idkota1'    => $request->idkota1,
            'idkota2'    => $request->idkota2,
            'idkota3'    => $request->idkota3,
            'idkota4'    => $request->idkota4,
            'idkota5'    => $request->idkota5,
            'idkota6'    => $request->idkota6,
            'idkota7'    => $request->idkota7,
            'idkota8'    => $request->idkota8,
            'idkota9'    => $request->idkota9,
            'idkota10'   => $request->idkota10,
        ]);

        return redirect('master/agen')->with('message', 'created');
    }

    public function update(Request $request)
    {
        $agen = Agen::find($request->id)->update([
            'nama'       => $request->nama,
            'kode'       => $request->kode,
            'alamat'     => $request->alamat,
            'no_telp'    => $request->no_telp,
            'presentase' => $request->presentase,
            'idkota1'    => $request->idkota1,
            'idkota2'    => $request->idkota2,
            'idkota3'    => $request->idkota3,
            'idkota4'    => $request->idkota4,
            'idkota5'    => $request->idkota5,
            'idkota6'    => $request->idkota6,
            'idkota7'    => $request->idkota7,
            'idkota8'    => $request->idkota8,
            'idkota9'    => $request->idkota9,
            'idkota10'   => $request->idkota10,
        ]);
        return redirect('master/agen')->with('message', 'updated');
    }

    public function edit(Request $request)
    {
        $agen = Agen::find($request->id);
        return response()->json(array('agen' => $agen));
    }

    public function delete(Request $request)
    {
        $agen = Agen::find($request->id);
        $user = User::where('id', $agen->user_id)->first();
        Agen::find($request->id)->delete();
        return response()->json(array('agen' => $agen));
    }

    public function datatables()
    {
        $agen    = DB::SELECT('SELECT a.* FROM agen a WHERE a.deleted_at IS NULL  ');
        $agens   = new Collection;
        $strings = "";
        foreach ($agen as $a):

            $kota = DB::SELECT("SELECT * FROM view_agen_kota WHERE agen_id = " . $a->id);
            foreach ($kota as $k):
                $strings .= '<span class="label label-lg label-dark label-inline mr-2">' . $k->nama . '</span>';
            endforeach;
            $agens->push([
                'id'          => $a->id,
                'kode'        => $a->kode,
                'nama_agen'   => $a->nama,
                'alamat_agen' => $a->alamat,
                'no_telp'     => $a->no_telp,
                'presentase'  => $a->presentase,
                'coverage'    => $strings,
            ]);
            $strings = '';
        endforeach;
        return Datatables::of($agens)
            ->editColumn('presentase', function ($a) {
                return $a['presentase'] . " % ";
            })
            ->addColumn('aksi', function ($a) {
                $btnhapus = '<button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus " onClick="deleteAgen(' . $a['id'] . ')"> <i class="flaticon-delete"></i> </button>';

                return '<div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Agen">
                    <i class="flaticon-edit-1"  data-toggle="modal" data-target="#modal-edit-agen" onClick="editAgen(' . $a['id'] . ')"></i>
                </button>
                '.(($a['id']>1) ? $btnhapus : '').'
                </div>';
            })
            ->rawColumns(['coverage', 'aksi', 'presentase'])
            ->make(true);
    }
}
