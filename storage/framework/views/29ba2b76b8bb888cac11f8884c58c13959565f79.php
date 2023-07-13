<?php
    use Modules\ForTheBuilder\Entities\Constants;
?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.clients.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt="">
                    </a>
                    <h2 class="panelUprText"><?php echo e(translate('update')); ?></h2>
                </div>
            </div>

            <div class="sozdatJkData">
                <form action="<?php echo e(route('forthebuilder.clients.update', $model->id)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="client_id" class="booking-client_id" id="">
                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('First name')); ?></h3>
                        <input
                                class="sozdatImyaSpisokInput keyUpName booking-first_name <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="text" name="first_name" id="first_name" autocomplete="off"
                                value="<?php echo e($model->first_name, old('first_name')); ?>">
                        <div class="keyUpNameResult d-none"
                             style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                        </div>
                        <span class="error-data">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Last name')); ?></h3>
                        <input
                                class="sozdatImyaSpisokInput keyUpName booking-last_name <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="text" name="last_name" id="last_name" autocomplete="off"
                                value="<?php echo e($model->last_name,old('last_name')); ?>">
                        <div class="keyUpNameResult d-none"
                             style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                        </div>
                        <span class="error-data">
                            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Middle name')); ?></h3>
                        <input
                                class="sozdatImyaSpisokInput keyUpName booking-middle_name <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                type="text" name="middle_name" id="middle_name" autocomplete="off"
                                value="<?php echo e($model->middle_name,old('middle_name')); ?>">
                        <div class="keyUpNameResult d-none"
                             style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                        </div>
                        <span class="error-data">
                            <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Phone number')); ?></h3>
                        <div class="d-flex">
                            <div>
                                <img src="<?php echo e(asset('backend-assets/forthebuilders/images/region.png')); ?>" alt="Region">
                            </div>
                            <div>
                                <label
                                        style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                        for="+998">+998</label>
                                <input
                                        class="sozdatImyaSpisokInputTel keyUpName booking-phone <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="tel" id="phone" name="phone" 
                                        value="<?php echo e($model->phone,old('phone')); ?>">
                                <div class="keyUpNameResult d-none"
                                     style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Additional phone number')); ?></h3>
                        <div class="d-flex">
                            <div>
                                <img src="<?php echo e(asset('backend-assets/forthebuilders/images/region.png')); ?>" alt="Region">
                            </div>
                            <div>
                                <label
                                        style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                        for="+998">+998</label>
                                <input
                                        class="sozdatImyaSpisokInputTel keyUpName booking-additional_phone <?php $__errorArgs = ['additional_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="tel" id="additional_phone" name="additional_phone" 
                                        value="<?php echo e($model->additional_phone,old('additional_phone')); ?>">
                                <div class="keyUpNameResult d-none"
                                     style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    <?php $__errorArgs = ['additional_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <?php echo e($message); ?>

                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('email')); ?></h3>
                        <input class="sozdatImyaSpisokInput <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               type="email" name="email" id="email" value="<?php echo e($model->email,old('email')); ?>">
                        <span class="error-data">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>

                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Source')); ?></h3>
                        <input class="sozdatImyaSpisokInput <?php $__errorArgs = ['source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               type="text" name="source" id="source" value="<?php echo e($model->source,old('source')); ?>">
                        <span class="error-data">
                            <?php $__errorArgs = ['source'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('status')); ?></h3>
                        <select
                                class="form-control sozdatImyaSpisokSelectOption <?php $__errorArgs = ['lead_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="exampleFormControlSelect1" name="lead_status" data-placeholder="<?php echo e(translate('select')); ?>">
                            <option value="<?php echo e(Constants::FIRST_CONTACT); ?>"><?php echo e(translate('First contact')); ?></option>
                            <option value="<?php echo e(Constants::NEGOTIATION); ?>"><?php echo e(translate('Negotiation')); ?></option>
                        </select>
                        <span class="error-data">
                            <?php $__errorArgs = ['lead_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>

                    <button type="submit" class="sozdatImyaSpisokSozdatButton btn"><?php echo e(translate('update')); ?></button>
                    
                </form>
            </div>

        </div>
    </div>
    <script src="<?php echo e(asset('/backend-assets/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/bootstrap-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/jquery.maskedinput.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/toastr/toastr.min.js')); ?>"></script>

    <script>
        let page_name = 'clients';
        $(document).ready(function() {
            $('#sent').datetimepicker({
                format: 'Y-M-D',
            });
            $('input[type=tel]').mask("(99) 999-99-99");

            let sessionWarning = "<?php echo e(session('warning')); ?>";
            if (sessionWarning) {
                toastr.warning(sessionWarning)
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/clients/edit.blade.php ENDPATH**/ ?>