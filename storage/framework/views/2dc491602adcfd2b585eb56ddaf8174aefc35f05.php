<div class="table-responsive">
    <table id="all-data" class="table-striped table-hover table-bordered">
        <thead>
            <tr>
                <?php $__currentLoopData = $column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <?php $count = count($column); ?>
	                <?php if($loop->iteration < $count): ?>
		        		<?php if($c->column_name !== "geom"): ?>
		                <th>
		                    <?php echo e($c->column_name); ?>

		                </th>
		                <?php endif; ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
    </table>
</div>
<script type="text/javascript">
		$('#all-data').DataTable({
			dom: 'Bfrtip',
		    processing: true,
		    serverSide: false,
		    paging:true,
		    ajax: '<?php echo e(url('ajax/analisa/datatables-all-data/'.$table_name)); ?>',
		     columns: [
		     <?php $__currentLoopData = $column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                <?php $count = count($column); ?>
	                <?php if($loop->iteration < $count): ?>
		        		<?php if($c->column_name !== "geom"): ?>
            				{data: '<?php echo e($c->column_name); ?>', name: '<?php echo e($c->column_name); ?>'},
		                <?php endif; ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ],
        buttons: [
				'excelHtml5',
			],
	   });
</script><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/analisa/ajax/all_data.blade.php ENDPATH**/ ?>