
<?php $__env->startSection('content'); ?>
<div class="card card-custom gutter-b example example-compact">
<div class="card-header">
    <h3 class="card-title">SCANNER AWB <br>ke status -> <?php echo e(Crypt::decrypt($status)); ?> </h3>
    
</div> 
<input type='hidden' id='statusawb' value='<?php echo e($status); ?>' > 
<div class=" ">
    <div class="container">
       
        <div class="row">
            <div style="background-color: aqua; padding:10px;" id='allow'>1</div>
            <audio id="myAudio">
                <source src="<?php echo e(asset('assets/gsa/scanner/beep-06.mp3')); ?>" type="audio/ogg"> 
                Your browser does not support the audio element.
            </audio>
            <div class="col-sm-2" style="padding:1px;"> </div>
            <div class="col-md-8 col-sm-12 border" style=" position:relative;"> 
                
                
                <?php echo $__env->make('camera', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
               
                <video id="qr-video"  class="col-sm-12"></video>
                <img src="<?php echo e(asset('assets/gsa/img/face-loader.gif')); ?>" style="position: absolute;z-index:10; top:0; bottom:0;left:0;right:0; margin:auto; width:50%;">
                <select id="cam-list" class="form-control col-12 col-sm-5"  style="position: absolute;z-index:10; top:0;  right:0; margin:auto; ">
                    <option value="environment" selected>Pilih Kamera (default)</option>
                    <option value="user">User Facing</option>
                </select>
            </div>
            <div class='col-12 text-center'> 
                <span style="border:1px solid black;">
                    <b>Device has camera: </b>
                    <span id="cam-has-camera"></span>
                </span>
                <span style="border:1px solid black;">
                    <b>Camera has flash: </b>
                    <span id="cam-has-flash"></span>
                </span>
                <span id="cam-qr-result" class="d-none">None</span>
                <button id="flash-toggle">???? Flash: <span id="flash-state">off</span></button>
                <div> 
                    <button class="btn btn-sm btn-success" id="start-button">Buka Kamera</button>
                    <button class="btn btn-sm btn-danger" id="stop-button">Tutup Kamera</button>
                </div>
            </div>
            <div class="col-12 text-center">
                <div class="btn-group   mb-5"  >
                    <label class="btn btn-info" onclick="scanner.stop()" data-toggle="modal" data-target="#modalkodemanual" style="cursor: pointer;">
                        Input AWB Manual
                    </label> 
                </div>
            </div>    
        </div> 
    </div>  
</div>
<div class="modal  " id="modalpenerima"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Isi nama Penerima</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <input type="text" required class="form-control" name="diterima_oleh" id="diterima_oleh" value="" placeholder="diterima oleh"/>        
                <input type="hidden" required class="form-control" name="kodeawb_penerima" id="kodeawb_penerima" value="" placeholder="diterima oleh"/>        
            </div>
            <div class="modal-footer">
                <button type="button" onclick="updatepenerima()" class="btn btn-success" >Simpan</button> 
            </div>
        </div>
    </div>
</div> 
<div class="modal " id="modalkodemanual"    data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input kode AWB manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <input type="text" required class="form-control" name="kode_awb" id="kode_awb" value="" placeholder="kode AWB"/>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnclosemanual" data-dismiss="modal">Close</button> 
                <button type="button" class="btn btn-success" id='simpankodemanual' >Simpan</button> 
            </div>
        </div>
    </div>
</div> 
 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('assets/gsa/scanner2/qr-scanner.umd.min.js')); ?>"></script>
<script type="text/javascript">  
    // setTimeout(function(){ update_div() }, 3);
    function update_div(){
        if(allowscan==false){
            console.log('masuk')
            console.log(allowscan)
        }
        $('#allow').html(allowscan)
    }
    $( document ).ready(function() {
        // setInterval(update_div(), 200)
        setInterval(function(){ update_div()}, 1000);
        // scanner.stop();
        // scanner.start();
    });
    QrScanner.WORKER_PATH = "<?php echo e(asset('assets/gsa/scanner2/qr-scanner-worker.min.js')); ?>"  ;
    
    var allowscan       = true;  
    var xs      		= document.getElementById("myAudio");  
    const video         = document.getElementById('qr-video');
    const camHasCamera  = document.getElementById('cam-has-camera');
    const camList       = document.getElementById('cam-list');
    const camHasFlash   = document.getElementById('cam-has-flash');
    const flashToggle   = document.getElementById('flash-toggle');
    const flashState    = document.getElementById('flash-state');
    const camQrResult   = document.getElementById('cam-qr-result');  

    // ####### Web Cam Scanning #######

    // const scanner = new QrScanner(video, result => setResult(camQrResult, result), error => {
    //     camQrResult.textContent = error;
    //     camQrResult.style.color = 'inherit';
    // });
    const scanner = new QrScanner(video, result=> {
        console.log('decoded QR code: ' + result);
        if(result && allowscan){
            xs.play();   
            scanner.stop();
            var codeonly = result.split("/t/") 
            if(!codeonly[1] || !codeonly[2] || codeonly[2] == 'notforscan'){
                toastr.warning("kode AWB tidak valid!!") 
                
                
                    setTimeout(function(){ scanner.start() }, 800);
            }else{
                scan_update_status(codeonly[1],codeonly[2]);
            }
        }
        scanner.stop();
    });

    const updateFlashAvailability = () => {
        scanner.hasFlash().then(hasFlash => {
            camHasFlash.textContent = hasFlash;
            flashToggle.style.display = hasFlash ? 'inline-block' : 'none';
        });
    };

    scanner.start().then(() => {
        updateFlashAvailability();
        // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
        // at the same time which can result in listCamera's unconstrained stream also being offered to the scanner.
        // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
        // start the scanner earlier.
        QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
            const option = document.createElement('option');
            option.value = camera.id;
            option.text = camera.label;
            camList.add(option);
        }));
    });

    QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

    // for debugging
    window.scanner = scanner;


    camList.addEventListener('change', event => {
        scanner.setCamera(event.target.value).then(updateFlashAvailability);
    });

    flashToggle.addEventListener('click', () => {
        scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off');
    });

    document.getElementById('start-button').addEventListener('click', () => {
        scanner.start();
    });

    document.getElementById('stop-button').addEventListener('click', () => {
        scanner.stop();
    });
    
    function setResult(label, result) {
        label.textContent = result; 
        label.style.color = 'teal';
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100); 
        if(result){
            xs.play();   
            scanner.stop();
            var codeonly = result.split("/t/") 
            if(!codeonly[1] || !codeonly[2] || codeonly[2] == 'notforscan'){
                toastr.warning("kode AWB tidak valid!!") 
                
                
                    setTimeout(function(){ scanner.start() }, 800);
            }else{
                scan_update_status(codeonly[1],codeonly[2]);
            }
        }
    }
    
    $('#btnclosemanual').click(function(){
        scanner.start();
    })
    $('#simpankodemanual').click(function(){
        scan_update_status($('#kode_awb').val(),'all');
    })

    $(document) .ajaxStart(function () {
        $('#loading').removeClass('d-none')
    })          .ajaxStop(function () {
        $('#loading').addClass('d-none')
    }); 
    function scan_update_status(kode_awb_or_manifest, qty){
        if(allowscan){
            allowscan=false;
            $.ajax({
                method  :'POST',
                url     :'<?php echo e(url('awb/updateawb')); ?>',
                data    :{
                    kode        : kode_awb_or_manifest,
                    qty         : qty,
                    status      : $('#statusawb').val(),
                    '_token'    : "<?php echo e(csrf_token()); ?>" 
                },
                success:function(data){
                    $('#kode_awb').val('')
                    if(data.statuserror)    {toastr.error( data.statuserror)}
                    if(data.statuswarning)  {
                        $('#modalkodemanual').modal('hide');
                        toastr.warning( data.statuswarning)
                        $('.modal-backdrop').remove();
                    }
                    if(data.statussuccess)  {
                        toastr.success( data.statussuccess)
                        $('#modalkodemanual').modal('hide');
                        $('.modal-backdrop').remove();
                    }                  
                    if(data.openmodal == 'open'){
                        $('#modalpenerima').modal('show');
                        $('#kodeawb_penerima'   ).val(kode_awb_or_manifest)
                        $('#diterima_oleh'      ).val(data.awb.diterima_oleh)
                    }else{
                        
                        // scanner.start() 
                        //     allowscan==true;
                        setTimeout(function(){ 
                            scanner.start() 
                            allowscan=true;
                        }, 1500);
                    } 
                }
            }) 
        }
    }
    function updatepenerima(){
        $.ajax({
            method  :'POST',
            url     :'<?php echo e(url('awb/updatediterima')); ?>',
            data    :{
                kode            : $('#kodeawb_penerima').val(),
                diterima_oleh   : $('#diterima_oleh').val(),
                '_token'        : "<?php echo e(csrf_token()); ?>" 
            },
            success:function(data){ 
                if(data.statussuccess)  {
                    toastr.success( data.statussuccess) 
                    $('#modalpenerima').modal('hide');
                    $('#diterima_oleh'      ).val('')
                }   
                    setTimeout(function(){ scanner.start() }, 800); 
            }
        }) 
    }
	
</script> 
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/scanner/qr-testing.blade.php ENDPATH**/ ?>