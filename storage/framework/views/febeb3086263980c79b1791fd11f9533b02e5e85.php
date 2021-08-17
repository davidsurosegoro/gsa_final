<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-lg-4 col-xl-4 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="<?php echo e(url('peta-dinas')); ?>">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-map-location text-info"> </i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="<?php echo e(url('peta-dinas')); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">List Peta Dinas</a>
                                            </div>
                                        </div>
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    <div class="col-lg-4 col-xl-4 mb-5">
                                        <!--begin::Iconbox-->
                                        <div class="card card-custom wave wave-animate-fast wave-primary">
                                            <div class="card-body text-center">
                                                <a href="<?php echo e(url('analisa')); ?>">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-analytics text-info"> </i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="<?php echo e(url('analisa')); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Analisa Peta</a>
                                            </div>
                                        </div>
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    <?php if(Auth::user()->user_level !== 1): ?>
                                    <div class="col-lg-4 col-xl-4 mb-5">
                                        <div class="card card-custom wave wave-animate-slow wave-primary">
                                            <div class="card-body text-center">
                                                <a href="<?php echo e(url('master')); ?>">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-settings text-info"> </i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="<?php echo e(url('master')); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Kelola Peta</a>
                                            </div>
                                        </div>
                                        <!--begin::Iconbox-->
                                        
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-lg-4 col-xl-4 mb-5">
                                        <div class="card card-custom wave wave-animate-slow wave-primary">
                                            <div class="card-body text-center">
                                                <a href="<?php echo e(url('simbada')); ?>">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-placeholder text-info"> </i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="<?php echo e(url('simbada')); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Input Aset Simbada</a>
                                            </div>
                                        </div>
                                        <!--begin::Iconbox-->
                                        
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    <?php if(Auth::user()->user_level !== 1 && Auth::user()->user_level !== 7): ?>
                                    <?php if(in_array($pd->skpd_nama, $kecamatan)): ?>
                                    <div class="col-lg-4 col-xl-4 mb-5">
                                        <div class="card card-custom wave wave-animate-slow wave-primary">
                                            <div class="card-body text-center">
                                                <a href="<?php echo e(url('paparan/aset-kecamatan')); ?>">
                                                        <span class="svg-icon svg-icon-primary svg-icon-6x">
                                                           <i class="icon-6x flaticon-placeholder-1 text-info"> </i>
                                                        </span>
                                                        </a>
                                                        <br>
                                                        <a href="<?php echo e(url('paparan/aset-kecamatan')); ?>" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">Aset Wilayah Per Kecamatan</a>
                                            </div>
                                        </div>
                                        <!--begin::Iconbox-->
                                        
                                        <!--end::Iconbox-->
                                        <!--begin::Code example-->
                                        <!--end::Code example-->
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/home.blade.php ENDPATH**/ ?>