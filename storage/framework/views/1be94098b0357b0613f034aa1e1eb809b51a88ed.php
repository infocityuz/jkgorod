
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
                <form id="deal-create-form" action="<?php echo e(route('forthebuilder.deal.store')); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("POST"); ?>
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
                                            <?php if(isset(request()->house_id) && $house->id == request()->house_id): ?>
                                                <option value="<?php echo e($house->id); ?>">
                                                    <?php echo e($house->name); ?> <?php echo e($house->description); ?>

                                                </option>
                                            <?php elseif($house_flat->id): ?>
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

                            <div class="form-group">
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Passport or ID')); ?></h3>
                                <select class="form-control sozdatImyaSpisokSelectOptionJkProdno passport_or_id" id="exampleFormControlSelect3" name="passport_or_id">
                                    <option value="1"><?php echo e(translate('Passport')); ?></option>
                                    <option value="0"><?php echo e(translate('ID Card')); ?></option>
                                </select>
                            </div>

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
                                <h3 class="sozdatImyaSpisokH3Prodno">
                                    <?php echo e(translate('Birth date')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig form-control <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e($clients != 'NULL' ? $clients->birth_date : '', old('birth_date')); ?>" type="date" name="birth_date" id="birth_date">
                                <span class="error-data">
                                    <?php $__errorArgs = ['birth_date'];
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
                                <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Serial number of the passport')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig keyUpName booking-series_number form-control <?php $__errorArgs = ['series_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" name="series_number" id="series_number" value="<?php echo e($clients != 'NULL'?$clients->informations->series_number:'', old('series_number')); ?>">
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
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig booking-given_date form-control <?php $__errorArgs = ['given_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e($clients != 'NULL'?$clients->informations->given_date:'', old('given_date')); ?>" type="date" name="given_date" id="given_date">
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
                                <h3 class="sozdatImyaSpisokH3Prodno">
                                    <?php echo e(translate('Issued by')); ?></h3>
                                <input
                                    class="sozdatImyaSpisokInputProdnoBig booking-issued_by form-control <?php $__errorArgs = ['issued_by'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e($clients != 'NULL'?$clients->informations->issued_by:'', old('issued_by')); ?>" type="text" name="issued_by" id="issued_by">
                                <span class="error-data">
                                    <?php $__errorArgs = ['issued_by'];
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
                                <input class="sozdatImyaSpisokInputProdnoBig booking-issued_by form-control <?php $__errorArgs = ['live_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e($clients != 'NULL'?$clients->informations->live_address:'', old('live_address')); ?>" type="text" name="live_address"
                                    id="live_address">
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
                                <input class="sozdatImyaSpisokInputProdnoBig booking-inn <?php $__errorArgs = ['inn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e($clients != 'NULL'?$clients->informations->inn:'', old('inn')); ?>" type="text" name="inn" id="inn">
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
                                        <label style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;" for="+998">+998</label>
                                        <input type="hidden" name="phone_code" value="+998">
                                        <input class="sozdatImyaSpisokInputTel keyUpName booking-phone <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            type="tel" id="phone" name="phone_number"
                                            value="<?php echo e($clients != 'NULL'?$clients->phone_number:'', old('phone_number')); ?>">
                                        
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
                                        <label
                                            style="margin-bottom: -35px;z-index: 99;width: 50px;margin-left: 5px;margin-right: -55px;position: sticky;margin-top: 13px;padding-left: 6px;"
                                            for="+998">+998</label>
                                        <input class="sozdatImyaSpisokInputTel keyUpName booking-additional_phone <?php $__errorArgs = ['additional_phone'];
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

                                <div class="form-group" style="margin-right: 30px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Price in words')); ?></h3>
                                    <input type="text" name="price_sell_word" class="form-control sozdatImyaSpisokSelectOptionJkProdno <?php $__errorArgs = ['price_sell_word'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('price_sell_word')); ?>">

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

                                <div class="form-group" style="margin-right: 30px;">
                                    <h3 class="sozdatImyaSpisokH3Prodno"><?php echo e(translate('Price m2')); ?></h3>
                                    <input type="text" name="price_sell_m2" class="form-control sozdatImyaSpisokSelectOptionJkProdno dealCreatePriceM2 <?php $__errorArgs = ['price_sell_m2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(request()->price_m2 ?? old('price_sell_m2')); ?>" step="0.01" min="0" original-price="<?php echo e(request()->price_m2 ?? old('price_sell_m2')); ?>">

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

                                <div class="form-group" style="margin-right: 30px; width: 250px;">
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
                                                name="is_installment" id=""> <?php echo e(translate('Installment plan')); ?>

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
                                                    <?php if(empty(!$installmentPlan)): ?>
                                                        <?php $__currentLoopData = $installmentPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($val->id); ?>"
                                                                data-percent="<?php echo e($val->percent_type); ?>"><?php echo e($val->period); ?>

                                                                <?php echo e(translate('month')); ?></option>
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
                                                    <?php if(empty(!$installmentPlan)): ?>
                                                        <?php $__currentLoopData = $installmentPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($val->id); ?>"
                                                                data-percent="<?php echo e($val->percent_type); ?>">
                                                                <?php echo e($val->percent_type); ?> %
                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    
                                                </select>
                                            </div>

                                            <div class="polniy_DropDown">
                                                <h3 class="sozdatImyaDropDowno"><?php echo e(translate('An initial fee')); ?></h3>
                                                <input class="form-control sozdatImyaSpisokDropDown initialFeeDeal"
                                                    type="text" name="initial_fee">
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
                                                <input id="dateInput3" class="form-control sozdatImyaSpisokDropDown"
                                                    type="date" name="installment_date" value="<?php echo e(date('Y-m-d')); ?>">
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
                                    <input type="text" class="form-control sozdatImyaSpisokSelectOptionJkProdno" name="contract_number">
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
                    <input type="hidden" name="model_house_id" id="model_house_id" value="<?php echo e($house_flat->house_id); ?>">
                    <input type="hidden" name="model_house_flat_id" id="model_house_flat_id" value="<?php echo e($house_flat->id); ?>">
                    <input type="hidden" name="model_client_id" id="model_client_id">
                    <input type="hidden" name="model_type" id="model_type" value="3">
                    <button type="submit" class="sozdatImyaSpisokSozdatButtonSave text-light saveDealDogovor"
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
        let model_house_id = document.getElementById('model_house_id')
        let model_house_flat_id = document.getElementById('model_house_flat_id')
        let deal_id = document.getElementById('deal_id')
        let personal_id = document.getElementById('personal_id')

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
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/deal/create.blade.php ENDPATH**/ ?>