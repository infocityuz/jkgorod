
<?php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\HouseFlat;
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('JK')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')); ?>">
    <style>
        .client-show-buttons {
            left: 0 !important;
        }

        .select-items>div:nth-child(1) {
            background-color: #B1FF9D !important;
        }

        .select-items>div:nth-child(3) {
            background-color: #FF9D9D !important;
        }
    </style>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.house.show-more', $model->id)); ?>"
                        class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt="">
                    </a>
                    <h2 class="panelUprText"><?php echo e($model->name); ?></h2>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3" style="margin-bottom: 15px; max-width: 1300px;">
                <button class="vseButton btn-filter btn" data-filter="all">
                    <?php echo e(translate('All')); ?> ( <?php echo e($arr['count_all']); ?> )
                </button>
                
                <button class="svobodnoButton btn-filter btn" style="background: <?php echo e($colors[0]); ?>;" data-filter="0">
                    <?php echo e(translate('Free')); ?> ( <?php echo e($arr['count_free']); ?> )
                </button>
                
                <button class="zanyatoButton btn-filter btn" style="background: <?php echo e($colors[1]); ?>;" data-filter="1">
                    <?php echo e(translate('Busy')); ?> ( <?php echo e($arr['count_bookings']); ?> )
                </button>
                
                <button class="prodnoButton btn-filter btn" style="background: <?php echo e($colors[2]); ?>;" data-filter="2">
                    <?php echo e(translate('Sales')); ?> ( <?php echo e($arr['count_solds']); ?> )
                </button>
                
            </div>

            <div class="card card-body accordionData">
                <div class="d-flex" style="margin-top: 20px;">
                    <div class="checkboxDivTextInput7222">
                        <?php echo e(translate('Floor')); ?>

                    </div>
                    <div class="podyedzNumber"><?php echo e(translate('Entrance')); ?> № <?php echo e($arr['entrance']); ?></div>
                </div>

                <?php if(empty(!$arr['list'])): ?>
                    <?php
                        $i = 0;
                    ?>
                    <?php $__currentLoopData = $arr['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex" style="margin-top: 10px;">
                            <div class="jkDomNumber">
                                <?php echo e($key); ?>

                            </div>
                            <div class="jkAllHouse">
                                <?php if(empty(!$value)): ?>
                                    <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($status == 'client'): ?>
                                            <a class="jkHouseGreen border border-0 btn-filter-flat flat-button flat-button-open-modal"
                                                href="<?php echo e(route('forthebuilder.clients.show', [$client_id, $val['id'],'0','0'])); ?>"
                                                style="background-color: #44BE26">
                                                <div class="jkHoueseBlueKomNumber"><?php echo e($val['room_count']); ?>

                                                    <?php echo e(translate('room')); ?></div>
                                                <div class="jkHouseGreeninData"><?php echo e($val['areas']); ?> <?php echo e(translate('m2')); ?>

                                                    <hr class="jkHouseGreeninDataHr"> <br>
                                                    <?php echo e(number_format($val['price'], 2, '.', '')); ?>

                                                    <?php echo e(translate('y.e')); ?>

                                                    <br>
                                                    <?php echo e(translate('per m2')); ?>

                                                </div>
                                            </a>
                                        <?php else: ?>
                                            <?php
                                                $perPrice = 0.0;
                                                if ($val['ares_price']) {
                                                    $ares_price = json_decode($val['ares_price']);
                                                    $perPrice = $ares_price->hundred->total;
                                                }
                                            ?>
                                            <button
                                                class="jkHouseGreen border border-0 btn-filter-flat flat-button flat-button-open-modal"
                                                type="button" data-toggle="modal" data-target="#exampleModal"
                                                style="background: <?php echo e($colors[$val['color_status']]); ?>;"
                                                data-category="<?php echo e($val['color_status']); ?>"
                                                data-price="<?php echo e($val['price']); ?>"
                                                data-room_count="<?php echo e($val['room_count']); ?>" data-areas="<?php echo e($val['areas']); ?>"
                                                data-price_m2="<?php echo e($perPrice); ?>" data-client="<?php echo e($val['client']); ?>"
                                                data-number_of_flat="<?php echo e($val['number_of_flat']); ?>"
                                                data-status="<?php echo e($val['color_status']); ?>" data-house_flat_id="<?php echo e($val['id']); ?>"
                                                data-house_house_id="<?php echo e($val['house_id']); ?>"
                                                data-house_house_name="<?php echo e($val['color_status']); ?>"
                                                data-house_contract_number="<?php echo e($val['color_status']); ?>"
                                                data-house_entrance="<?php echo e($arr['entrance']); ?>"
                                                data-house_floor="<?php echo e($val['floor']); ?>" data-doc="<?php echo e($val['doc']); ?>">
                                                <div class="jkHoueseBlueKomNumber"><?php echo e($val['room_count']); ?>

                                                    <?php echo e(translate('room')); ?></div>
                                                <div class="jkHouseGreeninData"><?php echo e($val['areas']); ?> <?php echo e(translate('m2')); ?>

                                                    <hr class="jkHouseGreeninDataHr"> <br>
                                                    <?php echo e(number_format($perPrice, 0, ',', '.')); ?>

                                                    
                                                    <br>
                                                    <?php echo e(translate('per m2')); ?>

                                                </div>
                                            </button>
                                        <?php endif; ?>
                                        <?php if($i == 0): ?>
                                            
                                        <?php endif; ?>
                                        <?php
                                            $i = 1;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modalMyJk">
                <div class="modal-header border border-0">
                    <h5 class="modal-title" id="exampleModalLabel"
                        style="margin-left: 30px; font-family: Rubik; margin-top: 10px; margin-bottom: -20px;"><span
                            class="number_of_flat">0</span> -
                        <?php echo e(translate('Flat')); ?> <span class="flat_area">00.00</span> <?php echo e(translate('m')); ?> 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <div>
                            <img width="364" height="260"
                                src="<?php echo e(asset('backend-assets/forthebuilders/images/a6d5ae15f8f52bd6b9db53be7746c650 1.png')); ?>"
                                alt="JkDom" style="margin-right: 10px">
                        </div>
                        <div>
                            <div class="modalJkData mb-4">
                                <?php echo e(translate('Price')); ?>

                                <div class="modalJkYeuro">
                                    <b><span class="flat_price">0000.00</span></b>
                                    
                                </div>
                            </div>

                            <div class="modalJkData mb-4">
                                <?php echo e(translate('Room count')); ?>

                                <div class="modalJkYeuro2 flat_room_count">
                                    0
                                </div>
                            </div>

                            <div class="d-flex mb-4">
                                <div class="custom-select modalSelect" style="width:200px;">
                                    
                                    <select class="selectModal">
                                        <option value="0"><?php echo e(translate('Status')); ?></option>
                                        <option data-select="<?php echo e(HouseFlat::STATUS_FREE); ?>"
                                            value="<?php echo e(HouseFlat::STATUS_FREE); ?>">
                                            <?php echo e(translate('Free')); ?></option>
                                        <option data-select="<?php echo e(HouseFlat::STATUS_BOOKING); ?>" id="zanyatiOption"
                                            data-toggle="modal" data-target="#exampleModal2"
                                            value="<?php echo e(HouseFlat::STATUS_BOOKING); ?>">
                                            <?php echo e(translate('Busy')); ?></option>
                                        <option data-select="<?php echo e(HouseFlat::STATUS_SOLD); ?>"
                                            value="<?php echo e(HouseFlat::STATUS_SOLD); ?>">
                                            <?php echo e(translate('Sold')); ?></option>
                                    </select>

                                </div>
                                <div class="client-show-buttons showDetailsStatus d-none"
                                    style="background-color: #FF9D9D; width:200px; border-radius: 20px; height: 50px; display: flex; justify-content: center; align-items: center; text-align: center; border: none;">
                                    <?php echo e(translate('Sold')); ?>

                                </div>
                                <div>
                                    
                                    <a href="<?php echo e(route('forthebuilder.house-flat.show', 0)); ?>" type="button"
                                        class="modalPodrobnoButton"><?php echo e(translate('Details')); ?></a>
                                </div>
                            </div>

                            <div class="modalJkDataFio flat_client_fio">
                                <?php echo e(translate('F.I.O')); ?>

                                <div class="modalJkFioM">
                                    <?php echo e(translate('No data')); ?>

                                </div>
                            </div>

                            <input type="hidden" class="house_flat_id" value="">
                            <input type="hidden" class="house_number_of_flat" value="">
                            <input type="hidden" class="house_house_id" value="">
                            <input type="hidden" class="house_house_name" value="">
                            <input type="hidden" class="house_contract_number" value="">
                            <input type="hidden" class="house_entrance" value="">
                            <input type="hidden" class="house_floor" value="">
                            <input type="hidden" class="house_price_m2" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="modal-form" action="<?php echo e(route('forthebuilder.booking.store')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content modalMyJk2">
                    <div class="modal-header border border-0">
                        <div class="d-flex justify-content-between" style="width: 100%;">
                            <div>
                                <h5 class="nomerKvartiraChenaKvartiri">
                                    <?php echo e(translate('Apartment number')); ?>: <b class="apartment_number"></b> <br>
                                    <?php echo e(translate('Price per sq/m')); ?>: <b class="apartment_price_m2"></b>
                                </h5>
                            </div>
                            <div>
                                <h5 class="nomerKvartiraChenaKvartiri">
                                    <?php echo e(translate('Total area')); ?>: <b class="apartment_area"> </b> m2 <br>
                                    <?php echo e(translate('Apartment price m2')); ?>: <b class="apartment_price"></b>
                                </h5>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span id="closeSpan" aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input class="booking-client_id" type="hidden" name="client_id"
                            value="<?php echo e(old('client_id')); ?>">
                        <input class="booking-house_flat_id" type="hidden" name="house_flat_id"
                            value="<?php echo e(old('house_flat_id')); ?>">
                        <input class="booking-house_number_of_flat" type="hidden" name="house_number_of_flat"
                            value="<?php echo e(old('house_number_of_flat')); ?>">
                        <input class="booking-house_house_id" type="hidden" name="house_house_id"
                            value="<?php echo e(old('house_house_id')); ?>">
                        <input class="booking-house_house_name" type="hidden" name="house_house_name"
                            value="<?php echo e(old('house_house_name')); ?>">
                        <input class="booking-house_contract_number" type="hidden" name="house_contract_number"
                            value="<?php echo e(old('house_contract_number')); ?>">
                        <input class="booking-house_entrance" type="hidden" name="house_entrance"
                            value="<?php echo e(old('house_entrance')); ?>">
                        <input class="booking-house_floor" type="hidden" name="house_floor"
                            value="<?php echo e(old('house_floor')); ?>">
                        <div style="width: 500px;">
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
                                    type="text" name="first_name" value="<?php echo e(old('first_name')); ?>"
                                    autocomplete="off">
                                <div class="keyUpNameResult d-none"
                                    style="width: 65%; background: lightgrey; max-height: 220px; position: absolute; margin-top: 75px; overflow: scroll; border-radius: 15px;">
                                </div>
                                <span class="select2-dropdown select2-dropdown--below"
                                    style="width: 610px; position: absolute; background: lightgrey; display: none; max-height: 177px; overflow: scroll;">
                                    <span class="select2-results">
                                        <ul class="select2-results__options" role="tree" aria-multiselectable="true"
                                            id="select2-0obe-results" aria-expanded="true" aria-hidden="false"
                                            style="padding: 0;">
                                        </ul>
                                    </span>
                                </span>

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
                                    value="<?php echo e(old('last_name')); ?>" type="text" name="last_name">
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
                                    value="<?php echo e(old('middle_name')); ?>" type="text" name="middle_name">
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
                        </div>

                        <div class="sozdatImyaSpsok">
                            <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Phone number')); ?></h3>
                            <div class="d-flex">
                                <div>
                                    <img src="<?php echo e(asset('backend-assets/forthebuilders/images/region.png')); ?>"
                                        alt="Region">
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
                                        value="<?php echo e(old('phone')); ?>" type="tel" id="phone" name="phone"
                                        required="">
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

                        <div class="d-flex">
                            <div>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('additional_phone_number')); ?></h3>
                                    <div class="d-flex">
                                        <div>
                                            <img src="<?php echo e(asset('backend-assets/forthebuilders/images/region.png')); ?>"
                                                alt="Region">
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
                                                value="<?php echo e(old('additional_phone')); ?>" type="tel"
                                                id="additional_phone" name="additional_phone">
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Serial number of the passport')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput keyUpName booking-series_number <?php $__errorArgs = ['series_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('series_number')); ?>" type="text" name="series_number">
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

                                <button type="submit"
                                    class="sozdatImyaSpisokSozdatButton text-light"><?php echo e(translate('Create')); ?></button>
                            </div>

                            <div class="jkDataRightTop">
                                <div class="d-flex" style="margin-top: -30px; margin-bottom: 30px;">
                                    
                                    <input type="checkbox" name="prepayment" id="prepayment"
                                        class="<?php $__errorArgs = ['prepayment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <label for="prepayment">
                                        <h3 class="sozdatImyaSpisokH3 predoplataImageRight"><?php echo e(translate('prepayment')); ?>

                                        </h3>
                                    </label>
                                    <span class="error-data">
                                        <?php $__errorArgs = ['prepayment'];
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
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Prepayment amount')); ?></h3>
                                    <input
                                        class="sozdatImyaSpisokInput booking-prepayment_summa <?php $__errorArgs = ['prepayment_summa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('prepayment_summa')); ?>" type="text" name="prepayment_summa"
                                        disabled>
                                    <span class="error-data">
                                        <?php $__errorArgs = ['prepayment_summa'];
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
            </form>
        </div>
    </div>
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/toastr/js/toastr.min.js')); ?>"></script>
     <script src="<?php echo e(asset('/backend-assets/plugins/inputmask/jquery.inputmask.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/jquery.maskedinput.min.js')); ?>"></script>
    <script>
        let page_name = 'house'

        $(document).on('click', '#closeSpan', function(e) {
            $('#exampleModal2').addClass('d-none')
            $('#exampleModal').removeClass('d-none')
        })
    </script>
     <script>
        $(document).ready(function() {
            $('input[type=tel]').mask("(999) 999-999");

            let sessionWarning = "<?php echo e(session('warning')); ?>";
            if (sessionWarning) {
                toastr.warning(sessionWarning)
            }
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('forthebuilder::house.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/house/show-details.blade.php ENDPATH**/ ?>