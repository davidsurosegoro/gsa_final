<?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($loop->iteration > 1): ?>
<option value="<?php echo e($f->column_name); ?>">
	( <?php echo e($f->data_type); ?> ) <?php echo e($f->column_name); ?> 
</option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/ajax/label_styling.blade.php ENDPATH**/ ?>