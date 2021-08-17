<?php $__currentLoopData = $form_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($f->column_name !== "geom" && $loop->iteration > 1): ?>
<tr>
	<td><?php echo e($f->column_name); ?> </td>
	<td><?php echo e($f->data_type); ?> </td>
	<td> <button class="btn btn-sm btn-icon btn-danger" onClick="deleteAttr('<?php echo e($f->column_name); ?>','<?php echo e($map_name); ?>')"><i class="flaticon-delete"> </i> </button> </td>
</tr>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/ajax/kelola.blade.php ENDPATH**/ ?>