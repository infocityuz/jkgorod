<?php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\HouseFlat;
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('JK')); ?>

<?php $__env->stopSection(); ?>
<style>
    .sozdatJkData {
        height: auto !important;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.deal.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt="">
                    </a>
                    <h2 class="panelUprText"><?php echo e(translate('Sale')); ?></h2>
                </div>
            </div>

            <div class="sozdatJkData">
                <form id="deal-create-form" action="<?php echo e(route('forthebuilder.deal.update',$model->id)); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PUT"); ?>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="prodnoDataH5Text"><?php echo e(translate('Description of the object')); ?></h3>
                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('jk')); ?></h3>
                                <select class="form-control sozdatImyaSpisokSelectOptionJkProdno deal_create_house_id <?php $__errorArgs = ['house_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        readonly id="exampleFormControlSelect1" name="house_id">
                                    <?php if(!empty($houses)): ?>
                                        <?php $__currentLoopData = $houses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $house): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($house_flat->id): ?>
                                                <option value="<?php echo e($house->id); ?>" <?php echo e($house_flat->house_id == $house->id? "selected" :''); ?>>
                                                    <?php echo e($house->name); ?> <?php echo e($house->description); ?>

                                                </option>
                                            <?php elseif(isset($model->house_id)): ?>
                                                <option value="<?php echo e($house->id); ?>" <?php echo e($house_flat->house_id == $house->id? "selected" :''); ?>>
                                                    <?php echo e($house->name); ?> <?php echo e($house->description); ?>

                                                </option>

                                            <?php endif; ?>
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
                            </div>

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Apartment No.')); ?></h3>
                                <?php if(isset(request()->house_flat_number )): ?>
                                    <input type="text" name="house_flat_number"
                                           class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                           value="<?php echo e(request()->house_flat_number); ?>">
                                <?php elseif($house_flat != 'NUll'): ?>
                                    <input type="text" name="house_flat_number"
                                           class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                           value="<?php echo e($house_flat->number_of_flat); ?>">
                                <?php endif; ?>
                                <span class="error-data">
                                    <?php $__errorArgs = ['house_flat_number'];
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
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('description')); ?></h3>
                                <input type="text" name="description"
                                       class="sozdatImyaSpisokInputProdnoBig form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       id="description"
                                       placeholder="<?php echo e(translate('Brief description of the residential complex')); ?>"
                                       value="<?php echo e(old('description')); ?>">
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

                            <div class="displayNoneProdnoMobile">
                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Contract number')); ?>

                                    </h3>
                                    <input type="text" name="agreement_number"
                                           class="form-control sozdatImyaSpisokSelectOptionJkProdno select2 <?php $__errorArgs = ['agreement_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    
                                    <span class="error-data">
                                        <?php $__errorArgs = ['agreement_number'];
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

                                <div class="form-group" style="margin-left: 10px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('date')); ?></h3>
                                    <input id="dateInput" placeholder="<?php echo e(date('d.m.Y')); ?>" type="date" name="date_deal"
                                           class="form-control sozdatImyaSpisokSelectOptionJkProdnoDate <?php $__errorArgs = ['date_deal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('date_deal')); ?>">
                                    <span class="error-data">
                                        <?php $__errorArgs = ['date_deal'];
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

                            <h3 class="prodnoDataH5Text"><?php echo e(translate('Passport data of the client')); ?></h3>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('First name')); ?></h3>
                                <input class="sozdatImyaSpisokInputProdnoBig form-control keyUpName booking-first_name <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       type="text" name="first_name" value="<?php echo e($clients != 'NULL'?$clients->first_name:'', old('first_name')); ?>">
                                <div class="keyUpNameResult d-none"
                                     style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    <?php $__errorArgs = ['first_name'];
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

                            <input type="hidden" name="client_id" class="booking-client_id" id="" value="<?php echo e($clients != 'NULL'?$clients->id:''); ?>">
                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Last name')); ?></h3>
                                <input class="sozdatImyaSpisokInputProdnoBig keyUpName form-control booking-last_name <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       type="text" name="last_name" value="<?php echo e($clients != 'NULL'?$clients->last_name:'', old('last_name')); ?>">
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
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Middle name')); ?></h3>
                                <input class="sozdatImyaSpisokInputProdnoBig keyUpName booking-middle_name form-control <?php $__errorArgs = ['middle_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       type="text" name="middle_name" value="<?php echo e($clients != 'NULL'?$clients->middle_name:'', old('middle_name')); ?>">
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

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Gender')); ?></h3>
                                <select class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                        id="exampleFormControlSelect1" name="gender">
                                    <?php if($clients != 'NULL'): ?>
                                        <option value="1" <?php echo e($clients->gender == 1 ?? "selected"); ?>><?php echo e(translate('Man')); ?></option>
                                        <option value="0" <?php echo e($clients->gender == 0 ?? "selected"); ?>><?php echo e(translate('Woman')); ?></option>
                                    <?php else: ?>
                                        <option value="1"><?php echo e(translate('Man')); ?></option>
                                        <option value="0"><?php echo e(translate('Woman')); ?></option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Serial number of the passport')); ?></h3>
                                <?php if($clients != 'NULL'): ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig keyUpName booking-series_number form-control <?php $__errorArgs = ['series_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        type="text" name="series_number" id="series_number" value="<?php echo e($clients->informations->series_number??'', old('series_number')); ?>">
                                <?php else: ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig keyUpName booking-series_number form-control <?php $__errorArgs = ['series_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           type="text" name="series_number" id="series_number" value="<?php echo e(old('series_number')); ?>">
                                <?php endif; ?>
                                    <div class="keyUpNameResult d-none"
                                     style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="error-data">
                                    <?php $__errorArgs = ['series_number'];
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
                                <h3 class="sozdatImyaSpisokH3Prodno">
                                    <?php echo e(translate('Issued by (Date of issue and expiration date)')); ?></h3>
                                <?php if($clients != 'NULL'): ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig booking-given_date form-control <?php $__errorArgs = ['given_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e($clients->informations->given_date??'', old('given_date')); ?>" type="date" name="given_date" id="given_date">
                                <?php else: ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig booking-given_date form-control <?php $__errorArgs = ['given_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('given_date')); ?>" type="date" name="given_date" id="given_date">
                                <?php endif; ?>
                                <span class="error-data">
                                    <?php $__errorArgs = ['given_date'];
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
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Registration by passport')); ?></h3>
                                <?php if($clients != 'NULL'): ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig booking-issued_by form-control <?php $__errorArgs = ['live_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e($clients->informations->live_address??'', old('live_address')); ?>" type="text" name="live_address"
                                           id="live_address">
                                <?php else: ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig booking-issued_by form-control <?php $__errorArgs = ['live_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('live_address')); ?>" type="text" name="live_address"
                                           id="live_address">
                                <?php endif; ?>
                                <span class="error-data">
                                    <?php $__errorArgs = ['live_address'];
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
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('PINFL or TIN')); ?></h3>
                                <?php if($clients != 'NULL'): ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig booking-inn <?php $__errorArgs = ['inn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e($clients->informations->inn??'', old('inn')); ?>" type="text" name="inn" id="inn">
                                <?php else: ?>
                                    <input class="sozdatImyaSpisokInputProdnoBig booking-inn <?php $__errorArgs = ['inn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e($clients->informations->inn??'', old('inn')); ?>" type="text" name="inn" id="inn">
                                <?php endif; ?>
                                <span class="error-data">
                                    <?php $__errorArgs = ['inn'];
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

                            <h3 class="prodnoDataH5Text"><?php echo e(translate('Contact details')); ?></h3>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Phone number')); ?></h3>
                                <div class="d-flex">
                                    <div>
                                        <img src="<?php echo e(asset('backend-assets/forthebuilders/images/region.png')); ?>"
                                             alt="Region">
                                    </div>
                                    <div>
                                        <input class="form-control keyUpName booking-phone <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               type="tel" id="phone" name="phone_number"
                                               value="<?php echo e($clients != 'NULL'?$clients->phone:'', old('phone_number')); ?>" required>
                                        
                                        <span class="error-data">
                                            <?php $__errorArgs = ['phone_number'];
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
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Additional phone number')); ?></h3>
                                <div class="d-flex">
                                    <div>
                                        <img src="<?php echo e(asset('backend-assets/forthebuilders/images/region.png')); ?>"
                                             alt="Region">
                                    </div>
                                    <div>
                                        <input class="form-control keyUpName booking-additional_phone <?php $__errorArgs = ['additional_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               type="tel" id="phone" name="additional_phone"
                                               value="<?php echo e($clients != 'NULL'?$clients->additional_phone:'', old('additional_phone')); ?>">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="sozdatImyaSpsok">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Email address')); ?></h3>
                                <input
                                        class="sozdatImyaSpisokInputProdnoBig booking-email form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('email')); ?>" type="email" name="email" id="email">
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

                            
                            

                            <div class="d-flex">
                                <label class="login_file">
                                    <input class="login_file" type="file" style="display: none;" name="files">
                                    <div class="d-flex">
                                        <button type="button"
                                                class="dobavitFotoPolzovatel btn btnDealCreateFile">+</button>
                                        <h5 class="dobavitFotoTextPolzovatel clickDealCreateFile">
                                            <?php echo e(translate('Attach file')); ?></h5>
                                    </div>
                                </label>
                            </div>

                        </div>

                        <div class="d-flex prodnoRightImportData" style="margin-top: 40px;">
                            <div>
                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Registry number')); ?></h3>
                                    <select
                                            class="form-control sozdatImyaSpisokSelectOptionJkProdno deal_create_registry_number <?php $__errorArgs = ['house_flat_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="exampleFormControlSelect1" name="house_flat_id" readonly>
                                        
                                        <?php if(isset($house_flat->id)): ?>
                                            <option value="<?php echo e($house_flat->id); ?>" <?php echo e($house_flat->id?"selected":''); ?>>
                                                <?php echo e(request()->house_flat_number ?? $house_flat->id); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e(request()->house_flat_id??''); ?>">
                                                <?php echo e(request()->house_flat_number??''); ?></option>

                                        <?php endif; ?>
                                    </select>
                                    <span class="error-data">
                                        <?php $__errorArgs = ['house_flat_id'];
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
                                <input type="hidden" name="doc_number"
                                       value="<?php echo e(request()->house_flat_number ?? ''); ?>">

                                <div class="form-group" style="margin-right: 30px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('price')); ?></h3>
                                    <?php if(isset($house_flat->id)): ?>
                                        <input type="text" name="price_sell"
                                               class="form-control sozdatImyaSpisokSelectOptionJkProdno dealCreatePrice <?php $__errorArgs = ['price_sell'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               value="<?php echo e($house_flat->price ?? old('price_sell')); ?>" step="0.01"
                                               min="0" original-price="<?php echo e($house_flat->price ?? old('price_sell')); ?>">
                                    <?php else: ?>
                                        <input type="text" name="price_sell"
                                               class="form-control sozdatImyaSpisokSelectOptionJkProdno dealCreatePrice <?php $__errorArgs = ['price_sell'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               value="<?php echo e(request()->flat_price ?? old('price_sell')); ?>" step="0.01"
                                               min="0" original-price="<?php echo e(request()->flat_price ?? old('price_sell')); ?>">
                                    <?php endif; ?>

                                    <span class="error-data">
                                        <?php $__errorArgs = ['price_sell'];
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

                            <!-- <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Gender')); ?></h3>
                                    <select class="form-control sozdatImyaSpisokSelectOptionJkProdno"
                                        id="exampleFormControlSelect1" name="gender">
                                        <option value="1"><?php echo e(translate('Man')); ?></option>
                                        <option value="0"><?php echo e(translate('Woman')); ?></option>
                                    </select>
                                </div> -->

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Coupon')); ?></h3>
                                    <input class="sozdatImyaSpisokInput" style="padding-right: 10px;" type="text"
                                           name="coupon" autocomplete="off" id="coupon-in-deal" value="">
                                    <span id="applied" style="color: green"></span>
                                    <input type="hidden" name="coupon_percent" id="coupon_percent">
                                    <button class="calculate_coupon_price d-none">Calculate Coupon Price</button>
                                </div>

                                <div>
                                    <div class="rassrochkaProdnoCheckBox7">
                                        <label class="d-flex flexDropdownRassrochka mt-1">
                                            <input class="rassrochkaProdnoCheck mt-2" type="checkbox"
                                                   name="is_installment" id="is_installment"> <?php echo e(translate('Installment plan')); ?>

                                        </label>
                                        <label class="d-flex flexDropdownRassrochka mt-1">
                                              <span class="error-data">
                                                <?php $__errorArgs = ['is_installment'];
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
                                        </label>
                                        <div id="noneDownDrop" class="noneDropDown">
                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno"><?php echo e(translate('Installment period')); ?></h3>
                                                <select class="form-control sozdatImyaSpisokDropDown selectPeriod"
                                                        id="exampleFormControlSelect1" name="period">
                                                    <option value=" "> </option>
                                                    <?php if(isset($installmentPlan)): ?>
                                                        <?php $__currentLoopData = $installmentPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($val->period > 0): ?>  
                                                                <option value="<?php echo e($val->id); ?>" <?php echo e($model->installment_plan_id == $val->id?"selected":''); ?>

                                                                    data-percent="<?php echo e($val->percent_type); ?>"><?php echo e($val->period); ?>

                                                                <?php echo e(translate('month')); ?></option>
                                                            <?php endif; ?>;
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>

                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno"><?php echo e(translate('Installment percent')); ?>

                                                </h3>
                                                <select class="form-control sozdatImyaSpisokDropDown selectPercent"
                                                        id="exampleFormControlSelect1" name="percent">
                                                    <option value=" "> </option>
                                                    <?php if(isset($installmentPlan)): ?>
                                                        <?php $__currentLoopData = $installmentPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($val->id); ?>" data-percent="<?php echo e($val->percent_type); ?>"
                                                                    <?php echo e($model->installment_plan_id == $val->id ?"selected":''); ?>>
                                                                <?php echo e($val->percent_type); ?> %
                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    
                                                </select>
                                            </div>

                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno"><?php echo e(translate('An initial fee')); ?></h3>
                                                <input class="form-control sozdatImyaSpisokDropDown initialFeeDeal"
                                                       type="text" name="initial_fee" value="<?php echo e($model->initial_fee??old('initial_fee')); ?>">
                                                <span class="error-data">
                                                    <?php $__errorArgs = ['initial_fee'];
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

                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno"><?php echo e(translate('Installment start date')); ?>

                                                </h3>
                                                <?php
                                                    $initial_fee_date = explode(' ', $model->initial_fee_date);
                                                ?>
                                                <input id="dateInput3" class="form-control sozdatImyaSpisokDropDown"
                                                       type="date" name="installment_date" value="<?php echo e($initial_fee_date[0]??old('initial_fee_date')); ?>">
                                                <span class="error-data">
                                                    <?php $__errorArgs = ['installment_date'];
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
                                </div>

                                
                            </div>

                            <div class="displayNoneProdno">
                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Contract number')); ?></h3>
                                    <input type="text" class="form-control sozdatImyaSpisokSelectOptionJkProdno">
                                </div>

                                <div class="form-group">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Date')); ?></h3>
                                    <input id="dateInput" placeholder="<?php echo e(date('d.m.Y')); ?>" type="date"
                                           class="form-control sozdatImyaSpisokSelectOptionJkProdnoDate">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="model_deal_id" id="deal_id">
                    <input type="hidden" name="model_personal_id" id="personal_id">
                    <input type="hidden" name="model_budget" class="modalMiniCapsule text-left" id="budget_input">
                    <input type="hidden" name="model_looking_for" class="modalMiniCapsule2 text-left" id="looking_for_input">
                    <input type="hidden" name="model_type" id="model_type" value="3">
                    <button type="submit" class="sozdatImyaSpisokSozdatButtonSave text-light"
                            style="cursor: pointer;"><?php echo e(translate('Save')); ?></button>
                </form>
            </div>

        </div>
    </div>
    <script>
        let page_name = 'deal';
        let budget_input = document.getElementById('budget_input')
        let looking_for_input = document.getElementById('looking_for_input')
        let series_number = document.getElementById('series_number')
        let live_address = document.getElementById('live_address')
        let inn = document.getElementById('inn')
        let deal_id = document.getElementById('deal_id')
        let personal_id = document.getElementById('personal_id')
        let is_installment = document.getElementById('is_installment')
        let noneDownDrop = document.getElementById('noneDownDrop')
        let installment_plan_id = "<?php echo e($model->installment_plan_id??"NULL"); ?>"

        if (localStorage.getItem('model_budget') != null) {
            budget_input.value = localStorage.getItem('model_budget')
        }
        if (localStorage.getItem('model_looking_for') != null) {
            looking_for_input.value = localStorage.getItem('model_looking_for')
        }
        if (localStorage.getItem('model_series_number') != null) {
            series_number.value = localStorage.getItem('model_series_number')
        }
        if (localStorage.getItem('model_issued_by') != null) {
            live_address.value = localStorage.getItem('model_issued_by')
        }
        if (localStorage.getItem('model_inn') != null) {
            inn.value = localStorage.getItem('model_inn')
        }
        if (localStorage.getItem('model_deal_id') != null) {
            deal_id.value = localStorage.getItem('model_deal_id')
        }
        if (localStorage.getItem('model_personal_id') != null) {
            personal_id.value = localStorage.getItem('model_personal_id')
        }
        if(installment_plan_id != "NULL"){
            is_installment.checked = true
            noneDownDrop.classList.add('blockDropDown')
        }
        $(document).on('change', '.dealCreatePrice', function() {
            console.log('good')
            var percent = $('.selectPercent').find('option:selected').attr('data-percent')
            var thisVal = $('.selectPercent').val()
            var dealCreatePrice = $(this).val()
            var setVal = parseInt(dealCreatePrice) - parseInt(parseInt(dealCreatePrice) / 100 * parseInt(percent))
            $('.initialFeeDeal').val(setVal)
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/deal/edit.blade.php ENDPATH**/ ?>