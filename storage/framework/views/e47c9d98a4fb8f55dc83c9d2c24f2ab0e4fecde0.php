<?php
    use Modules\ForTheBuilder\Entities\House;
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('JK')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.house.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt=""></a>
                    <h2 class="panelUprText"><?php echo e(translate('Create a new JK')); ?></h2>
                </div>
            </div>

            <div class="sozdatJkData">
                <form id="" action="<?php echo e(route('forthebuilder.house.new-basket-house')); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="sozdatImyaSpsok">
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Name of JK')); ?></h3>
                        <input class="sozdatImyaSpisokInput <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            type="text" name="name" value="<?php echo e(old('name')); ?>">
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
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Corpas')); ?></h3>
                        <input class="sozdatImyaSpisokKorpus <?php $__errorArgs = ['corpus'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            type="text" name="corpus" value="<?php echo e(old('corpus')); ?>">
                        <span class="error-data">
                            <?php $__errorArgs = ['corpus'];
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
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Object status')); ?></h3>
                        <select
                            class="form-control sozdatImyaSpisokSelectOption2 <?php $__errorArgs = ['project_stage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> errpr-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="exampleFormControlSelect1" name="project_stage">
                            <option value="<?php echo e(House::DESIGN); ?>"><?php echo e(translate('Design')); ?></option>
                            <option value="<?php echo e(House::AT_THE_FOUNDATION_STAGE); ?>">
                                <?php echo e(translate('At the foundation stage')); ?></option>
                            <option value="<?php echo e(House::AT_THE_PRE_SALE_STAGE); ?>">
                                <?php echo e(translate('At the pre-sale stage')); ?></option>
                            <option value="<?php echo e(House::START_OF_OFFICIAL_SALES); ?>">
                                <?php echo e(translate('Start of official sales')); ?></option>
                            <option value="<?php echo e(House::STATUS_COMPLATED); ?>">
                                <?php echo e(translate('Completed')); ?></option>
                        </select>
                        <span class="error-data">
                            <?php $__errorArgs = ['project_stage'];
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
                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Description of the object')); ?></h3>
                        <input class="sozdatImyaSpisokInput <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            type="text" name="description" value="<?php echo e(old('description')); ?>">
                        <span class="error-data">
                            <?php $__errorArgs = ['description'];
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

                    <div class="sozdatJkFlex">
                        <div>
                            <div class="sozdatImyaSpsok widthSozdatJk2">
                                <h3 class="sozdatJkSpisokH3"><?php echo e(translate('Enterance count')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokKorpus houesCreateCalculateTotal <?php $__errorArgs = ['entrance_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="number" value="<?php echo e(old('entrance_count')); ?>" name="entrance_count"
                                    id="entrance_count">
                                <span class="error-data">
                                    <?php $__errorArgs = ['entrance_count'];
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

                            <div class="sozdatImyaSpsok widthSozdatJk">
                                <h3 class="sozdatJkSpisokH3"><?php echo e(translate('Floors')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokKorpus houesCreateCalculateTotal <?php $__errorArgs = ['floor_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="number" name="floor_count" value="<?php echo e(old('floor_count')); ?>" id="floor_count">
                                <span class="error-data">
                                    <?php $__errorArgs = ['floor_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <?php echo e($message); ?>

                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                        </div>

                        <div>
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatJkSpisokH3"><?php echo e(translate('Number of apartments on one floor')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokKorpus houesCreateCalculateTotal marginRightSozdatJkKolichistva <?php $__errorArgs = ['entrance_one_floor_count'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="number" name="entrance_one_floor_count"
                                    value="<?php echo e(old('entrance_one_floor_count')); ?>" id="entrance_one_floor_count">
                                <span class="error-data">
                                    <?php $__errorArgs = ['entrance_one_floor_count'];
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

                            <div class="sozdatImyaSpsok sozdatJkLast">
                                <h3 class="sozdatJkSpisokH3"><?php echo e(translate('Total apartments')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokKorpus <?php $__errorArgs = ['total_flat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="number" name="total_flat" value="<?php echo e(old('total_flat')); ?>" id="total_flat"
                                    readonly>
                                <span class="error-data">
                                    <?php $__errorArgs = ['total_flat'];
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

                            <div>
                                <label class="sozdatJkSpisokH3">
                                    <?php echo e(translate('Add basement')); ?>

                                    <input type="checkbox" name="has_basement"
                                        class="<?php $__errorArgs = ['has_basement'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        <?php echo e(old('has_basement') ? 'checked="checked"' : ''); ?>>
                                </label>
                                <span class="error-data">
                                    <?php $__errorArgs = ['has_basement'];
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

                                <label class="sozdatJkSpisokH3">
                                    <?php echo e(translate('Add attic')); ?>

                                    <input type="checkbox" name="has_attic"
                                        class="<?php $__errorArgs = ['has_attic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"<?php echo e(old('has_attic') ? 'checked="checked"' : ''); ?>>
                                </label>
                                <span class="error-data">
                                    <?php $__errorArgs = ['has_attic'];
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
                    <button type="submit" class="sozdatImyaSpisokSozdatButton"
                        style="cursor: pointer;"><?php echo e(translate('Further')); ?></button>
                </form>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'house';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house/create.blade.php ENDPATH**/ ?>