
<?php $__env->startSection('content'); ?>
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title row">
      <h3 class="card-label col-12" style="margin:0px; padding:0px;margin-bottom:5px;">Data AWB
        <span class="d-block text-muted pt-2 font-size-sm">Data AWB yang tampil adalah data 2 bulan terakhir, untuk lebih lengkap dapat melihat data di report AWB</span>
        <?php if(((int) Carbon\Carbon::now()->addHours(7)->format('H') >= 16  && (int)Auth::user()->level == 2)  ): ?>    
          <span class="d-block text-muted pt-2 font-size-sm" style="color:red !important;background-color:rgb(255, 255, 137);padding:5px;">Batas maksimal order jam 16.00</span>
        <?php endif; ?>
      </h3>
      <select id='status_complete' class="form-control col-xs-12 col-md-3 " id="exampleFormControlSelect1">
        <option value='-'>Sembunyikan complete</option>
        <option value="complete">Tampilkan complete</option>
      </select> 
    </div>
    <div class="card-toolbar">  
        
      <div onclick="datatable.ajax.reload();" class="btn btn-default  text-center">
      <i class="fa fa-refresh text-center"></i></div>
      &nbsp;
      
        <a href="<?php echo e(url('awb/edit/0/0')); ?>" class="btn btn-primary font-weight-bolder">
        <i class="la la-plus"></i>Buat AWB Baru </a>
        &nbsp;
      
      
    </div>
    
  </div>
  <div class="card-body">
      <div class="table-responsive">
        <table id="datatables" class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th></th>
              <th>No AWB</th>
              <th>Pengirim</th>
              <th>Kota Asal</th>
              <th>Kota Tujuan</th>
              <th>Tanggal</th>
              <th>Agen Tujuan</th>
              <th>Qty Detail</th>
              <th>Status</th>
              <th>Qty</th>
              <?php if((int)Auth::user()->level == 1): ?>                  
                <th>Ubah status</th>
              <?php endif; ?>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg bd-example-modal-lg_" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xs">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Rubah Status Manifest</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row" > 
        <div class="col-12 bg-light" style="padding-bottom:10px;" id="formawb"  > 
          <div class="form-group">
            <table class="table table-striped table-hover table-bordered">
              <tr>
                <td>Kode : </td>
                <td>Tanggal :</td> 
                <td>Kota asal :</td> 
                <td>Kota Tujuan :</td> 
              </tr>
              
              <tr>
                <td id='kodeawb_'></td>
                <td id='tanggalawb_'></td> 
                <td id='Kotaasal_'></td> 
                <td id='kotatujuan_'></td> 
              </tr>
            </table>
            
            <input type="text" name="idawb_" id="idawb_" class="d-none"  > 
            <input type="text" name="kodeawb_" id="kodeawb_" class="d-none"  > 
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect2">Status</label>
            <select class="form-control" id="status" name="status">
              <option class='options_'                              value=''>                     pilih status</option> 
              <option class='options_' id='loaded'                  value='loaded'>               loaded</option> 
              <option class='options_' id='at-agen'                 value='at-agen'>              at-agen</option> 
              <option class='options_' id='delivery-by-courier'     value='delivery-by-courier'>  delivery-by-courier</option> 
              <option class='options_' id='complete'                value='complete'>             complete</option>  
            </select>
          </div>
          <div class="form-group" > 
            <button type="button" class="pull-left btn btn-secondary" data-dismiss="modal">Close</button> 
            <button type="submit" id='simpanbutton' class="btn btn-primary pull-right mr-2">SIMPAN</button>
          </div>
        </div>
      </div> 
    </div>
  </div>
</div>
<div class="modal  " id="modalpenerima"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Isi nama Penerima</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <input type="text" required class="form-control" name="diterima_oleh" id="diterima_oleh" value="" placeholder="diterima oleh"/>        
                <input type="hidden" required class="form-control" name="kodeawb_penerima" id="kodeawb_penerima" value="" placeholder="diterima oleh"/>        
            </div>
            <div class="modal-footer">
                <button type="button" onclick="updatepenerima()" class="btn btn-success" >Simpan</button> 
            </div>
        </div>
    </div>
</div> 

<?php echo $__env->make('pages.awb.ajax.modal_koli', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('pages.awb.ajax.modal_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    
  $(document).on("click",".openstatus",function() {
      $('#Kotaasal_'          ).html($(this).attr('kodekotaasal'))
      $('#kotatujuan_'        ).html($(this).attr('kodekotatujuan'))
      $('#tanggalawb_'        ).html($(this).attr('tanggalawb'))
      $('#kodeawb_'           ).html($(this).attr('kodeawb'))

      $('#idawb_'        ).val($(this).attr('idawb')) 
      $('#kodeawb_'      ).val($(this).attr('kodeawb')) 

      // CEK, jika status adalah at manifest, booked, cancel, maka di set 0 (pilih status)
      $("#status"        ).val(
          (
            ($(this).attr('status') !='at-manifest' && $(this).attr('status') !='booked' && $(this).attr('status') !='cancel') 
            ? $(this).attr('status') 
            : ''
          )
        );

      // $('.options_').removeClass('d-none')
      // if($(this).attr('status') == 'delivering'){
      //   $('#checked').addClass('d-none')
      // }
      // else if($(this).attr('status') == 'arrived'){
      //   $('#checked'   ).addClass('d-none')
      //   $('#delivering').addClass('d-none')
      // }
    })
    $('#status_complete').change(function(){
      console.log($('#status_complete').val())
      datatable.ajax.reload();
    })
  var datatable = $('#datatables').DataTable({
	    processing    : true,
	    serverSide    : false,
	    paging        : true,      
        pageLength    : 100,
	    // ajax          : '<?php echo e(url('awb/datatables')); ?>',
      ajax:  {
            "url": '<?php echo e(url('awb/datatables')); ?>',
            data: function(d){
                d.status_complete = $('#status_complete').val();
            }
        },
      "columnDefs": [{
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('paddingLeft', '2px')
                    $(td).css('paddingRight', '2px')
                }
            }],
	    columns: [
	    {data: 'id',              name:'id'},
	    {data: 'noawb',           name:'noawb'},
	    {data: 'nama_pengirim_link',   name:'nama_pengirim_link'},
	    {data: 'kota_asal',       name:'kota_asal'},
	    {data: 'kota_tujuan',     name:'kota_tujuan'},
	    {data: 'tanggal_awb',     name:'tanggal_awb'},
	    {data: 'agen_stat',       name:'agen_stat'},
	    {data: 'qty_stat',        name:'qty_stat'},
	    {data: 'status_tracking', name:'status_tracking'},
	    {data: 'qty',             name:'qty'},
      
      <?php if((int)Auth::user()->level == 1): ?>                  
        {data: 'gantistatus', name:'gantistatus'},
      <?php endif; ?>
	    {data: 'aksi', name:'aksi'},
	],
	 "order": [[ 0, "desc" ]],
   "createdRow": function( row, data, dataIndex){
                if( data.qty < 0){
                    $(row).addClass('redsoftbg');
                }
            }
   });
   datatable.column(0).visible(false); 

   
   $('#simpanbutton').click(function(){
    if($(`#status`).val() == ''){
      toastr.warning("Pilih Status terlebih dahulu !") 
    }else{

      Swal.fire({   
          title               : "Anda Yakin?",   
          text                : "Merubah status AWB -> "+$('#kodeawb_').val()+", menjadi ("+$('#status').val()+") status yang sudah dirubah, tidak bisa dikembalikan lagi",   
          icon                : "warning",   
          showCancelButton    : true,   
          confirmButtonColor  : "#e6b034",   
          confirmButtonText   : "Ya, Rubah status ke - " +$('#status').val()                  
        }).then((result) => {
          console.log(result)
        if (result.value) { 
          scan_update_status($('#kodeawb_').val(),'all'); 
        } else{
          $(btnsave).prop('disabled', false);

        }
      });
    }
  })
   function scan_update_status(kode_awb_or_manifest, qty){
        $.ajax({
            method  :'POST',
            url     :'<?php echo e(url('awb/updateawb')); ?>',
            data    :{
                kode                : kode_awb_or_manifest,
                qty                 : qty,
                status_nonencrypt   : $(`#status`).val(),
                '_token'            : "<?php echo e(csrf_token()); ?>" 
            },
            success:function(data){
              datatable.ajax.reload();
                $('.bd-example-modal-lg').modal('toggle');
                $('#kode_awb').val('')
                if(data.statuserror)    {toastr.error( data.statuserror)}
                if(data.statuswarning)  { 
                    toastr.warning( data.statuswarning) 
                }
                if(data.statussuccess)  {
                    toastr.success( data.statussuccess) 
                } 
                if(data.openmodal == 'open'){
                    $('#modalpenerima').modal('show');
                    $('#kodeawb_penerima'   ).val(kode_awb_or_manifest)
                    $('#diterima_oleh'      ).val(data.awb.diterima_oleh)
                }       
            }
        }) 
    } 
    function updatepenerima(){
        $.ajax({
            method  :'POST',
            url     :'<?php echo e(url('awb/updatediterima')); ?>',
            data    :{
                kode            : $('#kodeawb_penerima').val(),
                diterima_oleh   : $('#diterima_oleh').val(),
                '_token'        : "<?php echo e(csrf_token()); ?>" 
            },
            success:function(data){ 
                datatable.ajax.reload();
                if(data.statussuccess)  {
                    toastr.success( data.statussuccess) 
                    $('#modalpenerima').modal('hide');
                    $('#diterima_oleh'      ).val('')
                }    
            }
        }) 
    }
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
                            url:'<?php echo e(url("awb/delete")); ?>',
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
<?php if($hide_qty == "true"): ?>
  datatable.column(6).visible(false);  
  datatable.column(8).visible(false);
<?php endif; ?>
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
                            url:'<?php echo e(url("awb/manifest")); ?>',
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

    function modalKoli(id){
      $.ajax({
              method:'POST',
              url:'<?php echo e(url("awb/koli")); ?>',
              data:{
                id:id,
                '_token': $('input[name=_token]').val()
              },
              success:function(data){
                console.log(data.awb.is_agen)
                if(data.awb.is_agen == 1){
                  $('#table-not-agen').hide();
                  $('#table-agen').show();
                }
                else{
                  $('#table-not-agen').show();
                  $('#table-agen').hide();
                }
                $('#kecil').html(data.awb.qty_kecil)
                $('#sedang').html(data.awb.qty_sedang)
                $('#besar').html(data.awb.qty_besar)
                $('#besarbanget').html(data.awb.qty_besarbanget)
                $('#doc').html(data.awb.qty_doc)
                $('#kg').html(data.awb.qty_kg)
                $('#qty').html(data.awb.qty)
                $('.total_harga').html(data.awb.total_harga)
                $('.total_oa').html(data.awb.idr_oa).number(true)
                $('#noawb_koli').html(data.awb.noawb).number(true)
                $('.total_harga').number(true)
                $('.total_oa').number(true)
                if(data.awb.qty < 0){
                  $('.minus_harga').html('-')
                }
                else{
                  $('.minus_harga').html('')
                }
              } 
            })
    }
    function detail(id){
      $.ajax({
              method:'POST',
              url:'<?php echo e(url("awb/show")); ?>',
              data:{
                id:id,
                '_token': $('input[name=_token]').val()
              },
              success:function(data){
                console.log(data)
                $('#res_show_awb').html(data.view)
              } 
            })
    }
</script>

<?php if(Session::get('message') == "created"): ?>
    <script type="text/javascript">
        toastr.success("AWB Baru Berhasil ditambahkan!");
    </script>
<?php endif; ?>
<?php if(Session::get('message') == "updated"): ?>
    <script type="text/javascript">
        toastr.success("Data AWB Berhasil diubah!");
    </script>
<?php endif; ?>
<?php if(Session::get('failed_customer') !== null): ?>
    <script type="text/javascript">
        toastr.error("Data AWB Gagal diubah! Customer <?php echo e(Session::get('failed_customer')); ?> Belum ada di data agen");
    </script>
<?php endif; ?>
<?php if(Session::get('outoftime') !== null): ?>
    <script type="text/javascript">
        toastr.error("Data AWB Gagal dibuat! <BR>Sudah melebihi jam input hari ini");
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/awb/index.blade.php ENDPATH**/ ?>