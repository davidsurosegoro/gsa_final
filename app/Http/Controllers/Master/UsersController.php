<?php

namespace App\Http\Controllers\Master;

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

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.master.users.index');
    }

    public function datatables()
    {
        $users = User::where('id' ,'>', '0');
        return Datatables::of($users)
        ->addColumn('aksi', function ($a) {
            return '<div class="btn-group" role="group" aria-label="Basic example">
                <a href="'.url('master/users/edit/'.$a['id']).'" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Edit Customer">
                    <i class="flaticon-edit-1"></i>
                </a>
                <button type="button" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" data-placement="bottom" title="Tombol Hapus Customer" onClick="deleteCustomer(' . $a['id'] . ',\'' . $a['username'] . '\')"> <i class="flaticon-delete"></i> </button>
                </div>';
        })
        ->addColumn('details_url', function($a) {
            return url('master/users/data-harga/' . $a->id);
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }
    public function checkusername(Request $request)
    {
        
        $data['username'] = User::where("username", $request->username)->where("id",'>', 0)->get();
        return response()->json($data);
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
    }

    public function gantipassword(Request $request){
        // echo $request->username;
        // echo $request->password;
        $users = User::where('username',$request['username'])->first(); 
        $users->password= Hash::make($request['password']);
        $users->save();
        return redirect('/')->with('message','Password Updated');
    }

    public function save(Request $request)
    {   
        $users = new User(); 
        $users->nama          = ($request->nama)        ? $request->nama        : '';
        $users->email         = ($request->email)       ? $request->email       : '';
        $users->notelp        = ($request->notelp)      ? $request->notelp      : '';
        $users->alamat        = ($request->alamat)      ? $request->alamat      : '';
        $users->level         = ($request->level)       ? $request->level       : 0; 
        $users->id_customer   = ($request->id_customer) ? $request->id_customer : 0; 
        $users->id_agen       = ($request->id_agen)     ? $request->id_agen     : 0; 
        $users->username      = ($request->username)    ? strtolower(preg_replace('/\s+/', '_', $request->username))    : '';
        $users->status        = 'aktif'; 
        $users->password      = '$2y$10$s.aYGxhPXfTPN3/Hf8i1t.UDIWZUFIOdxhUl6c56YcrF7kI0Y3g3W'; 
        $users->save();
        return redirect('master/users')->with('message','created');
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
        $data['users']      = User::find($id);
        $data['customer']   = Customer::get();
        $data['agen']       = Agen::get();
        // return view('pages.master.users.edit',compact('users'));

        // $data['action']='ubah'; 
        return view("pages.master.users.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {   $users = User::where('id',$request['id'])->first(); 
        $users->nama          = ($request->nama)        ? $request->nama        : '';
        $users->email         = ($request->email)       ? $request->email       : '';
        $users->notelp        = ($request->notelp)      ? $request->notelp      : '';
        $users->alamat        = ($request->alamat)      ? $request->alamat      : '';
        $users->username      = ($request->username)    ? $request->username    : '';
        $users->level         = ($request->level)       ? $request->level       : 0; 
        $users->id_customer   = ($request->id_customer) ? $request->id_customer : 0; 
        $users->id_agen       = ($request->id_agen)     ? $request->id_agen     : 0; 
        $users->save();
        return redirect('master/users')->with('message','updated');
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

    public function delete(Request $request){ 
        $user = User::find($request->id)->delete();
        // User::find($request->id)->delete();
        // activity()->withProperties(['username yang terhapus' => $user2->username], "deleted_users")->log('deleted_users');
        return response()->json(array('user' => $user));
    }
}
