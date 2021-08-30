@extends('layouts.app')
@section('content')
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label">Master invoice
      <span class="d-block text-muted pt-2 font-size-sm">Data invoice yang tersedia</span></h3>
    </div>
    <div class="card-toolbar">
      <a href="{{url('master/invoice/grouping') }}" class="btn btn-primary font-weight-bolder">
      <i class="la la-plus"></i>Tambah Data invoice</a>
    </div>
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr> 
              <th>Kode</th> 
              <th>Customer</th> 
              <th>Tanggal</th> 
              <th>Dibuat Oleh</th> 
              <th>Koli</th> 
              <th>Kg</th> 
              <th>doc</th> 
              <th>OA</th> 
              <th>Total Harga</th> 
              <th>Keterangan</th>  
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
        <h5 class="modal-title" >Rubah Status invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row" > 
        <form class="col-12 bg-light" style="padding-bottom:10px;" id="forminvoice_" method="post" action="{{url('master/invoice/updatestatus')}}">
          {{ csrf_field() }}
          <div class="form-group">
            <table class="table table-striped table-hover table-bordered">
              <tr>
                <td>Kode : </td>
                <td>Tanggal :</td> 
                <td>Customer :</td> 
              </tr>
              
              <tr>
                <td id='kodeinvoice_'></td>
                <td id='tanggalinvoice_'></td> 
                <td id='customer_name'></td>  
              </tr>
            </table>
            
            <input type="text" name="idinvoice" id="idinvoice" class="d-none"  > 
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect2">Status</label>
            <select class="form-control" id="status" name="status">
              <option value='paid'>paid</option>
              <option value='unpaid'>unpaid</option> 
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
      $('#customer_name'     ).html($(this).attr('namacustomer')) 
      $('#tanggalinvoice_'   ).html($(this).attr('tanggalinvoice'))
      $('#kodeinvoice_'      ).html($(this).attr('kodeinvoice'))

      $('#idinvoice'         ).val($(this).attr('idinvoice')) 
      $("#status").val($(this).attr('status'));
    })
    $(document).on("click","#simpanbutton",function() {
        var btnsave = $(this);
        $(this).prop('disabled', true);
        $.ajax({
            type      : "POST",
            url       : "{{url('master/invoice/updatestatus')}}",
            dataType  : "json",
            data      : $('#forminvoice_').serialize(),
            success : function(response) { 
                if(response && response.success && response.success=='success'){
                  toastr.success("Status Invoice berhasil dirubah!");                  
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
	     ajax       :'{{ url('master/invoice/datatables') }}',
	     columns    : [
         
      
          {data: 'kode',              name:'kode'},  
          {data: 'namacustomer',      name:'namacustomer'},  
          {data: 'tanggal_invoice',   name:'tanggal_invoice'},  
          {data: 'namauser',          name:'namauser'},  
          {data: 'total_koli',        name:'total_koli'},  
          {data: 'total_kg',          name:'total_kg'},  
          {data: 'total_doc',         name:'total_doc'},  
          {data: 'total_oa',          name:'total_oa'},  
          {data: 'total_harga',       name:'total_harga'},  
          {data: 'keterangan',        name:'keterangan'},  
          {data: 'status_info',       name:'Status'},
          {data: 'aksi',              name:'aksi'},
      ],
	   "order": [[ 1, "asc" ]],
    });

    var detailRows = [];
    

  </script>
  
@if(Session::get('message') == "created")
    <script type="text/javascript">
        toastr.success("Invoice Baru Berhasil ditambahkan!");
    </script>
@endif
@if(Session::get('message') == "updated")
    <script type="text/javascript">
        toastr.success("Data Invoice Berhasil diubah!");
    </script>
@endif
@endsection
