<?php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\HouseFlat;
    use Modules\ForTheBuilder\Entities\Constants;
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
                    <h2 class="panelUprText"><?php echo e(translate('Add')); ?></h2>
                </div>
            </div>

            <div class="sozdatSpisokData">
                
                <form action="<?php echo e(route('forthebuilder.house-flat.update', $model->id)); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div style="width: 100%;" class="d-flex">
                        <div class="lidiMarginRight1272">
                            <div class="sozdatImyaSpsok">
                                <?php if(is_int($model->room_count)): ?>
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Apartment number')); ?></h3>
                                <?php elseif($model->room_count == 'p'): ?>
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Parking number')); ?></h3>
                                <?php else: ?>
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Commercial number')); ?></h3>
                                <?php endif; ?>
                                <input
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['number_of_flat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" value="<?php echo e($model->number_of_flat); ?>" name="number_of_flat">
                                <span class="error-data">
                                    <?php $__errorArgs = ['number_of_flat'];
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
                                <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Entrance')); ?></h3>
                                <select
                                    class="form-control sozdatImyaSpisokSelectOption1272 <?php $__errorArgs = ['entrance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="exampleFormControlSelect1" name="entrance">
                                    <?php if(empty(!$model->house)): ?>
                                        <?php for($i = 1; $i <= $model->house->entrance_count; $i++): ?>
                                            <?php
                                                $selectedI = '';
                                                if ($i == $model->entrance) {
                                                    $selectedI = 'selected';
                                                }
                                            ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e($selectedI); ?>><?php echo e($i); ?>

                                            </option>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="error-data">
                                    <?php $__errorArgs = ['entrance'];
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
                                <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Floor')); ?></h3>
                                <select
                                    class="form-control sozdatImyaSpisokSelectOption1272 <?php $__errorArgs = ['floor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="exampleFormControlSelect1" name="floor">
                                    <?php if(empty(!$model->house)): ?>
                                        <?php for($j = 1; $j <= $model->house->floor_count; $j++): ?>
                                            <?php
                                                $selectedJ = '';
                                                if ($j == $model->floor) {
                                                    $selectedJ = 'selected';
                                                }
                                            ?>
                                            <option value="<?php echo e($j); ?>" <?php echo e($selectedJ); ?>><?php echo e($j); ?>

                                            </option>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                </select>
                                <span class="error-data">
                                    <?php $__errorArgs = ['floor'];
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

                            <?php
                                $areas = json_decode($model->areas);
                            ?>
                            <div class="sozdatImyaSpsok d-none">
                                <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Living area m2')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_housing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" value="<?php echo e($areas->housing ?? 0); ?>" name="area_housing">
                                <span class="error-data">
                                    <?php $__errorArgs = ['area_housing'];
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

                            <?php if(is_int($model->room_count)): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Hotel area m2')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_hotel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($areas->hotel ?? 0); ?>" name="area_hotel">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['area_hotel'];
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
                            <?php endif; ?>

                            <?php if(is_int($model->room_count)): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Bedroom area m2')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_bedroom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($areas->bedroom ?? 0); ?>" name="area_bedroom">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['area_bedroom'];
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
                            <?php endif; ?>

                            <?php if($areas->basement > 0): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Area (Ground) m2')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_basement'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($areas->basement); ?>" name="area_basement">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['area_basement'];
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
                            <?php endif; ?>

                            <?php if($areas->terraca > 0): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Area (Terrace) m2')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_terraca'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($areas->terraca); ?>" name="area_terraca">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['area_terraca'];
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
                            <?php endif; ?>

                            <?php if($areas->attic > 0): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Area (Attic) m2')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_attic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($areas->attic); ?>" name="area_attic">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['area_attic'];
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
                            <?php endif; ?>

                            <?php if($areas->balcony > 0): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Balcony m2')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_balcony'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($areas->balcony); ?>" name="area_balcony">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['area_balcony'];
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
                            <?php endif; ?>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Total area m2')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['area_total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" value="<?php echo e($areas->total); ?>" name="area_total">
                                <span class="error-data">
                                    <?php $__errorArgs = ['area_total'];
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

                        <div>
                            

                            <div class="sozdatImyaSpsok">
                                <?php if(is_int($model->room_count)): ?>
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Registry number')); ?></h3>
                                <?php elseif($model->room_count == 'p'): ?>
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Registry parking number')); ?></h3>
                                <?php else: ?>
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Registry commercial number')); ?></h3>
                                <?php endif; ?>
                                <input
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['doc_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" value="<?php echo e($model->doc_number ?? $model->number_of_flat); ?>"
                                    name="doc_number" readonly>
                                <span class="error-data">
                                    <?php $__errorArgs = ['doc_number'];
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

                            <?php
                                $ares_price = json_decode($model->ares_price);
                            ?>
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" name="price" value="<?php echo e($ares_price->hundred->total ?? 0.0); ?>">
                                <span class="error-data">
                                    <?php $__errorArgs = ['price'];
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
                                <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (30%)')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_30'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" value="<?php echo e($ares_price->thirty->total ?? 0.0); ?>" name="price_30">
                                <span class="error-data">
                                    <?php $__errorArgs = ['price_30'];
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
                                <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (50%)')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_50'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" value="<?php echo e($ares_price->fifty->total ?? 0.0); ?>" name="price_50">
                                <span class="error-data">
                                    <?php $__errorArgs = ['price_50'];
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

                            <?php if($areas->basement > 0): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Ground)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_basement'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->hundred->basement ?? 0.0); ?>"
                                        name="price_basement">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_basement'];
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Ground 30%)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_basement_30'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->thirty->basement ?? 0.0); ?>"
                                        name="price_basement_30">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_basement_30'];
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Ground 50%)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_basement_50'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->fifty->basement ?? 0.0); ?>"
                                        name="price_basement_50">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_basement_50'];
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
                            <?php endif; ?>

                            <?php if($areas->attic > 0): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Attic)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_attic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->hundred->attic ?? 0.0); ?>"
                                        name="price_attic">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_attic'];
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Attic 30%)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_attic_30'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->thirty->attic ?? 0.0); ?>"
                                        name="price_attic_30">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_attic_30'];
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Attic 50%)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_attic_50'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->fifty->attic ?? 0.0); ?>"
                                        name="price_attic_50">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_attic_50'];
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
                            <?php endif; ?>

                            <?php if($areas->terraca > 0): ?>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Terrace)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_terrace'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->hundred->terraca ?? 0.0); ?>"
                                        name="price_terrace">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_terrace'];
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Terrace 30%)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_terrace_30'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->thirty->terraca ?? 0.0); ?>"
                                        name="price_terrace_30">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_terrace_30'];
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Price for 1m2 (Terrace 50%)')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput1272 <?php $__errorArgs = ['price_terrace_50'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" value="<?php echo e($ares_price->fifty->terraca ?? 0.0); ?>"
                                        name="price_terrace_50">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_terrace_50'];
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
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <?php if(is_int($model->room_count)): ?>
                        <input type="file" class="sozdatImyaSpisokSozdatButton1272" id="" name="files">
                        
                        <?php if(!empty($model->files)): ?>
                            <?php $__currentLoopData = $model->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <img width="30" height="30" class="madlImageJkEdit"
                                    src="<?php echo e(asset('/uploads/house-flat/' . $model->house_id . '/m_' . $img->guid)); ?>"
                                    alt="Home">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <button type="submit" class="sozdatImyaSpisokSozdatButton1272sozdat"
                        style="cursor: pointer;"><?php echo e(translate('Create')); ?></button>
                </form>
            </div>


        </div>
    </div>
    <script>
        let page_name = 'house-flat';
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house-flat/edit.blade.php ENDPATH**/ ?>