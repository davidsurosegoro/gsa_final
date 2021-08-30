@extends('layouts.app')
@section('content')
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Data AWB
      <span class="d-block text-muted pt-2 font-size-sm">Data AWB</span></h3>
    </div>
    <div class="card-toolbar">
      <a href="{{ url('awb/edit/0') }}" class="btn btn-primary font-weight-bolder">
      <i class="la la-plus"></i>Buat AWB Baru</a>
    </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>No AWB</th>
              <th>Pengirim</th>
              <th>Kota Asal</th>
              <th>Kota Tujuan</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
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
	    ajax: '{{ url('awb/datatables') }}',
	    columns: [
	    {data: 'noawb', name:'noawb'},
	    {data: 'nama_pengirim', name:'nama_pengirim'},
	    {data: 'kota_asal', name:'kota_asal'},
	    {data: 'kota_tujuan', name:'kota_tujuan'},
	    {data: 'tanggal_awb', name:'tanggal_awb'},
	    {data: 'status_tracking', name:'status_tracking'},
	    {data: 'aksi', name:'aksi'},
	],
	 "order": [[ 1, "asc" ]],
   });

   function deleteAwb(id,noawb)
    {
         Swal.fire({   
                      title: "Anda Yakin?",   
                      text: "Data AWB Nomor "+noawb+" akan terhapus",   
                      icon: "warning",   
                      showCancelButton: true,   
                      confirmButtonColor: "#e6b034",   
                      confirmButtonText: "Ya, Hapus AWB" 
                       
                  }).then((result) => {
            if (result.value) {
                $.ajax({
                            method:'POST',
                            url:'{{ url("awb/delete") }}',
                            data:{
                              id:id,
                              '_token': $('input[name=_token]').val()
                            },
                            success:function(data){
                                Swal.fire({title:"Terhapus!", text:"Awb "+data.awb.noawb+" berhasil terhapus dari sistem", icon:"success"}
                                ).then((result) => {
                                    location.reload()
                                })
                            }
                          }) 
            } 
         });
    }

    function updateManifest(id,noawb)
    {
         Swal.fire({   
                      title: "Anda Yakin?",   
                      text: "Data AWB Nomor "+noawb+" akan diupdate menjadi Manifested",   
                      icon: "warning",   
                      showCancelButton: true,   
                      confirmButtonColor: "#e6b034",   
                      confirmButtonText: "Ya, Manifested AWB" 
                       
                  }).then((result) => {
            if (result.value) {
                $.ajax({
                            method:'POST',
                            url:'{{ url("awb/manifest") }}',
                            data:{
                              id:id,
                              '_token': $('input[name=_token]').val()
                            },
                            success:function(data){
                                Swal.fire({title:"Updated!", text:"Awb Nomor "+data.awb.noawb+" sudah berada di manifest", icon:"success"}
                                ).then((result) => {
                                    location.reload()
                                })
                            }
                          }) 
            } 
         });
    }
</script>

@if(Session::get('message') == "created")
    <script type="text/javascript">
        toastr.success("AWB Baru Berhasil ditambahkan!");
    </script>
@endif
@if(Session::get('message') == "updated")
    <script type="text/javascript">
        toastr.success("Data AWB Berhasil diubah!");
    </script>
@endif
@endsection