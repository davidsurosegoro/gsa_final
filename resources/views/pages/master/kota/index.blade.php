@extends('layouts.app')
@section('content')
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Master kota
      <span class="d-block text-muted pt-2 font-size-sm">Data kota yang tersedia</span></h3>
    </div>
    <div class="card-toolbar">
      <a href="{{url('master/kota/edit/0') }}" class="btn btn-primary font-weight-bolder">
      <i class="la la-plus"></i>Tambah Data kota</a>
    </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr> 
              <th>Kode</th> 
              <th>Nama</th>
              <th>Keterangan</th> 
              <th>last_update</th> 
              <th width='5%'>Status</th> 
              <th width='5%'>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>


@endsection
@section('script')
<script>
 
    var dt = $('#datatables').DataTable({
	     processing : true,
	     serverSide : false,
	     paging     : true,
	     ajax       :'{{ url('master/kota/datatables') }}',
	     columns    : [
         
      
          {data: 'kode',          name:'kode'}, 
          {data: 'nama',          name:'nama'}, 
          {data: 'keterangan',    name:'Keterangan'}, 
          {data: 'updated_at',    name:'last update'}, 
          {data: 'aktifnonaktif', name:'Status'},
          {data: 'aksi',          name:'aksi'},
      ],
      columnDefs:[{targets:3, render:function(data){
        return moment(data).format('Do MMMM YYYY');
      }}],
	   "order": [[ 3, "desc" ]],
    });

    var detailRows = [];
  
    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );

   function deleteCustomer(status,id,nama)
    {
         Swal.fire({   
          title               : "Anda Yakin?",   
          text                : "Data Kota akan di-"+status+"-kan dari sistem",   
          icon                : "warning",   
          showCancelButton    : true,   
          confirmButtonColor  : "#e6b034",   
          confirmButtonText   : "Ya,   "+status+"-kan Kota"                   
        }).then((result) => {
        if (result.value) {
          $.ajax({
            method  :'POST',
            url     :'{{ url('master/kota/delete') }}',
            data    :{
              id:id,
              status:status,
              '_token': $('input[name=_token]').val()
            },
            success:function(data){
                Swal.fire({title:"Rubah status berhasil!", text:"Kota "+nama+" berhasil di-"+status+"-kan ", icon:"success"}
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
        toastr.success("Kota Baru Berhasil ditambahkan!");
    </script>
@endif
@if(Session::get('message') == "updated")
    <script type="text/javascript">
        toastr.success("Data kota Berhasil diubah!");
    </script>
@endif
@endsection
