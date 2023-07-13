
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title><?php echo e(__('locale.login')); ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/plugins/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/css/login.css')); ?>">
    
    <style>
        .mathcaptcha-label-input{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .mathcaptcha-label{
            font-size: 18px;
            margin: 0;
        }
        .mathcaptcha-input{
            width: 60%;

        }
        .reload{
            background: transparent;
            border: 0;
            /* background-color: none; */
            box-shadow: none;
        }
        .error-data{
            color: #dc3545;
        }
        .color{
           color: #F9FBFF !important;
        }
    </style>
</head>





<body>
    <div class="login_father">
        <div class="login_box">
            <form method="POST" class="mt-2" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                
                

                <input id="email" type="email" placeholder="<?php echo e(__('locale.email')); ?>" class="form-control login_mail <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                <input id="password" type="password"  placeholder="<?php echo e(__('locale.password')); ?>" class="form-control login_mail <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">



                <div class="form-group mathcaptcha-label-input ">
                    <button type="button"  class="reload  p-0 " id="reload">&#x21bb;</button>
                    <label for="mathgroup" class="mathcaptcha-label mx-3"> <?php echo e(app('mathcaptcha')->label()); ?></label> =
                    <?php echo app('mathcaptcha')->input(['class' => 'form-control mathcaptcha-input ', 'id' => 'mathgroup','placeholder'=>'Ваш ответ']); ?>

                </div>
                <div class="mb-2">
                    <?php if($errors->has('mathcaptcha')): ?>
                        <span class="error-data" id="has-error-message">
                            <strong><?php echo e(translate('Verification code is invalid')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="icheck-primary mt-3 text-center color  ">
                    <input class="color" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="remember">
                        
                        <?php echo e(translate('Remember me')); ?>

                    </label>
                </div>
                <div class="voytiDiv ">
                    <button><?php echo e(translate('login')); ?></button>
                </div>
            </form>
            <p class="text-center  mt-2">
                <a class="color" href="<?php echo e(route('password.request')); ?>"><?php echo e(translate('Forgot password')); ?></a>
            </p>
        </div>
    </div>




    <script src="<?php echo e(asset('/backend-assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/js/adminlte.js')); ?>"></script>
    <script>
        $('#reload').click(function () {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'GET',
                url: '/reload-captcha',
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    // $(".captcha span").html(data.captcha);
                    $('.mathcaptcha-label').text(data);
                },
                error: function (error) {
                    // console.log(error);
                }
            });
        });
    </script>

</body>
</html>


<?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/resources/views/auth/login.blade.php ENDPATH**/ ?>