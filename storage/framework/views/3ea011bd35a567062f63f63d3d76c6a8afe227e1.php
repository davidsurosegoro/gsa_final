<table class="table table-hovered table-striped">
	<tr>
		<td> Nama Peta :  </td>
		<td><?php echo e($map[0]->nama_peta); ?> </td>
	</tr>
	<tr>
		<td>Jenis Peta :</td>
		<td> <?php echo e($map[0]->type); ?></td>
	</tr>
	<?php if($map[0]->type == "Polygon"): ?>
	<tr>
		<td>Total Luas (m2) : </td>
		<td> <?php echo e($tot_luas); ?></td>
	</tr>
	<?php elseif($map[0]->type == "LineString"): ?>
	<tr>
		<td>Total Panjang (m) :</td>
		<td><?php echo e($tot_luas); ?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td>Tahun :</td>
		<td> <?php echo e($map[0]->tahun); ?></td>
	</tr>
	<tr>
		<td>Projection : </td>
		<td>EPSG : <?php echo e($map[0]->srid); ?></td>
	</tr>
	<tr>
		<td> Jumlah : </td>
		<td> <?php echo e($total_data); ?> </td>
	</tr>
	<tr>
		<td> Sumber Data : </td>
		<td> <?php echo e($map[0]->skpd_nama); ?> </td>
	</tr>
</table><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/ajax/tentang.blade.php ENDPATH**/ ?>