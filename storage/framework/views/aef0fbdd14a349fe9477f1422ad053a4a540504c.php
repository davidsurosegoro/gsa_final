
<?php $__env->startSection('content'); ?>

<input type="hidden" id="map_name" value="aset_gabung_fix">
<input type="hidden" id="table_name" value="batas_kecamatan_query">
<input type="hidden" id="nama_kec" value="<?php echo e($batas_kec_id->layer_1); ?>">
<div class="row mb-2" style="">
	<div class="col-md-12">
		<div class="card card-custom">
			<div class="d-flex flex-row justify-content-between mb-2">
				<div class="w-75 " >
				  	<button class="btn btn-outline-info" id="btn-view-all-map-data" data-toggle="modal" data-target="#modal-data">
				        <i class="fas fa-table"> </i> Buka Data Tabular
				  	 </button>
				</div>
				<div class="w-25" >
					<div class="form-group">
						<div class="input-icon search-brand">
							<input type="text" class="inputsearch form-control" placeholder="Search...">
							<span>
								<i class="flaticon2-search-1 icon-md"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div id="map" style="height:100vh;">
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-data" >
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Peta <strong id="title-modal"></strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive" id="table-modal-all-attribut">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/map/paparan/aset_kecamatan.js')); ?>"></script>
<script type="text/javascript">
	centerOn(<?php echo e($batas_kec_id->gid); ?>,15)
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/paparan/aset_kecamatan.blade.php ENDPATH**/ ?>