<?php $__currentLoopData = $skpd_non_tag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($s->kode); ?>">
	<?php echo e($s->skpd_nama); ?>

</option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/ajax/cbo_tagged.blade.php ENDPATH**/ ?>