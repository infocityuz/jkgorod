<?php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\Constants;
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('JK')); ?>

<?php $__env->stopSection(); ?>

<style>
    .error-data {
        color: red;
    }
</style>

<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.settings.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt=""></a>
                    <h2 class="panelUprText"><?php echo e(translate('Price formation')); ?></h2>
                </div>
            </div>

            <form id="" action="<?php echo e(route('forthebuilder.house.save-price-information')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="priseObrazavaniyaData">
                    
                    <select class="obrazavaniyaSelect priceInformationSelectHouse" name="house_id"
                        style="opacity: <?php echo e(old('house_id') ? 1 : 0.25); ?>;">
                        <option aria-placeholder="<?php echo e(translate('Select LCD')); ?>" selected hidden disabled>
                            <?php echo e(translate('Select LCD')); ?>

                        </option>
                        <?php if(empty(!$model)): ?>
                            <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $selected = old('house_id') == $value->id ? 'selected' : '';
                                ?>
                                <option value="<?php echo e($value->id); ?>" <?php echo e($selected); ?>>
                                    <?php echo e($value->name . ' (' . $value->corpus . ')'); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="error-data">
                        <?php $__errorArgs = ['house_id'];
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

                    <select class="obrazavaniyaSelect" name="price_type"
                        style="opacity: <?php echo e(old('price_type') ? 1 : 0.25); ?>;">
                        <option aria-placeholder="<?php echo e(translate('Choose an object')); ?>" selected hidden disabled>
                            <?php echo e(translate('Choose an object')); ?>

                        </option>
                        
                        <option value="<?php echo e(Constants::PRICE_M2); ?>"
                            <?php echo e(old('price_type') == Constants::PRICE_M2 ? 'selected' : ''); ?>>
                            <?php echo e(translate('Price per m2')); ?>

                        </option>
                        <option value="<?php echo e(Constants::PRICE_TERRACE); ?>"
                            <?php echo e(old('price_type') == Constants::PRICE_TERRACE ? 'selected' : ''); ?>>
                            <?php echo e(translate('Price per m2 with terrace')); ?>

                        </option>
                        <option value="<?php echo e(Constants::PRICE_ATTIC); ?>"
                            <?php echo e(old('price_type') == Constants::PRICE_ATTIC ? 'selected' : ''); ?>>
                            <?php echo e(translate('Price per m2 in attic')); ?>

                        </option>
                        <option value="<?php echo e(Constants::PRICE_BASEMENT); ?>"
                            <?php echo e(old('price_type') == Constants::PRICE_BASEMENT ? 'selected' : ''); ?>>
                            <?php echo e(translate('Price per m2 on the ground floor')); ?>

                        </option>
                    </select>
                    <span class="error-data">
                        <?php $__errorArgs = ['price_type'];
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

                    <button type="button" class="obrazavaniyaSelect text-left btn priceFormationOpenFlats"
                        data-toggle="modal" data-target="#exampleModalLong"
                        style="opacity: <?php echo e(old('house_flats') ? 1 : 0.25); ?>;"><?php echo e(translate('Choose a flat')); ?></button>
                    <span class="error-data">
                        <?php $__errorArgs = ['house_flats'];
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
                    

                    

                    <div>
                        <div class="d-flex divForSummPrice">
                            <div style="width: 49%;">
                                <select class="obrazavaniyaSelect" name="payment[0][payment_type]"
                                    style="opacity: <?php echo e(old('payment_type') ? 1 : 0.25); ?>;">
                                    <option aria-placeholder="<?php echo e(translate('Payment %')); ?>" selected hidden disabled>
                                        <?php echo e(translate('Payment %')); ?>

                                    </option>
                                    <option value="<?php echo e(Constants::PAYMENT_30); ?>"
                                        <?php echo e(old('payment_type') == Constants::PAYMENT_30 ? 'selected' : ''); ?>>
                                        <?php echo e(translate('at 30% payment')); ?></option>
                                    
                                    <option value="<?php echo e(Constants::PAYMENT_70); ?>"
                                        <?php echo e(old('payment_type') == Constants::PAYMENT_70 ? 'selected' : ''); ?>>
                                        <?php echo e(translate('at 70% payment')); ?>

                                    </option>

                                    <option value="<?php echo e(Constants::PAYMENT_50); ?>"
                                        <?php echo e(old('payment_type') == Constants::PAYMENT_50 ? 'selected' : ''); ?>>
                                        <?php echo e(translate('at 50% payment')); ?></option>
                                    <option value="<?php echo e(Constants::PAYMENT_100); ?>"
                                        <?php echo e(old('payment_type') == Constants::PAYMENT_100 ? 'selected' : ''); ?>>
                                        <?php echo e(translate('at 100% payment')); ?></option>
                                </select>
                                <span class="error-data">
                                    <?php $__errorArgs = ['payment_type'];
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

                            <div style="width: 49%; margin-left: auto">
                                <input type="number" class="obrazavaniyaSelect obrazavaniyaSelectInput"
                                    style="opacity: <?php echo e(old('amount') ? 1 : 0.25); ?>;"
                                    placeholder="<?php echo e(translate('Enter amount')); ?>" name="payment[0][amount]" value="<?php echo e(old('amount')); ?>">
                                <span class="error-data">
                                    <?php $__errorArgs = ['amount'];
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
                    
                    <input type="hidden" id="price_formaition_id" name="house_flats" value="<?php echo e(old('house_flats')); ?>">

                    <button type="submit" class="sozdatImyaSpisokSozdatButton text-light btn float-left"><?php echo e(translate('Save')); ?></button>

                    <div class="float-right" style="width: 5%; margin-top: 20px;">
                        <button class="obrazavaniyaSelect btn btn-success plusForSummPrice" data-count="0" style="padding-left: 14px; background-color: #44BE26; opacity: 0.8; border: none">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    
                    <div class="float-right" style="width: 5%; margin-top: 20px; margin-right: 10px;">
                        <button class="obrazavaniyaSelect btn btn-danger minusForSummPrice" style="padding-left: 14px; background-color: #FB3030; opacity: 0.8; border: none">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal_test" role="document">
            <div class="modal-content">
                <div class="modal-header border border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ----- ---- ---
                </div>
                <div class="modal-footer">
                    <button class="btn sozdatImyaSpisokSozdatButton text-light mt-0 savePriceFormation"
                        data-dismiss="modal"><?php echo e(translate('Save')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno"><?php echo e(translate('First select an object')); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        let page_name = 'settings';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house/price-formation.blade.php ENDPATH**/ ?>