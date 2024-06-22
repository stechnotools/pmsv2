<?php

    if (isset($currentWorkspace)) {
        $setting = App\Models\Utility::getcompanySettings($currentWorkspace->id);
        $SITE_RTL = $setting->site_rtl;
        if ($setting->theme_color) {
            $color = $setting->theme_color;
        } else {
            $color = 'theme-3';
        }
    } else {
        $setting = App\Models\Utility::getAdminPaymentSettings();
        // $SITE_RTL = env('SITE_RTL');
        $SITE_RTL = $setting['site_rtl'];
        if ($setting['color']) {
            $color = $setting['color'];
        } else {
            $color = 'theme-3';
        }
    }

    if (\App::getLocale() == 'ar' || \App::getLocale() == 'he') {
        $SITE_RTL = 'on';
    }

    $meta_setting = App\Models\Utility::getAdminPaymentSettings();
    $meta_images = \App\Models\Utility::get_file('uploads/logo/');
    $logo = \App\Models\Utility::get_file('logo/');
    use App\Models\Utility;
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta name="title" content="<?php echo e($meta_setting['meta_keywords']); ?>">
    <meta name="description" content="<?php echo e($meta_setting['meta_description']); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content= "<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($meta_setting['meta_keywords']); ?>">
    <meta property="og:description" content="<?php echo e($meta_setting['meta_description']); ?>">
    <meta property="og:image" content="<?php echo e(asset($meta_images . $meta_setting['meta_image'])); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($meta_setting['meta_keywords']); ?>">
    <meta property="twitter:description" content="<?php echo e($meta_setting['meta_description']); ?>">
    <meta property="twitter:image" content="<?php echo e(asset($meta_images . $meta_setting['meta_image'])); ?>">

    <title>
        <?php echo e(config('app.name', 'PMS')); ?> - <?php echo $__env->yieldContent('page-title'); ?>
    </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e($logo . 'favicon.png' . '?' . time()); ?>">


    <!--  <link rel="icon" href="<?php echo e(asset('assets/images/favicon.svg')); ?>" type="image/x-icon" /> -->

    

    <?php if($setting['cust_darklayout'] == 'on'): ?>
        <?php if(isset($SITE_RTL) && $SITE_RTL == 'on'): ?>
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>" id="main-style-link">
        <?php endif; ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <?php if(isset($SITE_RTL) && $SITE_RTL == 'on'): ?>
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>" id="main-style-link">
        <?php else: ?>
            <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
        <?php endif; ?>
    <?php endif; ?>

    <?php if(isset($SITE_RTL) && $SITE_RTL == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-auth-rtl.css')); ?>" id="main-style-link">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-auth.css')); ?>" id="main-style-link">
    <?php endif; ?>
    <?php if($setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-dark.css')); ?>" id="main-style-link">
    <?php endif; ?>
</head>


<body class="<?php echo e($color); ?>">
    <?php
    $dir = base_path() . '/resources/lang/';
    $glob = glob($dir . '*', GLOB_ONLYDIR);
    $arrLang = array_map(function ($value) use ($dir) {
        return str_replace($dir, '', $value);
    }, $glob);
    $arrLang = array_map(function ($value) use ($dir) {
        return preg_replace('/[0-9]+/', '', $value);
    }, $arrLang);
    $arrLang = array_filter($arrLang);
    $currantLang = basename(App::getLocale());
    $client_keyword = Request::route()->getName() == 'client.login' ? 'client.' : '';
    ?>

    <script src="<?php echo e(asset('assets/js/vendor-all.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>

    <script>
        feather.replace();
    </script>
    <script>
        feather.replace();
        // var pctoggle = document.querySelector("#pct-toggler");
        // if (pctoggle) {
        //     pctoggle.addEventListener("click", function() {
        //         if (
        //             !document.querySelector(".pct-customizer").classList.contains("active")
        //         ) {
        //             document.querySelector(".pct-customizer").classList.add("active");
        //         } else {
        //             document.querySelector(".pct-customizer").classList.remove("active");
        //         }
        //     });
        // }

        var themescolors = document.querySelectorAll(".themes-color > a");
        for (var h = 0; h < themescolors.length; h++) {
            var c = themescolors[h];

            c.addEventListener("click", function(event) {
                var targetElement = event.target;
                if (targetElement.tagName == "SPAN") {
                    targetElement = targetElement.parentNode;
                }
                var temp = targetElement.getAttribute("data-value");
                removeClassByPrefix(document.querySelector("body"), "theme-");
                document.querySelector("body").classList.add(temp);
            });
        }
        var custthemebg = document.querySelector("#cust-theme-bg");
        custthemebg.addEventListener("click", function() {
            if (custthemebg.checked) {
                document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.add("transprent-bg");
            } else {
                document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                document
                    .querySelector(".dash-header:not(.dash-mob-header)")
                    .classList.remove("transprent-bg");
            }
        });

        var custdarklayout = document.querySelector("#cust-darklayout");
        custdarklayout.addEventListener("click", function() {
            if (custdarklayout.checked) {
                document
                    .querySelector(".m-header > .b-brand > .logo-lg")
                    .setAttribute("src", "../assets/images/logo.svg");
                document
                    .querySelector("#main-style-link")
                    .setAttribute("href", "../assets/css/style-dark.css");
            } else {
                document
                    .querySelector(".m-header > .b-brand > .logo-lg")
                    .setAttribute("src", "../assets/images/logo-dark.svg");
                document
                    .querySelector("#main-style-link")
                    .setAttribute("href", "../assets/css/style.css");
            }
        });

        function removeClassByPrefix(node, prefix) {
            for (let i = 0; i < node.classList.length; i++) {
                let value = node.classList[i];
                if (value.startsWith(prefix)) {
                    node.classList.remove(value);
                }
            }
        }
    </script>
    <?php echo $__env->yieldPushContent('custom-scripts'); ?>
    <!-- [ auth-signup ] start -->

    <?php
        $company_logo = App\Models\Utility::get_logo();
    ?>
    <div class="custom-login">
        
        <div class="custom-login-inner">
            

            <main class="custom-wrapper">
                <div class="custom-row">

                    <div class="card">
                        <a class="text-center my-sm-4" href="#">
                            <img src="<?php echo e(asset($logo . $company_logo)); ?>" class="" style="width:200px;" alt="logo">
                        </a>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
            </main>

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <?php if(session()->has('info')): ?>
                        <div class="alert alert-primary">
                            <?php echo e(session()->get('info')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session()->has('status')): ?>
                        <div class="alert alert-info">
                            <?php echo e(session()->get('status')); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <footer>
                <div class="auth-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                
                                <span>
                                    &copy; <?php echo e(date('Y')); ?>

                                    <?php echo e(Utility::getValByName('footer_text') ? Utility::getValByName('footer_text') : config('app.name', 'PMS')); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            

        </div>
        
    </div>
    </div>
    <!-- [ auth-signup ] end -->

    <!-- Required Js -->

    
    <?php if($meta_setting['enable_cookie'] == 'on'): ?>
        <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</body>

</html>
<?php /**PATH D:\laragon\www\taskly\resources\views/layouts/guest.blade.php ENDPATH**/ ?>