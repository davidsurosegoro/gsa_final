<?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($loop->iteration > 1): ?>
		<?php if($f->column_name !== "geom"): ?>
		<option value="<?php echo e($f->column_name); ?>"><?php echo e($f->column_name); ?> </option>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/ajax/cbo_categorized.blade.php ENDPATH**/ ?>