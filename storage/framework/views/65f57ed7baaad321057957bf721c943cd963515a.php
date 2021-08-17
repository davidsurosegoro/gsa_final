<?php if($map->table_name == "usulan_musrenbang"): ?>

<form class="form-horizontal frm-add-attr" method="POST" action="<?php echo e(url('attribut/save')); ?>">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="srid" value="<?php echo e($map->srid); ?>">
    <input type="hidden" name="table_name" value="<?php echo e($map->table_name); ?>"> 
	<div class="row">
		<div class="alert alert-warning alert-dismissable alert-style-1">
			<i class="zmdi zmdi-alert-circle-o"></i>Hi! Jika Anda Sudah yakin lokasi usulan musrenbang dititik tersebut maka langsung klik tombol simpan, lokasi usulan anda akan tersimpan. Terima Kasih
		</div>
	</div>

		<div class="row">
			<div class="col-md-offset-5">
			<button class="btn btn-md btn-success-custom" type="submit"> SIMPAN LOKASI USULAN </button>
			<button type="button" class="btn btn-danger-custom text-left" data-dismiss="modal">Close</button>
		</div>
		</div>
    <?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($loop->iteration > 1): ?>
				<?php if($f->column_name == "geom" ): ?>
				<input type="hidden" name="<?php echo e($f->column_name); ?>" class="geom">
				<?php else: ?>
				<input type="hidden" name="<?php echo e($f->column_name); ?>" class="id_musrenbang">
				<?php endif; ?>
		<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<?php $kelurahan = DB::select('SELECT gid, kelurahan FROM maps.batas_kelurahan_query');
$kecamatan = DB::select('SELECT gid, layer_1 FROM maps.batas_kecamatan_query');?>
<form class="form-horizontal frm-add-attr" method="POST" action="<?php echo e(url('api/draw/save')); ?>">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="srid" value="<?php echo e($map->srid); ?>">
    <input type="hidden" name="table_name" value="<?php echo e($map->table_name); ?>"> 
		<?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($loop->iteration > 1): ?>
		<div class="form-group">
			<label class="control-label col-md-2"> <?php echo e($f->column_name); ?> </label>
			<div class="col-md-12">
				<?php if($f->column_name == "geom" ): ?>
				<input type="text" name="<?php echo e($f->column_name); ?>" class="form-control geom" placeholder="_______" required readonly="true">
				<?php elseif($f->column_name == "kecamatan"): ?>
				<select class="selectpicker-ajax form-control" name="kecamatan" data-live-search="true">
					<?php $__currentLoopData = $kecamatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($k->layer_1); ?>"> <?php echo e($k->layer_1); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<?php elseif($f->column_name == "kelurahan"): ?>
				<select class="selectpicker-ajax form-control" name="kelurahan" data-live-search="true">
					<?php $__currentLoopData = $kelurahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($k->kelurahan); ?>"> <?php echo e($k->kelurahan); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<?php else: ?>
					<?php if($f->data_type == "bigint" || $f->data_type == "numeric" || $f->data_type == "double precision" ): ?>
					<input type="number" name="<?php echo e($f->column_name); ?>" step="0.0000000001"  class="form-control" placeholder="_______" required>
					<?php elseif($f->data_type == "date"): ?>
					<input type="date" name="<?php echo e($f->column_name); ?>" id="datepicker" class="form-control datepicker" placeholder="masukkan tanggal. . ." autocomplete="off">
					<?php else: ?>
					<input type="text" name="<?php echo e($f->column_name); ?>"  class="form-control" placeholder="_______" required>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<div class="row">
			<div class="col-md-offset-5">
			<button class="btn btn-md btn-primary" type="submit"> TAMBAH ATTRIBUT </button>
			<button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</form>
<?php endif; ?>
<script type="text/javascript">
	$('.frm-add-attr').on('submit',function(e){
		e.preventDefault();
		$(this).ajaxSubmit({
    	success:function(data){
    		$('#modal-attr').modal('toggle');
    		view.animate({zoom: 14}, {zoom:12});
			toastr.success("Data Peta Baru Berhasil ditambahkan!");
			vectorSource.clear();
		}
	})
	})
  $('.selectpicker-ajax').selectpicker({
    dropupAuto:false
  });
</script><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/draw/add_data.blade.php ENDPATH**/ ?>