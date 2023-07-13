<?php $__env->startSection('title'); ?>
    <?php echo e(translate('User edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/select/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/select2-bootstrap4-theme/css/select2-bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <form action="<?php echo e(route('forthebuilder.user.update',$model->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name"><?php echo e(translate('Firstname')); ?></label>
                            <input type="text" name="first_name" id="first_name" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($model->first_name, old('first_name')); ?>" required>
                            <span class="error-data"><?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="last_name"><?php echo e(translate('Lastname')); ?></label>
                            <input type="text" name="last_name" id="last_name" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($model->last_name, old('last_name')); ?>" required>
                            <span class="error-data"><?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="last_name"><?php echo e(translate('Middlename')); ?></label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($model->middle_name, old('middle_name')); ?>">
                            <span class="error-data"><?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo e(translate('Email')); ?></label>
                            <input type="email" name="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($model->email, old('email')); ?>" required>
                            <span class="error-data"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <label for="birth_date"><?php echo e(translate('Birth date')); ?></label> <br>
                                <input name="birth_date" id="birth_date"
                                       class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e($model->birth_date, old('birth_date')); ?>" type="date">
                            </div>
                            <div class="form-group">
                                <label for="phone_number"><?php echo e(translate('Phone number')); ?></label> <br>
                                <label id="phone_number" style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                       for="+998">+998</label>
                                <input name="phone_number" style="padding-left: 54px" maxlength="9"
                                       class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e($model->phone_number, old('phone_number')); ?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role_id"><?php echo e(translate('Role')); ?></label>
                            <select name="role_id" id="role_id"  data-placeholder="<?php echo e(__('locale.role')); ?>" class="form-control select2 <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php echo e($model->role_id == $role->id ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="error-data"><?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>

                        <div class="form-group">
                            <label for="status"><?php echo e(translate('status')); ?></label>
                            <select name="status" id="status"  data-placeholder="<?php echo e(__('locale.select')); ?>" class="form-control select2 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
                                <option value="2" <?php echo e($model->status == 2 ? 'selected' : ''); ?>><?php echo e(__('locale.active')); ?></option>
                                <option value="0" <?php echo e($model->status == 0 ? 'selected' : ''); ?>><?php echo e(__('locale.no_active')); ?></option>
                            </select>
                            <span class="error-data"><?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>

                        <div class="form-group">
                            <label for="current_password"><?php echo e(translate('Current password')); ?></label>
                            <input type="password" name="current_password" id="current_password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('current_password')); ?>" >
                            <span class="error-data"><?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password"><?php echo e(translate('Password')); ?></label>
                            <input type="password" name="password" id="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('password')); ?>" >
                            <span class="error-data"><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"><?php echo e(translate('Password confirmation')); ?></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('password_confirmation')); ?>" >
                            <span class="error-data"><?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
                        </div>

                        <div class="form-group ">
                            <label for="images"><?php echo e(translate('Image')); ?></label>
                            <style>
                                img{
                                    width: 200px;
                                    height: 200px;
                                    margin-bottom: 10px;
                                }
                            </style>
                            <div id="preView">
                                <img src="<?php echo e(asset('/uploads/user/'.$model->id.'/s_'.$model->avatar)); ?>" alt="" id="oldImage">
                            </div>
                            <div class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input" id="uavatar">
                                <label class="custom-file-label" for="avatar"><?php echo e(translate('Image')); ?></label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            
            
            
            
            
            

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer justify-content-end" style="">
                    <button type="submit" class="btn btn-success"><?php echo e(translate('Update')); ?></button>
                </div>
            </div>
        </div>

    </form>
        </div>
    </div>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/select/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/moment/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/inputmask/jquery.inputmask.min.js')); ?>"></script>
    <script>
        let page_name = 'user';
        $(document).ready(function () {
            // $('#year_constructionId').datetimepicker({
            //     format: 'Y-M-D',
            // });
            $("#year_constructioninputid").inputmask("9999-99-99",{ "placeholder": "yyyy-mm-dd" });
            //
            // avatar.onchange = evt => {
            //
            //     const [file] = avatar.files
            //     $("#preViewImg").remove();
            //     $("#oldImage").remove();
            //     if (file){
            //         const preViewDiv = $('#preView');
            //         preViewDiv.append(`<img src='${URL.createObjectURL(file)}' id='preViewImg'>`)
            //     }
            //
            // }


            $('#uavatar').on('change',function (){
                // const [file] = uavatar.files
                let file = $("input[type=file]").get(0).files[0];
                $("#preViewImg").remove();
                $("#oldImage").remove();
                if (file){
                    const preViewDiv = $('#preView');
                    preViewDiv.append(`<img src='${URL.createObjectURL(file)}' id='preViewImg'>`)
                }

            });

        });


    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/user/edit.blade.php ENDPATH**/ ?>