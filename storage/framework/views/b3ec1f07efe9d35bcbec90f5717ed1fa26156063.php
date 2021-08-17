<?php $__currentLoopData = $tagged_pd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
	<td>
		<?php echo e($t->skpd_nama); ?>

	 </td>
	 <td>
	     <button type="button" class="btn btn-danger btn-sm" onClick="deleteTag(<?php echo e($t->tag_id); ?>)" ><i class="fa fa-trash"> </i></button>
	 </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/ajax/tagged_pd.blade.php ENDPATH**/ ?>