

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <?php $__currentLoopData = $page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $item; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="modal fade" id="modalscanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Scan AWB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php if(!Browser::isChrome()): ?>
                        <div class="alert alert-alert row" style="
                            color: #856404;
                            background-color: #fff3cd;
                            border-color: #ffeeba;
                            height: 100px;">
                            <img src="<?php echo e(asset('assets/gsa/img/chrome.png')); ?>" class="col-2"
                                style="object-fit: contain;">
                            <div class="col-10">
                                Untuk kelancaran scan QR, Gunakan browser google chrome
                                <a
                                    href="https://www.google.com/chrome/?brand=CHBD&gclid=CjwKCAjw7fuJBhBdEiwA2lLMYXmsMZsuOvkh0CG2ld2zkAV2WnWiVakTdwrk5F-g2BPEY1yQjqNLGhoCqsoQAvD_BwE&gclsrc=aw.ds">
                                    click disini untuk download chrome
                                </a> atau download pada playstore/appstore
                            </div>
                        </div>
                    <?php endif; ?>
 
                    <?php $__currentLoopData = $modalawb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $item; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalscannermanifest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Scan Manifest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php if(!Browser::isChrome()): ?>
                        <div class="alert alert-alert row" style="
                            color: #856404;
                            background-color: #fff3cd;
                            border-color: #ffeeba;
                            height: 100px;">
                            <img src="<?php echo e(asset('assets/gsa/img/chrome.png')); ?>" class="col-2"
                                style="object-fit: contain;">
                            <div class="col-10">
                                Untuk kelancaran scan QR, Gunakan browser google chrome
                                <a
                                    href="https://www.google.com/chrome/?brand=CHBD&gclid=CjwKCAjw7fuJBhBdEiwA2lLMYXmsMZsuOvkh0CG2ld2zkAV2WnWiVakTdwrk5F-g2BPEY1yQjqNLGhoCqsoQAvD_BwE&gclsrc=aw.ds">
                                    click disini untuk download chrome
                                </a> atau download pada playstore/appstore
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $modalmanifest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $item; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalreport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Halaman Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $__currentLoopData = $modalreport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $item; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GSA\gsa_final\resources\views/home.blade.php ENDPATH**/ ?>