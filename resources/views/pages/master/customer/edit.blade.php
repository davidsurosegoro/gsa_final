@extends('layouts.app')
@section('content')
<div class="card card-custom gutter-b example example-compact">
  <div class="card-header">
    <h3 class="card-title">FORM UBAH DATA CUSTOMER </h3>
  </div>
<form class="form" method="POST" action="url('master/customer/update')">
  <input type="hidden" name="id" value="{{ $customer->id }}">
  {{ csrf_field() }}
  <div class="card-body">
   <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Nama Customer:</label>
        <input type="text" class="form-control" name="nama" placeholder="Input nama customer. . . "/>
        <span class="form-text text-muted">Silahkan input nama customer</span>
      </div>
    <div class="form-group">
     <label>Alamat Customer:</label>
     <input type="text" class="form-control" name="alamat" placeholder="Input alamat customer. . ."/>
     <span class="form-text text-muted">Silahkan input alamat customer</span>
   </div>
   <div class="form-group">
     <label>Nomor Telepon Customer:</label>
      <input type="text" class="form-control" name="notelp" placeholder="Input nomor telepon customer. . ."/>
     <span class="form-text text-muted">Silahkan input nomor telepon customer</span>
    </div>

     <div class="form-group">
      <label>Rekening:</label>
       <input type="text" class="form-control" name="rekening" placeholder="Input Nomor Rekening. . ."/>
      <span class="form-text text-muted">Silahkan input Nomor Rekening</span>
     </div>

     <div class="form-group">
      <label>Bank :</label>
       <input type="text" class="form-control" name="bank" placeholder="Input bank. . ."/>
      <span class="form-text text-muted">Silahkan input bank</span>
     </div>
     
     <div class="form-group">
      <label>Rekening Atas Nama (a/n):</label>
       <input type="text" name="rekeningatasnama" class="form-control" placeholder="Input Nomor Atas Nama Rekening. . ."/>
      <span class="form-text text-muted">Silahkan input Nomor Atas Nama Rekening</span>
     </div>

     <div class="form-group">
      <label>harga_oa:</label>
       <input type="text" class="form-control" name="harga_oa" placeholder="Input harga_oa. . ."/>
      <span class="form-text text-muted">Silahkan input harga_oa</span>
     </div>

   </div>
   <div class="col-lg-6">
     
    <div class="form-group">
      <label>Harga Koli Kecil:</label>
      <input type="text" class="form-control" name="harga_koli_k" placeholder="Input harga koli kecil. . ." required/>
      <span class="form-text text-muted">Silahkan input harga koli kecil</span>
    </div>
    <div class="form-group">
      <label>Harga Koli Sedang:</label>
      <input type="text" class="form-control" name="harga_koli_s" placeholder="Input harga koli sedang. . ." required/>
      <span class="form-text text-muted">Silahkan input harga koli sedang</span>
    </div>
    
    <div class="form-group">
      <label>Harga Koli Besar:</label>
      <input type="text" class="form-control" name="harga_koli_b" placeholder="Input harga koli besar. . ." required/>
      <span class="form-text text-muted">Silahkan input harga koli besar</span>
    </div>
    
    <div class="form-group">
      <label>Harga Koli Besar banget:</label>
      <input type="text" class="form-control" name="harga_koli_bb" placeholder="Input harga koli besar banget. . ." required/>
      <span class="form-text text-muted">Silahkan input harga koli besar banget</span>
    </div>
    
    <div class="form-group">
      <label>Harga per Kg:</label>
       <input type="text" class="form-control" name="harga_kg" placeholder="Input harga per Kg. . ."/>
      <span class="form-text text-muted">Silahkan input harga per Kg</span>
     </div>

    <div class="form-group">
      <label>harga_doc:</label>
       <input type="text" class="form-control" name="harga_doc" placeholder="Input harga_doc. . ."/>
      <span class="form-text text-muted">Silahkan input harga_doc</span>
     </div>

     <div class="form-group">
      <label>harga_oa_ship:</label>
       <input type="text" class="form-control" name="harga_oa_ship" placeholder="Input harga_oa_ship. . ."/>
      <span class="form-text text-muted">Silahkan input harga_oa_ship</span>
     </div>
   </div>
  </div>
  <div class="card-footer">
   <div class="row">
    <div class="col-lg-6">
     <button type="submit" class="btn btn-primary mr-2">SIMPAN</button>
     <button type="reset" class="btn btn-secondary">Cancel</button>
    </div>
   </div>
  </div>
 </form>
</div>
@endsection

@section('script')
@endsection