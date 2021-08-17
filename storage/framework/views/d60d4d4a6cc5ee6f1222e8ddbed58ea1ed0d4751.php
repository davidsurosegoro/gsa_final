<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GSAss</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/login/css/bootstrap.min.css')); ?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/login/css/fontawesome-all.min.css')); ?>">
    <!-- Vegas CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/login/css/vegas.min.css')); ?>">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/login/font/flaticon.css')); ?>">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/login/style.css')); ?>">
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section class="fxt-template-animation fxt-template-layout29">
        <div class="container-fluid">
            <div class="row">
                <div class="vegas-container col-md-6 col-12 fxt-bg-img" id="vegas-slide" data-vegas-options='{"delay":5000, "timer":false,"animation":"kenburns", "transition":"swirlLeft", "slides":[{"src": "<?php echo e(asset('assets/login/img/figure/bg-tugu.jpg')); ?>"},{"src": "<?php echo e(asset('assets/login/img/figure/bg-tp.jpg')); ?>"},{"src": "<?php echo e(asset('assets/login/img/figure/bg-2020.jpg')); ?>"}, {"src": "<?php echo e(asset('assets/login/img/figure/bg-2020-.jpg')); ?>"}, {"src": "<?php echo e(asset('assets/login/img/figure/bg-fix.jpg')); ?>"},{"src": "<?php echo e(asset('assets/login/img/figure/bg-mayjend.jpg')); ?>"},{"src": "<?php echo e(asset('assets/login/img/figure/bg-cito.jpg')); ?>"}]}'>
                    <div class="fxt-page-switcher">
                        <a href="login-29.html" class="switcher-text1 active">Login</a>
                    </div>
                </div>
                <div class="col-md-6 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header">
                            
                        </div>
                        <div class="fxt-form">
                            <div class="fxt-transformY-50 fxt-transition-delay-1">
                                <h2>Selamat Datang. </h2>
                            </div>
                            <div class="fxt-transformY-50 fxt-transition-delay-2">
                                <p>GSA</p>
                            </div>
                            <form method="POST" action="<?php echo e(url('login')); ?>" >
                                    <?php echo e(csrf_field()); ?>

                                                <?php if(count($errors) > 0): ?>

                                                    <div class="alert alert-danger alert-dismissable">
                                                        <i class="zmdi zmdi-block pr-15 pull-left"></i><p class="pull-left"> <strong> X </strong> Login Gagal! Password atau username salah.</p>
                                                    </div>
                                                <?php endif; ?>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                                        <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                                        <i class="flaticon-user"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-5">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                                        <i class="flaticon-padlock"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-6">
                                        <div class="fxt-content-between">
                                            <button type="submit" class="fxt-btn-fill">Log in</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    <script src="<?php echo e(asset('assets/login/js/jquery-3.5.0.min.js')); ?>"></script>
    <!-- Popper js -->
    <script src="<?php echo e(asset('assets/login/js/popper.min.js')); ?>"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo e(asset('assets/login/js/bootstrap.min.js')); ?>"></script>
    <!-- Imagesloaded js -->
    <script src="<?php echo e(asset('assets/login/js/imagesloaded.pkgd.min.js')); ?>"></script>
    <!-- Vegas js -->
    <script src="<?php echo e(asset('assets/login/js/vegas.min.js')); ?>"></script>
    <!-- Validator js -->
    <script src="<?php echo e(asset('assets/login/js/validator.min.js')); ?>"></script>
    <!-- Custom Js -->
    <script src="<?php echo e(asset('assets/login/js/main.js')); ?>"></script>

</body>

</html><?php /**PATH C:\xampp\htdocs\GSA\awb\resources\views/auth/login.blade.php ENDPATH**/ ?>