
<?php $__env->startSection('content'); ?>
<input type="hidden" name="">
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom ">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-chat-1 text-primary">
                        </i>
                    </span>
                    <h3 class="card-label">
                        Data Hasil Query
                        <small>
                            dari <?php echo e($table_name); ?>

                        </small>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="filtered_data" class="table-striped table-hovered">
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
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
	$('#filtered_data').DataTable({
			dom: 'Bfrtip',
		    processing: true,
		    serverSide: false,
		    paging:true,
		    ajax: '<?php echo e(url('popup/analisa/datatables-filtered-data/'.$kec)); ?>',
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.popup.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/popup/analisa/filtered_data.blade.php ENDPATH**/ ?>