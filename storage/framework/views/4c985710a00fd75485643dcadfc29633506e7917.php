
<?php $__env->startSection('content'); ?>
<input type="hidden" id="table_name" value="<?php echo e($table_name); ?>">
<input type="hidden" id="map_type" value="<?php echo e($map_data->type); ?>">
<input type="hidden" id="tahun_data" value="<?php echo e($map_data->tahun); ?>">
<input type="hidden" id="cbo-menggambar" value="<?php echo e($table_name); ?>">
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom ">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="fas fa-map-marked-alt text-primary">
                        </i>
                    </span>
                    <h3 class="card-label">
                    	Peta <?php echo e($map_data->nama_peta); ?> 
                        <small>
                            Data sinkron dengan Edata dan akan otomatis tampil di Monev
                        </small>
                    </h3>
                </div>
                <div class="card-toolbar">
                	<a href="#" class="btn btn-success" id="on-menggambars"> Gambar Peta</a>
                	<a href="#" class="btn btn-danger" id="off-menggambars"> Non Aktifkan Mode Menggambar</a>
                    <form method="get" class="quick-search-form ml-5">
                        <div class="input-group rounded" >
                            <div class="input-group-prepend search-brand">
                                <span class="input-group-text" id="btn-change-lat-long" style="cursor: pointer;">
                                    <span class="svg-icon svg-icon-lg">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                        <i class="flaticon-search-magnifier-interface-symbol"></i>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                            </div>
                            <input type="text" style="color:#a7a6a6" class="inputsearch search-custom h-45px" placeholder="Cari Jalan...">
                        </div>
                    </form>
                </div>
            </div>
            <div id="map" style="height:100vh;">
            </div>
        </div>
    </div>
</div>
<div id="popup" class="ol-popup" style="padding:0px; ">
		<div class="row" style="background-color: #5491B8; height: 22.5px;"></div>

   <a href="#" id="popup-closer" class="ol-popup-closer" style="color: white;"></a>
    <a href="#" id="popup-edit" class="ol-popup-edit" style="color:white;"> <i class="flaticon2-pen"  style="color:white;"> </i> </a>
    <a href="#" id="popup-delete" class="ol-popup-delete" style="color:white;"> <i class="flaticon2-trash"  style="color:white;"> </i> </a>
    
   <table id="popup-content" style="padding:7.5px;">
   </table>
    <div id="popup-foto" style="padding-top:5px;">
<!--
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
        <img src="<?php echo e(asset('/img/surabaya.png')); ?>" class="img-thumbnail" width="75">
-->
     </div>
</div>

    <div class="modal fade" id="modal-edit-attribut-edata" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title" id="myLargeModalLabel">Ubah Attribut Peta - <b id="title-modal-edit-attribut-edata">A </b> </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                      <center id="spinner-load-edit-edata">
                                                        <img src="<?php echo e(asset('img/spinner.gif')); ?>" >
                                                      </center>
                                                      <iframe id="edit_edata" height="600" width="100%" src="http://bappeko.surabaya.go.id/edata2018/api/data-master/view-data/wRAq2nu40a/178/2017/0600" name="iframe_modal"></iframe>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-left close-modal-attr-edata" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
   <div class="modal fade" id="modal-attr-edata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close close-modal-attr-edata" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h5 class="modal-title" id="myLargeModalLabel">Tambah Attribut <span id="title-modal-add-attribut-edata"> </span> </h5>
                                                    </div>
                                                    <div class="modal-body" id="form-modal-add-attribut-edata">
                                                      <center id="spinner-load-edata">
                                                        <img src="<?php echo e(asset('img/spinner.gif')); ?>" >
                                                      </center>
                                                      <iframe id="insert_edata" height="600" width="100%" src="http://bappeko.surabaya.go.id/edata2018/api/data-master/view-data/wRAq2nu40a/178/2017/0600" name="iframe_modal"></iframe>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger text-left close-modal-attr-edata" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
	
var layer_popup = addLayer($('#table_name').val())
  layerActive.push(layer_popup);
  layers.push(layer_popup.get('name'))
  map.addLayer(layer_popup);


var eventMethod = window.addEventListener
      ? "addEventListener"
      : "attachEvent";
  var eventer = window[eventMethod];
  var messageEvent = eventMethod === "attachEvent"
    ? "onmessage"
    : "message";

  eventer(messageEvent, function (e) {
    
    // if (e.origin !== 'http://the-trusted-iframe-origin.com') return;
    
    if (e.data === "edataProsesMenyimpan"){
      console.log('proses')
    } 
    if (e.data === "edataProsesGagal"){
      console.log('gagal')
      toastr.error('Proses gagal')
    } 
    if (e.data === "edataProsesBerhasil"){
      console.log('berhasil')
      $('#modal-attr-edata').modal('toggle');
      view.animate({
          zoom: 14
      }, {
          zoom: 12
      });
      toastr.success("Attribut Peta Berhasil Disimpan,Data Peta otomatis tersimpan di Edata")
    } 
    if(e.data === "edataProsesBerhasilUpdate"){

      $('#modal-edit-attribut-edata').modal('toggle');
      view.animate({
          zoom: 14
      }, {
          zoom: 12
      });
      toastr.success("Attribut Peta Berhasil Diubah,Data Peta otomatis tersimpan di Edata")
      mkNoti("Attribut Peta Berhasil Diubah", "Data Peta otomatis tersimpan di Edata", options_success_notif);
    }
    
    console.log(e);
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.popup.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/popup/edata/index.blade.php ENDPATH**/ ?>