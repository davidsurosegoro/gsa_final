@extends('layouts.app')
@section('content')
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Master Agen
      <span class="d-block text-muted pt-2 font-size-sm">Data agen yang tersedia</span></h3>
    </div>
    <div class="card-toolbar">
      <a href="javascript:void(0)" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#modal-create">
      <i class="la la-plus"></i>Tambah Data Agen</a>
    </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama Agen</th>
              <th>Kota</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        
    <form method="POST" action="{{ url('master/agen/save') }}" id="frm-save">
      {{ csrf_field() }}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">FORM TAMBAH DATA AGEN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Nama Agen:</label>
            <input type="text" name="nama" class="form-control form-control-solid" placeholder="Inpur Nama Agen" required>
            <span class="form-text text-muted">Silahkan masukan nama agen</span>
          </div>

          <div class="form-group">
            <label>Kota Agen:</label>
            <div class="row">
              <select name="kota" style="width: 100%" class="select2 form-control col-md-12" id="kota" data-live-search="true" required>
                <option value="">--Pilih Kota-- </option>
                @foreach($kota as $u)
                  <option value="{{ $u->id }}">{{ $u->nama }} </option>
                @endforeach
              </select>
            </div>
          </div>

          
          <div class="form-group">
            <label>Kode Agen:</label>
            <input type="text" name="kode" class="form-control form-control-solid" placeholder="Inpur Kode Agen" required>
            <span class="form-text text-muted">Silahkan masukan kode agen</span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary font-weight-bold">SIMPAN</button>
        </div>
        
    </form>
      </div>
  </div>
</div>


<div class="modal fade" id="modal-edit-agen" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        
    <form method="POST" action="{{ url('master/agen/update') }}">
      <input type="hidden" name="id" id="idagen" value="">
      {{ csrf_field() }}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">FORM EDIT DATA AGEN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Nama Agen:</label>
            <input type="text" name="nama" id="nama" class="form-control form-control-solid" placeholder="Inpur Nama Agen" required>
            <span class="form-text text-muted">Silahkan masukan nama agen</span>
          </div>

          <div class="form-group">
            <label>Kota Agen:</label>
            <div class="row">
              <select name="kota" id="idkota" style="width: 100%" class="select2 form-control col-md-12" data-live-search="true" required>
                <option value="">--Pilih Kota-- </option>
                @foreach($kota as $u)
                  <option value="{{ $u->id }}">{{ $u->nama }} </option>
                @endforeach
              </select>
            </div>
          </div>

          
          <div class="form-group">
            <label>Kode Agen:</label>
            <input type="text" id="kode" name="kode" class="form-control form-control-solid" placeholder="Inpur Kode Agen" required>
            <span class="form-text text-muted">Silahkan masukan kode agen</span>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary font-weight-bold">SIMPAN</button>
        </div>
        
    </form>
      </div>
  </div>
</div>
@endsection
@section('script')
<script>
   $('#datatables').DataTable({
	    processing: true,
	    serverSide: false,
	    paging:true,
	    ajax: '{{ url('master/agen/datatables') }}',
	    columns: [
	    {data: 'kode', name:'kode'},
	    {data: 'nama_agen', name:'nama_agen'},
	    {data: 'kota', name:'kota'},
	    {data: 'aksi', name:'aksi'},
	],
	 "order": [[ 1, "asc" ]],
   });

   function deleteAgen(id,nama)
    {
         Swal.fire({   
                      title: "Anda Yakin?",   
                      text: "Data Agen akan terhapus dari sistem",   
                      icon: "warning",   
                      showCancelButton: true,   
                      confirmButtonColor: "#e6b034",   
                      confirmButtonText: "Ya, Hapus Agen" 
                       
                  }).then((result) => {
            if (result.value) {
                $.ajax({
                            method:'POST',
                            url:base_url+'master/agen/delete',
                            data:{
                              id:id,
                              '_token': $('input[name=_token]').val()
                            },
                            success:function(data){
                                Swal.fire({title:"Terhapus!", text:"Agen "+data.agen.nama+" berhasil terhapus dari sistem", icon:"success"}
                                ).then((result) => {
                                    location.reload()
                                })
                            }
                          }) 
            } 
         });
    }

    function editAgen(id){
      $.ajax({
                            method:'POST',
                            url:base_url+'master/agen/edit',
                            data:{
                              id:id,
                              '_token': $('input[name=_token]').val()
                            },
                            success:function(data){
                              console.log(data);
                              $('#idagen').val(data.agen.id)
                              $('#nama').val(data.agen.nama)
                              $('#idkota').val(data.agen.idkota)
                              $('#kode').val(data.agen.kode)
                            }
                          }) 
    }
  </script>
@if(Session::get('message') == "created")
    <script type="text/javascript">
        toastr.success("Agen Baru Berhasil ditambahkan!");
    </script>
@endif
@if(Session::get('message') == "updated")
    <script type="text/javascript">
        toastr.success("Data Agen Berhasil diubah!");
    </script>
@endif
@endsection