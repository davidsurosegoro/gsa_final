

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="<?php echo e(url('master/manifest')); ?>">
                                                    <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                        <i class="icon-6x text-info mb-10 mt-10 fa fa-file-text-o" aria-hidden="true"></i>
                                                    </span>
                                                    </a>
                                                    <br>
                                                    <a href="<?php echo e(url('master/manifest')); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Manifest</a>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5" data-toggle="modal" data-target="#modalscanner" style="cursor: pointer;"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center"> 
                                                <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                    <i class="icon-6x text-info mb-10 mt-10 fa fa-qrcode" aria-hidden="true"></i>
                                                </span> 
                                                <br>
                                                <div class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Scanner AWB</div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5" data-toggle="modal" data-target="#modalscannermanifest" style="cursor: pointer;"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center"> 
                                                <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                    <i class="icon-6x text-info mb-10 mt-10 fa fa-qrcode" aria-hidden="true"></i>
                                                </span> 
                                                <br>
                                                <div class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Scanner Manifest</div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-6 col-lg-3 col-xl-3 mb-5" data-toggle="modal" data-target="#modalreport" style="cursor: pointer;"> 
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center"> 
                                                <span class="svg-icon svg-icon-primary svg-icon-6x"> 
                                                    <i class="icon-6x text-info mb-10 mt-10 fas fa-book" aria-hidden="true"></i>
                                                </span> 
                                                <br>
                                                <div class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Report</div>
                                            </div>
                                        </div> 
                                    </div>
    </div>

    <div class="modal fade" id="modalscanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Scan AWB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <?php if(!Browser::isChrome() ): ?> 
                        <div class="alert alert-alert row" style="
                        color: #856404;
                        background-color: #fff3cd;
                        border-color: #ffeeba;">
                            <img src="<?php echo e(asset('assets/gsa/img/chrome.png')); ?>" class="col-2" style="object-fit: contain;">
                            <div class="col-10">
                                Untuk kelancaran scan QR, Gunakan browser google chrome
                                <a href="https://www.google.com/chrome/?brand=CHBD&gclid=CjwKCAjw7fuJBhBdEiwA2lLMYXmsMZsuOvkh0CG2ld2zkAV2WnWiVakTdwrk5F-g2BPEY1yQjqNLGhoCqsoQAvD_BwE&gclsrc=aw.ds">
                                    click disini untuk download chrome
                                </a> atau download pada playstore/appstore
                            </div>
                        </div>
                    <?php endif; ?> 

                    
                    <a  href="<?php echo e(url('scannerawb/'.Crypt::encrypt('loaded').'')); ?>"                 class="btn btn-primary btn-lg btn-block"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Scan Loading ke truck</a> 
                    <a  href="<?php echo e(url('scannerawb/'.Crypt::encrypt('delivery-by-courier').'')); ?>"    class="btn btn-primary btn-lg btn-block"><i class="fa fa-motorcycle" aria-hidden="true"></i> &nbsp;Scan pengantaran ke tujuan</a> 
                    <a  href="<?php echo e(url('scannerawb/'.Crypt::encrypt('complete').'')); ?>"               class="btn btn-primary btn-lg btn-block"><i class="fa fa-check-square" aria-hidden="true"></i>&nbsp;Scan sudah tiba di tujuan</a> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalscannermanifest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Scan Manifest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                    
                    <?php if(!Browser::isChrome() ): ?> 
                        <div class="alert alert-alert row" style="
                        color: #856404;
                        background-color: #fff3cd;
                        border-color: #ffeeba;">
                            <img src="<?php echo e(asset('assets/gsa/img/chrome.png')); ?>" class="col-2" style="object-fit: contain;">
                            <div class="col-10">
                                Untuk kelancaran scan QR, Gunakan browser google chrome
                                <a href="https://www.google.com/chrome/?brand=CHBD&gclid=CjwKCAjw7fuJBhBdEiwA2lLMYXmsMZsuOvkh0CG2ld2zkAV2WnWiVakTdwrk5F-g2BPEY1yQjqNLGhoCqsoQAvD_BwE&gclsrc=aw.ds">
                                    click disini untuk download chrome
                                </a> atau download pada playstore/appstore
                            </div>
                        </div>
                    <?php endif; ?> 
                    <a  href="<?php echo e(url('scannermanifest/'.Crypt::encrypt('delivering').'')); ?>"  class="btn btn-primary btn-lg btn-block"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Scan Loading ke truck</a> 
                    <a  href="<?php echo e(url('scannermanifest/'.Crypt::encrypt('arrived').'')); ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-check-square" aria-hidden="true"></i> &nbsp;Scan tiba di agen</a> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalreport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Halaman Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                    <a  href="<?php echo e(url('report/awb')); ?>"  class="btn btn-primary btn-lg btn-block"><i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Halaman Report AWB</a> 
                    <a  href="<?php echo e(url('report/manifest')); ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp;Halaman Report Manifest</a> 
                    <a  href="<?php echo e(url('report/invoice')); ?>" class="btn btn-primary btn-lg btn-block"><i class="fa fa-usd" aria-hidden="true"></i> &nbsp;Halaman Report Invoice</a> 
                    <a  href="<?php echo e(url('report/bonus')); ?>" class="btn btn-primary btn-lg btn-block"><i class="fas fa-gifts" aria-hidden="true"></i> &nbsp;Halaman Report Bonus</a> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/pages/home/agen.blade.php ENDPATH**/ ?>