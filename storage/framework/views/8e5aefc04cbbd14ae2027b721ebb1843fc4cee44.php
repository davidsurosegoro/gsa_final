<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    <head><base href="">
        <meta charset="utf-8" />
        <title>SIGIS</title>
        <meta name="description" content="Updates and statistics" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="canonical" href="https://keenthemes.com/metronic" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Vendors Styles(used by this page)-->
        <link href="<?php echo e(asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugins/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="<?php echo e(asset('assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/ol/ol.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/css/analisa.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/plugins/colorpicker/css/bootstrap-colorpicker.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <!--end::Layout Themes-->
        
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(asset('assets/img/favicon/apple-icon-57x57.png')); ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('assets/img/favicon/apple-icon-60x60.png')); ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('assets/img/favicon/apple-icon-72x72.png')); ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('assets/img/favicon/apple-icon-76x76.png')); ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('assets/img/favicon/apple-icon-114x114.png')); ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('assets/img/favicon/apple-icon-120x120.png')); ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(asset('assets/img/favicon/apple-icon-144x144.png')); ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('assets/img/favicon/apple-icon-152x152.png')); ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/img/favicon/apple-icon-180x180.png')); ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo e(asset('assets/img/favicon/android-icon-192x192.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon/favicon-32x32.png')); ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('assets/img/favicon/favicon-96x96.png')); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon/favicon-16x16.png')); ?>">
        <style type="text/css">
            .exs{
              background-image: url("data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' stroke='%23505050D1' stroke-width='4' stroke-dasharray='14%2c 23%2c 16' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e");
            }


          .search-custom{
            display: block;
            width: 35%;
            padding-left: 0.65rem ;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #3F4254;
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #E4E6EF;
            border-radius: 0.42rem;
            margin-left: 5px;
          }

        </style>
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
        <!--begin::Main-->
        <!--begin::Header Mobile-->
        <div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
            <!--begin::Logo-->
            <a href="<?php echo e(url('/')); ?>">
                <img alt="Logo" src="<?php echo e(asset('assets/img/sigis.png')); ?>" class="max-h-40px" />
            </a>
            <!--end::Logo-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_topbar_toggle">
                    <span></span>
                </button>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <!--begin::Header-->
                    <div id="kt_header" class="header flex-column header-fixed">
                        <!--begin::Top-->
                        <div class="header-top" style="background-color: white; height: 52px;">
                            <!--begin::Container-->
                            <div class="container-fluid">
                                <!--begin::Left-->
                                <div class="d-none d-lg-flex align-items-center mr-2">
                                    <!--begin::Logo-->
                                    <a href="<?php echo e(url('/')); ?>" class="mr-20">
                                        <img alt="Logo" src="<?php echo e(asset('assets/img/sigis.png')); ?>" class="max-h-50px" />
                                    </a>
                                    <div class="quick-search quick-search-inline ml-4 w-700px" id="kt_quick_search_inline">
                                        <!--begin::Form-->
                                        <form method="get" class="quick-search-form">
                                            <div class="input-group rounded" >
                                                <div class="input-group-prepend search-brand">
                                                    <span class="input-group-text" id="btn-change-lat-long" style="cursor: pointer;">
                                                        <span class="svg-icon svg-icon-lg">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                            <i class="flaticon-search-magnifier-interface-symbol"></i>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" style="color:#a7a6a6" class="inputsearch search-custom h-45px" placeholder="Cari Jalan...">
                                                <input type="text" style="color:#a7a6a6" name="long_search" class="search-coord search-custom h-45px" placeholder="Longitude...">
                                                <input type="text" style="color:#a7a6a6" name="lat_search" class="search-coord search-custom h-45px" placeholder="Langitude...">
                                                <button type="button" class="btn btn-sm btn-primary" id="btn-cari-long-lat">Cari </button>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="quick-search-close ki ki-close icon-sm"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                        <!--end::Form-->
                                        <!--begin::Search Toggle-->
                                        <!--end::Search Toggle-->
                                        <!--begin::Dropdown-->
                                        <!--end::Dropdown-->
                                    </div>
                                </div>
                                <!--end::Left-->
                                <!--begin::Topbar-->
                                <div class="topbar">
                                    <!--begin::My Cart-->
                                    <div class="dropdown">
                                        <!--begin::Toggle-->
                                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                            <div class="btn btn-icon btn-outline-success btn-sm mr-2">
                                                <span class="svg-icon svg-icon-xl"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Communication\Address-card.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
    </g>
</svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Toggle-->
                                        <!--begin::Dropdown-->
                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-xl dropdown-menu-anim-up">
                                                <!--begin::Header-->
                                                <div class="d-flex align-items-center py-10 px-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(assets/media/misc/bg-1.jpg)">
                                                    <span class="btn btn-md btn-icon bg-white-o-15 mr-4">
                                                        <i class="flaticon-user text-success"></i>
                                                    </span>
                                                    
                                                    <h4 class="text-white m-0 flex-grow-1 mr-3">Hi, <?php echo e(Auth::user()->username); ?></h4>
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Scroll-->
                                                <div class="scroll scroll-push" data-scroll="true" data-height="250" data-mobile-height="200">
                                                   
                                                   <div class="p-8">
                                                    <div class="d-flex align-items-center justify-content-between mb-7">
                                                        <a href="<?php echo e(url('/log')); ?>" class="text-right"> Logs Aktivitas</a>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between mb-7">
                                                        <a href="<?php echo e(url('/logout')); ?>" class="text-right" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();" >
                                                               <i class="icon-logout"> </i>Logout
                                                            </a>
                                                        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                                            <?php echo e(csrf_field()); ?>

                                                        </form>
                                                    </div>
                                                </div>
                                                    </div>
                                                    <!--end::Item-->
                                                <!--end::Scroll-->
                                                <!--begin::Summary-->
                                                <!--end::Summary-->
                                            
                                        </div>
                                        <!--end::Dropdown-->
                                    </div>

                                    <!--end::User-->
                                </div>
                                <!--end::Topbar-->
                            </div>
                            <!--end::Container-->
                        </div>
                    </div>
                                <?php echo $__env->yieldContent('content'); ?>
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
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <!--end::Global Config-->
        <!--begin::Global Theme Bundle(used by all pages)-->
        <script src="<?php echo e(asset('assets/plugins/global/plugins.bundle.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/plugins/custom/prismjs/prismjs.bundle.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/scripts.bundle.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/plugins/custom/datatables/datatables.bundle.js')); ?>"></script>
        <!--end::Global Theme Bundle-->
        <!--begin::Page Vendors(used by this page)-->
        <script src="<?php echo e(asset('assets/js/pages/features/miscellaneous/sweetalert2.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/pages/features/miscellaneous/toastr.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/plugins/forms/submit/jquery.form.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/plugins/colorpicker/js/bootstrap-colorpicker.js')); ?>"></script>
        <!--end::Page Vendors-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="<?php echo e(asset('assets/js/pages/widgets.js')); ?>"></script>
        <script type="text/javascript">
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "3000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            $('.select2').select2({
        });
            var base_url = '<?php echo e(env('APP_URL').'/'); ?>';
        </script>
        <script>
            // $('#kt_quick_panel').hide()
        var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
        <script src="<?php echo e(asset('assets/ol/ol.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/indra_init.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/map/add_layer.js')); ?>"></script>
        <script type="text/javascript" src="//www.bing.com/api/maps/mapcontrol?key=AsOA1-Hwvc9YWsOAzbotwZUgT2niRNdkyo6KqELtZhHBLxrbEX70YLR3nXtpNrlA&amp;callback=loadMapScenario" async="" defer=""></script>
        
        <?php echo $__env->yieldContent('script'); ?>
        <!--end::Page Scripts-->
    </body>
    <!--end::Body-->
</html><?php /**PATH C:\xampp\htdocs\sigis_next\resources\views/layouts/paparan/app.blade.php ENDPATH**/ ?>