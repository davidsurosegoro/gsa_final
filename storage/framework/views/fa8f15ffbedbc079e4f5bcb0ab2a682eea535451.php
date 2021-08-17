
<?php $__env->startSection('content'); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
	                        <div class="modal-content">
	                            <div class="modal-header">
	                                <h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
	                            </div>
	                            <div class="modal-body">

                    	<form class="form-horizontal" id="frm-download" action="<?php echo e(url('download/lidar')); ?>" method="POST">
                    		<?php echo e(csrf_field()); ?>

	                            	<input class="form-control" name="token" id="inputEmail3" type="password" placeholder="Inputkan token untuk download lidar disini. . .">
	                            </div>
	                            <div class="modal-footer">
	                                <button class="btn btn-primary ml-2" type="SUBMIT">Download</button>
	                            </div>
	                        </div>
                        </form>
                    </div>
                </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#exampleModal').modal({backdrop: 'static', keyboard: false})  
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.popup.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/pages/popup/download/lidar.blade.php ENDPATH**/ ?>