
<form method="POST" action="<?php echo e(url('api/draw/update')); ?>" id="update-attr-form">

    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="table_name" value="<?php echo e($map_name); ?>"> 
    <input type="hidden" name="gid" value="<?php echo e($attribut[0]->gid); ?>"> 
		<?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($loop->iteration > 1): ?>
			<?php $column_name = $f->column_name; ?>
				<?php if($f->column_name !== "geom"): ?>
				<div class="col-md-12 form-group">
					<label class="control-label"> <?php echo e($f->column_name); ?> </label>

						<?php if($f->data_type == "bigint" || $f->data_type == "numeric" || $f->data_type == "double precision"): ?>
						<input type="number" name="<?php echo e($f->column_name); ?>" class="form-control" value="<?php echo e($attribut[0]->$column_name); ?>" step="any" placeholder="_______" required>
						<?php else: ?>
						<input type="text" name="<?php echo e($f->column_name); ?>" class="form-control" value="<?php echo e($attribut[0]->$column_name); ?>" placeholder="_______" required>
						<?php endif; ?>
				</div>

				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<div class="row" style="padding-left: 25px;">
			<div class="col-md-offset-5">
			<button class="btn btn-md btn-primary" type="submit"> UBAH ATTRIBUT </button>
			<button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
		</div>
		</div>
</form>

<script type="text/javascript">
	$('#update-attr-form').on('submit',function(e){
		e.preventDefault();
		$(this).ajaxSubmit({
			success:function(data){
    		$('#modal-edit-attribut').modal('toggle');
				view.animate({zoom: 14}, {zoom:12});
				toastr.success("Data Peta Baru Berhasil diubah!");
  				vectorSource.clear();
			}
		})
	})
</script><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/draw/edit_data.blade.php ENDPATH**/ ?>