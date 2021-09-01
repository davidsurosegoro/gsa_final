
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">SCANNER AWB <br>ke status -> <?php echo e(Crypt::decrypt($status)); ?> </h3>
</div> 
<input type='hidden' id='statusawb' value='<?php echo e($status); ?>' > 
<div class=" ">
    <div class="container">
        <div class="row">
            <audio id="myAudio">
                <source src="<?php echo e(asset('assets/gsa/scanner/beep-06.mp3')); ?>" type="audio/ogg"> 
                Your browser does not support the audio element.
            </audio>
            <div class="col-sm-2" style="padding:1px;"> </div>
            <div class="col-md-8 col-sm-12 border" style=" position:relative;">
                <video id="preview" class="col-sm-12" >
                </video>
                <img src="<?php echo e(asset('assets/gsa/img/face-loader.gif')); ?>" style="position: absolute;z-index:10; top:0; bottom:0;left:0;right:0; margin:auto; width:50%;">
            </div>
            <div class="col-12 text-center">
                <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
                    </label>
                    
                </div>
                <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                    <label class="btn btn-danger">
                        <input type="radio"  onClick="scanner.stop()" > Stop Camera
                    </label>
                    <label class="btn btn-success">
                        <input type="radio"  onClick="scanner.start()" > Open Camera
                    </label>
                </div>
            </div>
        </div> 
    </div>  
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('assets/gsa/scanner/js-scanner.js')); ?>"></script> 
<script src="<?php echo e(asset('assets/gsa/scanner/custom-js-scanner.js')); ?>"></script> 
<script type="text/javascript"> </script>
       
<script type="text/javascript"> 
	$(document).ready(function(){   
		
		scanner.addListener('scan',function(kode_awb_or_manifest){ 
			scanner.stop() 
			x.play();  
            $.ajax({
                method  :'POST',
                url     :'<?php echo e(url('awb/updateawb')); ?>',
                data    :{
                    kode        : kode_awb_or_manifest,
                    status      : $('#statusawb').val(),
                    '_token'    : "<?php echo e(csrf_token()); ?>" 
                },
                success:function(data){
                    if(data.statuserror)    {toastr.error( data.statuserror)}
                    if(data.statuswarning)  {toastr.warning( data.statuswarning)}
                    if(data.statussuccess)  {toastr.success( data.statussuccess) }                  
                    
					scanner.start()
                     
                }
            }) 
		});

	}); 
	
</script>
<?php if(Session::get('message') == "kodesudahada"): ?>
<script type="text/javascript">
    toastr.error("Kode kota sudah ada!");
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/scanner/qrawb.blade.php ENDPATH**/ ?>