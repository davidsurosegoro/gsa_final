
<?php $__env->startSection('content'); ?>
<div class="row">
	<?php $__currentLoopData = $map; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-md-4 col-sm-4 mb-5">
		<div class="card card-custom">
		    <div class="card-header d-flex flex-row justify-content-between pt-5" style="min-height: 0px;">
		        <div class="w-75">
		            <a class="card-label" href="<?php echo e(url('peta-dinas/show/layer/'.$m->table_name)); ?>">
		                <?php echo e($m->nama_peta); ?>

		            </a>
		        </div>
		        <div class="w-25">
		           <span class="label label-dark label-inline mr-2" style="float:right;"><?php echo e($m->total_data->tot); ?></span>
		        </div>
		    </div>
		    <div class="card-body" id="<?php echo e($m->table_name); ?>">
		        <script type="text/javascript">
            var <?= $m->table_name?>  = new ol.source.ImageWMS({
              url:'https://bappeko.surabaya.go.id/geoserver/bappeko/wfs',
              serverType:'geoserver',
              params: {
                'FORMAT':'image/png',
                'VERSION':'1.1.1',
                'TILED':true,
                'LAYERS':'bappeko:<?= $m->table_name?> ',
                'STYLE':{},
                'TILESORIGIN':12533629.176504474 + "," + -820644.4616992897,
              },
              style:''
            });
            var layer_<?= $m->table_name ?> = new ol.layer.Image({
    name : '<?= $m->table_name ?>',
    baseLayer: false,
    DOM: '<?= $m->table_name ?>',
    source : <?= $m->table_name ?>
  });
      var map_<?=$m->table_name ?> = new ol.Map({
    layers: [layer_<?= $m->table_name ?>],
    loadTilesWhileInteracting: true,
    target: '<?= $m->table_name ?>',
    view: view
})
         </script>
		    </div>
		</div>
	</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/peta_dinas/show.blade.php ENDPATH**/ ?>