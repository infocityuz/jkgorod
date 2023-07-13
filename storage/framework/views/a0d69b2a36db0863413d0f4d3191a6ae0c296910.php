
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Booking')); ?>

<?php $__env->stopSection(); ?>

<style>
    .select-items > div:nth-child(2) {
    background-color: #B1FF9D !important;
}
</style>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <div style="max-width: 1394px;">
                <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.booking.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>"
                            alt=""></a>
                    <h2 class="panelUprText"><?php echo e(translate('Booking')); ?></h2>
                </div>
            </div>

            <div class="sozdatBronyaData">
                <div style="width: 100%;" class="d-flex">
                    <div>
                        <?php
                            $areaPrices = NULL;
                            if ($model->ares_price)
                                $areaPrices = json_decode($model->ares_price);

                            if ($areaPrices != NULL)
                                $priceForM2 = $areaPrices->hundred->total;
                        ?>
                        
                        <div class="sozdatImyaSpsok">
                            <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Client Full Name')); ?></h3>
                            <div class="sozdatImyaSpisokInput1272">
                                <?php
                                    echo ($model->client_first_name ?? '') . ' ' . ($model->client_last_name ?? '') . ' ' . ($model->client_middle_name ?? '');
                                ?>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="lidiMarginRight1272">
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Phone')); ?></h3>
                                    <div class="sozdatImyaSpisokInputTel1272"><?php echo e($model->phone ?? ''); ?></div>
                                </div>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"> <?php echo e(translate('Passport data ')); ?></h3>
                                    <div class="sozdatImyaSpisokInputPasport1272"><?php echo e($model->series_number ?? ''); ?></div>
                                </div>
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Booking period')); ?></h3>
                                    <div class="sozdatImyaSpisokInputPasport1272">

                                        <?php
                                            if ($model->expire_dates) {
                                                $array = json_decode($model->expire_dates);
                                                $array = end($array);
                                                echo $array->date ?? '';
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('House name')); ?></h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272"><?php echo e($model->house_name); ?></div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Apartment')); ?></h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272"><?php echo e($model->number_of_flat); ?></div>
                                </div>
                            </div>

                            <div class="lidiMarginRight1272">
                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Corpus')); ?></h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272"><?php echo e($model->corpus); ?></div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Entrance')); ?></h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272"><?php echo e($model->entrance); ?></div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Floor')); ?></h3>
                                    <div class="sozdatImyaSpisokInputKvartira1272"><?php echo e($model->floor); ?></div>
                                </div>

                                <div class="sozdatImyaSpsok">
                                    <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Prepayment')); ?></h3>
                                    <div class="sozdatImyaSpisokInputPredoplata1272"><?php echo e((int) $model->prepayment); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="sozdatBronImya"><?php echo e(translate('Responsible')); ?>: <br>
                            <?php
                                echo $model->manager_first_name . ' ' . $model->manager_last_name . ' ' . $model->manager_middle_name;
                            ?>
                        </p>
                        
                                  
                        <?php if($model->guid != null): ?>
                        
                            <img style="width:100%; height: 200px"  class="homeSozdatImage1272" src="<?php echo e(asset('/uploads/house-flat/' . $model->house_id . '/m_' . $model->guid)); ?>" alt="Home">

                            


                        <?php else: ?>
                            <img style="width:100%; height: 200px"  class="homeSozdatImage1272" src="<?php echo e(asset('/backend-assets/forthebuilders/images/a6d5ae15f8f52bd6b9db53be7746c650 1.png')); ?>" alt="Home">

                        <?php endif; ?>
                        
                        <div class="d-flex dropdownsBron">
                            <div class="dropdown">
                                <button class="btn modalYearSelect2 dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(translate('Booking status')); ?></button>
                                <div class="dropdown-menu dropdownBodyKalendar" aria-labelledby="dropdownMenuButton"
                                    x-placement="bottom-start"
                                    style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    
                                    
                                    <a class="dropdown-item yearNameKalendar2" href="<?php echo e(route('forthebuilder.deal.create',['house_flat_id'=>$model->house_flat_id,'house_flat_number'=>$model->number_of_flat,'house_id'=>$model->house_id,'house_name'=>$model->house_name,'contract_number'=>$model->doc_number,'flat_price'=>$model->price,'price_m2'=>$priceForM2])); ?>"><?php echo e(translate('Sell')); ?></a>
                                    
                                    <a class="dropdown-item yearNameKalendar2"  data-toggle="modal" data-target="#exampleModal2" href="#"><?php echo e(translate('Extend')); ?></a>
                                    <a class="dropdown-item yearNameKalendar2" href="#"><?php echo e(translate('reissue')); ?></a>
                                    
                                </div>
                            </div>

                            <div class="custom-select PerviyContactGreen2" style="width:200px; margin-top: 4px;">
                                <input type="hidden" id="model_id" value="<?php echo e($model->id); ?>">
                                
                                <select class="option_status" id="option_status" >
                                    <option>
                                        <?php echo e(translate('Status')); ?>

                                    </option>
                                    <option <?php if($model->status == 0): ?> selected <?php endif; ?> value="0">
                                        <?php echo e(translate('Not active')); ?>

                                    </option>
                                    <option style="background-color:green" <?php if($model->status == 1): ?> selected <?php endif; ?> value="1">
                                        <?php echo e(translate('Active')); ?>

                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="modal fade" id="exampleModal2" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="modal-form" action="<?php echo e(route('forthebuilder.booking.period.update')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="booking_id" value="<?php echo e($model->id); ?>">
                
                <div class="modal-content modalMyJk2">
                    <div class="modal-header border border-0">
                        <div class="d-flex justify-content-between" style="width: 100%;">
                            <div>
                                <h5 class="nomerKvartiraChenaKvartiri"><?php echo e(translate('Apartment number')); ?>: <b
                                        class="apartment_number"><?php echo e((int) $model->prepayment); ?> sum</b> <br> <?php echo e(translate('Apartment price')); ?>:
                                    <b class="apartment_price">41850</b> у.е.
                                </h5>
                            </div>
                            <div>
                                <h5 class="nomerKvartiraChenaKvartiri"><?php echo e(translate('Total area')); ?>: <b>45 m2</b> <br>
                                    <?php echo e(translate('Apartment price')); ?>:
                                    <b>41
                                        850</b> у.е.
                                </h5>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span id="closeSpan" aria-hidden="true">&times;</span>
                        </button>
                    </div>
        
                    <div class="modal-body">
        
                        
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
                                    type="text" name="first_name" value="<?php echo e($model->client_first_name); ?>"
                                    autocomplete="off" readonly>
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
                                    value="<?php echo e($model->client_last_name); ?>" type="text" name="last_name" readonly>
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
                                    value="<?php echo e($model->client_middle_name); ?>" type="text" name="middle_name" readonly>
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

                        <div class="row">
                            <div class="col-md-5">
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
                                                    value="<?php echo e($model->phone); ?>" type="tel" id="phone" name="phone"
                                                    readonly>
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
                                                    value="<?php echo e($model->additional_phone); ?>" type="tel"
                                                    id="additional_phone" name="additional_phone" readonly>
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
                                    
                            </div>
                            <div class="col-md-7">
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
                                            value="<?php echo e($model->series_number); ?>" type="text" name="series_number" style="margin-bottom:25px; margin-top:3px; width: 300px;
                                            height: 40px;" readonly>
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
                                        <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Prepayment amount')); ?></h3>
                                        <input
                                            class="sozdatImyaSpisokInput booking-prepayment_summa"
                                            value="<?php echo e((int) $model->prepayment); ?>" type="number" name="prepayment_summa" style="margin-bottom:25px; width: 300px;
                                            height: 40px;">
                                    </div>
                                    
                                    <div class="sozdatImyaSpsok" >
                                        <h3 class="sozdatImyaSpisokH3" ><?php echo e(translate('Booking period')); ?></h3>
                                            <input id="dateInput" placeholder="<?php echo e(date('Y-m-d')); ?>" type="date" name="date_deal"
                                                class="form-control sozdatImyaSpisokSelectOptionJkProdnoDate <?php $__errorArgs = ['date_deal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error-data-input is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                >
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
                        </div>
                        <button type="submit" class="sozdatImyaSpisokSozdatButton btn  text-light"><?php echo e(translate('Create')); ?>

                        </button>
                    </div>
                </div>

            </form>
        </div>
      </div>





    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    
    <script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/modalBackground.js')); ?>"></script>
    
    <script>
        let page_name = 'page-booking';
        $(document).on('click', '.select-hide', function() {
            var _this = $(this)

            var booking_status = $('.option_status').val();
            var model_id = $('#model_id').val();
            console.log(model_id);
            // var parsing_olx_url = $(this).siblings(".parsing_olx_url").val();
            // var parsing_id = $(this).siblings("parsing_id").val();

            // var parsing_olx_url=document.getElementsByClassName("parsing_olx_url").value;
            // var parsing_id=document.getElementsByClassName("parsing_id").value;

            $.post('<?php echo e(route('client.status.update')); ?>', {
                // _token: '<?php echo e(csrf_token()); ?>',
                // id: index,
                _token: '<?php echo e(csrf_token()); ?>',
                booking_status: booking_status,
                booking_id: model_id,
            }, function(data) {
                // element.removeClass("data");
                console.log(data);
                location.reload();
                // _this.siblings('.parsing_olx_url').attr('type', 'text').val(data);
                // document.getElementById("parsing_olx_url").value(data)
                // console.log(document.getElementById("parsing_olx_url").value);

            });
        })

        const backgorund12 = document.querySelector('.select-items');
        const backgroiund21 = document.querySelector('.PerviyContactGreen2');
        const backgorund42 = document.querySelector('.select-selected');
        console.log(backgorund42);
        backgorund42.classList.add('selectSelectInportantDropDownGreen2');
        const optionTest = backgorund42;

        backgorund42.addEventListener('click', function(){
            if (backgorund42.innerHTML = `<?php echo e(translate('Not active')); ?>`) {
                dkfjs.style.background = '#FF9D9D' 
                backgorund12.style.background = 'transparent' 
                backgroiund21.style.background = '#FF9D9D' 
                dkfjs.style.margin = "-4px 10px 0px 0px"
                dkfjs.style.height = "22px"
            } else if (backgorund42.innerHTML = `<?php echo e(translate('Active')); ?>`) {
                dkfjs.style.background = '#B1FF9D'
                backgorund12.style.background = 'transparent' 
                backgroiund21.style.background = '#B1FF9D'
                dkfjs.style.margin = "-4px 10px 0px 0px"
                dkfjs.style.height = "22px"
            }
        });
    </script>
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/booking/show.blade.php ENDPATH**/ ?>