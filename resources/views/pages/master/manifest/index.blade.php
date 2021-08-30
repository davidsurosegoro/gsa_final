@extends('layouts.app')
@section('content')
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Master manifest
      <span class="d-block text-muted pt-2 font-size-sm">Data manifest yang tersedia</span></h3>
    </div>
    <div class="card-toolbar">
      <a href="{{url('master/manifest/grouping') }}" class="btn btn-primary font-weight-bolder">
      <i class="la la-plus"></i>Tambah Data manifest</a>
    </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr> 
              <th>Kode</th>
              <th>Asal</th>
              <th>Tujuan</th>
              <th>Tanggal</th>
              <th>Dibuat Oleh</th>
              <th>Koli</th>
              <th>Kg</th>
              <th>Doc</th>
              <th>Supir</th>
              <th width='5%'>Status</th> 
              <th width='5%'>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Rubah Status Manifest</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row" > 
        <form class="col-12 bg-light" style="padding-bottom:10px;" id="formmanifest_" method="post" action="{{url('master/manifest/updatestatus')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <table class="table table-striped table-hover table-bordered">
              <tr>
                <td>Kode : </td>
                <td>Tanggal :</td> 
                <td>Kota asal :</td> 
                <td>Kota Tujuan :</td> 
              </tr>
              
              <tr>
                <td id='kodemanifest_'></td>
                <td id='tanggalmanifest_'></td> 
                <td id='Kotaasal'></td> 
                <td id='kotatujuan'></td> 
              </tr>
            </table>
            
            <input type="text" name="idmanifest" id="idmanifest" class="d-none"  > 
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect2">Status</label>
            <select class="form-control" id="status" name="status">
              <option value='checked'>checked</option>
              <option value='delivering'>delivering</option>
              <option value='arrived'>arrived</option>
            </select>
          </div>
          <div class="form-group" > 
            <button type="button" class="pull-left btn btn-secondary" data-dismiss="modal">Close</button> 
            <button type="submit" id='simpanbutton' class="btn btn-primary pull-right mr-2">SIMPAN</button>
          </div>
        </form>
      </div> 
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript"> 
    $(document).on("click",".openstatus",function() {
      $('#Kotaasal'           ).html($(this).attr('kodekotaasal'))
      $('#kotatujuan'         ).html($(this).attr('kodekotatujuan'))
      $('#tanggalmanifest_'   ).html($(this).attr('tanggalmanifest'))
      $('#kodemanifest_'      ).html($(this).attr('kodemanifest'))

      $('#idmanifest'         ).val($(this).attr('idmanifest')) 
      $("#status").val($(this).attr('status'));
    })
    $(document).on("click","#simpanbutton",function() {
        var btnsave = $(this);
        $(this).prop('disabled', true);
        $.ajax({
            type      : "POST",
            url       : "{{url('master/manifest/updatestatus')}}",
            dataType  : "json",
            data      : $('#formmanifest_').serialize(),
            success : function(response) {
                console.log(response)
                if(response && response.success && response.success=='success'){
                  toastr.success("Status Manifest berhasil dirubah!");                  
                  dt.ajax.reload();
                  $('.bd-example-modal-lg').modal('toggle');
                }
                $(btnsave).prop('disabled', false);
            },
            error : function(jqXHR, textStatus, errorThrown) {
                alert(errorThrown)
            }
        });
    })
    var dt = $('#datatables').DataTable({
	     processing : true,
	     serverSide : false,
	     paging     : true,
	     ajax       :'{{ url('master/manifest/datatables') }}',
	     columns    : [
         
      
          {data: 'kode',              name:'kode'}, 
          {data: 'kodekotaasal',      name:'Asal'}, 
          {data: 'kodekotatujuan',    name:'Tujuan'}, 
          {data: 'tanggal_manifest',  name:'Tujuan'}, 
          {data: 'namauser',          name:'Dicek Oleh'}, 
          {data: 'jumlah_koli',       name:'Koli'}, 
          {data: 'jumlah_kg',         name:'Kg'}, 
          {data: 'jumlah_doc',        name:'Doc'}, 
          {data: 'supir',             name:'supir'}, 
          {data: 'status_info',       name:'Status'},
          {data: 'aksi',              name:'aksi'},
      ],
	   "order": [[ 1, "asc" ]],
    });

    var detailRows = [];
   
    function deleteCustomer(status,id,nama)
    {
         Swal.fire({   
                      title               : "Anda Yakin?",   
                      text                : "Data user akan di-"+status+"-kan dari sistem",   
                      icon                : "warning",   
                      showCancelButton    : true,   
                      confirmButtonColor  : "#e6b034",   
                      confirmButtonText   : "Ya,   "+status+"-kan user" 
                       
                  }).then((result) => {
            if (result.value) {
              $.ajax({
                method  :'POST',
                url     :'{{ url('master/users/delete') }}',
                data    :{
                  id:id,
                  status:status,
                  '_token': $('input[name=_token]').val()
                },
                success:function(data){
                    Swal.fire({title:"Rubah status berhasil!", text:"user "+nama+" berhasil di-"+status+"-kan ", icon:"success"}
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
        toastr.success("Manifest Baru Berhasil ditambahkan!");
    </script>
@endif
@if(Session::get('message') == "updated")
    <script type="text/javascript">
        toastr.success("Data Manifest Berhasil diubah!");
    </script>
@endif
@endsection
