
<?php $__env->startSection('content'); ?>
<input type="hidden" id="table_name" value="aset_gabung_fix">
<input type="hidden" id="map_type" value="<?php echo e($map_data->type); ?>">
<input type="hidden" id="cbo-menggambar" value="aset_gabung_fix">
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom ">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-chat-1 text-primary">
                        </i>
                    </span>
                    <h3 class="card-label">
                    	Peta Aset 
                        <small>
                            data attribut sinkron dengan simbada
                        </small>
                    </h3>
                </div>
                <div class="card-toolbar">
                	<a href="#" class="btn btn-success" id="on-menggambars"> Ubah Peta</a>
                	<a href="#" class="btn btn-danger" id="off-menggambars"> Non Aktifkan Mode Menggambar</a>
                    <form method="get" class="quick-search-form">
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

 <div class="modal fade" id="modal-attr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myLargeModalLabel">Konfirmasi Ubah Peta
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </h5>
                                                    </div>
                                                    <div class="modal-body" id="">
                                                    	<div class="row">
                                                    		<div class="col-md-12">
                                                        <form method="POST" action="<?php echo e(url('simbada/update')); ?>" id="frm-save">
                                                        	<?php echo e(csrf_field()); ?>

                                                        	<input type="hidden" name="geom" class="geom" value="">
                                                        	<input type="hidden" name="id" value="<?php echo e($id); ?>">
                                                        	<input type="hidden" name="srid" value="32749">
                                                        	<div class="alert alert-info"> 
                                                        		Apakah anda yakin menyimpan hasil input anda ? <strong> Data Attribut yang tersimpan akan sesuai dengan no-register yang terpilih hasil gambar sebelumnya akan diganti dengan hasil gambar anda saat ini.</strong>
                                                        	</div>
                                                        	<button type="submit"  class="btn btn-lg btn-primary">
                                                        		Ya, Simpan Peta 
                                                        	</button>
                                                        	<button type="button"  class="btn  btn-lg  btn-danger" data-dismiss="modal" aria-hidden="true">
                                                        		Batal 
                                                        	</button>
                                                        </form>
                                                    </div>
                                                    </div>
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
  centerOn(<?php echo e($id); ?>,19)
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.popup.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/popup/simbada/show.blade.php ENDPATH**/ ?>