<?php $__currentLoopData = $summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
	<td><?php echo e($s->deskripsi_summary); ?></td>
	<td><?php echo e($s->attribut_query); ?></td>
	<td><?php echo e($s->hitungan); ?></td>
	<td>
		<?php if($s->group_by_kecamatan !== 'no'): ?>
<?php $kecamatan = collect(DB::select('SELECT layer_1 AS nama FROM maps.batas_kecamatan_query WHERE gid = '.$s->group_by_kecamatan))->first(); ?>
		Group By kecamatan <?php echo e($kecamatan->nama); ?> <br>
		<?php endif; ?>
		<?php if($s->filter !== 'no'): ?>
				Attribut : <?php echo e($s->attribut_filter_query); ?>

				<?php echo e($s->operator_filter_query); ?> <?php echo e($s->attribut_filter_query); ?> <?php echo e($s->value_filter_query); ?>

		<?php endif; ?>
		<?php if($s->group_by_kecamatan == 'no' && $s->filter == 'no'): ?>
			Tidak Ada
		<?php endif; ?>
	</td>
	<td>
		<?php echo e($s->value_summary); ?>

	</td>
	<td>
		<button class="btn btn-sm btn-danger-custom" onClick="deleteSummary('<?php echo e($s->table_name); ?>','<?php echo e($s->id); ?>')"><i class="fa fa-trash-o"> </i> </button> 
	</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/master_peta/ajax/keterangan_summary.blade.php ENDPATH**/ ?>