<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    <head><base href="">
        <meta charset="utf-8" />
        <title>SIGIS</title>
        <meta name="description" content="Updates and statistics" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Vendors Styles(used by this page)-->
        <!--end::Page Vendors Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css">
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <!--end::Layout Themes-->
        <link rel="shortcut icon" href="<?php echo e(asset('assets/media/logos/favicon.ico')); ?>" />
        <link href="<?php echo e(asset('assets/ol/ol.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/analisa.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugins/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
     <?php echo e(csrf_field()); ?>

        <!--begin::Main-->
        <!--begin::Header Mobile-->
    
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <!--begin::Header-->
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container-fluid">
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    <!--end::Content-->
                    <!--begin::Footer-->
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Main-->
        <!-- begin::User Panel-->
        
        <!-- end::User Panel-->
        <!--begin::Quick Panel-->
        
        <!--end::Quick Panel-->
        <!--begin::Chat Panel-->
        <!--end::Chat Panel-->
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>
        <!--end::Scrolltop-->
        <!--begin::Sticky Toolbar-->
        <!--end::Sticky Toolbar-->
        <!--begin::Demo Panel-->
        <!--end::Demo Panel-->
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };

            var base_url = '<?php echo e(env('APP_URL').'/'); ?>';
        </script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/scripts.bundle.js')); ?>"></script>
        <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
        
        <!--end::Global Theme Bundle-->
        <!--begin::Page Vendors(used by this page)-->
        <script src="<?php echo e(asset('assets/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>
        <!--end::Page Vendors-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="<?php echo e(asset('assets/js/pages/widgets.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/ol/ol.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/indra_init.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/map/add_layer.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/map/draw.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/map/help_tooltip.js')); ?>"></script>
        <script type="text/javascript" src="//www.bing.com/api/maps/mapcontrol?key=AsOA1-Hwvc9YWsOAzbotwZUgT2niRNdkyo6KqELtZhHBLxrbEX70YLR3nXtpNrlA&amp;callback=loadMapScenario" async="" defer=""></script>
        <?php echo $__env->yieldContent('script'); ?>
        <!--end::Page Scripts-->
    </body>
    <!--end::Body-->
</html><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/layouts/popup/app.blade.php ENDPATH**/ ?>