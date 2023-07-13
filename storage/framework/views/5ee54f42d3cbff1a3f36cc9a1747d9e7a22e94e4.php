

<?php $__env->startSection('title'); ?>
    <?php echo e(translate('User create')); ?>

<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet"
    href="<?php echo e(asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/plugins/toastr/toastr.min.css')); ?>">
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.user.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>"
                            alt=""></a>
                    <h2 class="panelUprText"><?php echo e(translate('Create a new user')); ?></h2>
                </div>
            </div>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="sozdatPolzavatelData">
                <form action="<?php echo e(route('forthebuilder.user.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo method_field('POST'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Firstname')); ?></h3>
                        <input name="first_name"
                            class="sozdatImyaSpisokInput <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            type="text" value="<?php echo e(old('first_name')); ?>" required>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Lastname')); ?></h3>
                        <input name="last_name"
                            class="sozdatImyaSpisokInput <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('last_name')); ?>" required type="text">
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Middlename')); ?></h3>
                        <input name="middle_name"
                            class="sozdatImyaSpisokInput <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('middle_name')); ?>" type="text">
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Email')); ?></h3>
                        <input name="email"
                            class="sozdatImyaSpisokInput <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('email')); ?>" required type="email">
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"> <?php echo e(translate('Role')); ?></h3>
                                <select required name="role_id" id="role_id" data-placeholder="<?php echo e(__('locale.role')); ?>"
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">---------------------</option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            
                            
                            
                            
                        </div>

                        <div>
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"> <?php echo e(translate('Password')); ?></h3>
                                <input class="sozdatImyaSpisokInput1272" type="password" name="password">
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"> <?php echo e(translate('Password confirmation')); ?></h3>
                                <input class="sozdatImyaSpisokInput1272" type="password" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <label class="login_file">
                                <input class="login_file" name="avatar" type="file" style="display: none;">
                                <div class="d-flex">
                                    <a class="dobavitFotoPolzovatel">+</a>
                                    <h5 class="dobavitFotoTextPolzovatel"><?php echo e(translate('Add photo')); ?></h5>
                                </div>
                            </label>
                        </div>

                        <button class="polzovatelSoxranitSozdat">
                            <?php echo e(translate('Save')); ?>

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'user';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/user/create.blade.php ENDPATH**/ ?>