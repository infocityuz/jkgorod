<?php
    use Modules\ForTheBuilder\Entities\House;
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('JK')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .file-preview {
            display: none !important;
        }
    </style>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.house.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt="">
                    </a>
                    <h2 class="panelUprText"><?php echo e($model->name); ?></h2>
                    <!-- <button class="plus2">+</button> -->
                </div>
            </div>

            <div class="sozdatJkDaleData">
                <div class="d-flex">
                    

                    <div class="d-flex" style="overflow: scroll">
                        <?php if(empty(!$arr['list'])): ?>
                            <?php
                                $n = 0;
                            ?>
                            <?php $__currentLoopData = $arr['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    
                                
                                <?php
                                    $n++;
                                ?>
                                <div class="dalePodyedzBig">
                                    <h2 class="podyedzNameDale"><?php echo e(translate('Entrance') . ' ' . ($val['entrance'] ?? '')); ?>

                                    </h2>
                                    <?php if(empty(!$arr['list'])): ?>
                                        <?php $__currentLoopData = $val['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex hover-remove-add">
                                                <h2 class="etajNameNomerDale" style="min-width: 30px; margin-top: 10px;"><?php echo e($key2); ?></h2>
                                                <?php $__currentLoopData = $val2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php
                                                        $class = 'btn btn-secondary apartments-button btn-flat';
                                                        $disabled = 0;
                                                        if ($val3['room_count']) {
                                                            $class = 'btn btn-success apartments-button btn-flat';
                                                            $disabled = 1;
                                                        }
                                                    ?>
                                                    <div style="min-width: 60px; height: 50px;">
                                                        

                                                        <button
                                                            class="podyedzNameDaleNol padyedzNameJkSeeaGreen btn-filter-flat flat-button <?php echo e($class); ?>"
                                                            disabled data-id="<?php echo e($val3['id']); ?>" data-disabled="<?php echo e($disabled); ?>"
                                                            data-category="<?php echo e($val3['color_status']); ?>"
                                                            data-def='0'><?php echo e($val3['room_count'] ?? 0); ?></button>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="floor-action d-none" style="min-width: 60px; height: 50px; margin-bottom: 10px">
                                                        <i class="fa fa-trash float-left bascket-float-remove"
                                                           data-house-id="<?php echo e($model->id); ?>"
                                                           data-entrance="<?php echo e($val['entrance']); ?>" data-floor="<?php echo e($key2); ?>"
                                                           style="color: red; cursor: pointer;"></i>
                                                        &nbsp; &nbsp;
                                                        <i class="fa fa-plus bascket-float-add" data-house-id="<?php echo e($model->id); ?>"
                                                           data-entrance="<?php echo e($val['entrance']); ?>" data-floor="<?php echo e($key2); ?>"
                                                           style="color: #007bff; cursor: pointer;"></i>

                                                        

                                                    </div>
                                                    <div class="floor-marge-action d-none" style="min-width: 60px; height: 60px;">
                                                        <i class="fa fa-check save-bascket-float-marge"
                                                           data-house-id="<?php echo e($model->id); ?>"
                                                           data-entrance="<?php echo e($val['entrance']); ?>" data-floor="<?php echo e($key2); ?>"
                                                           style="color: #28a745; cursor: pointer; margin-left: 5px;"></i>
                                                    </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                
                
                
                
                
                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-flex">
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='1'
                            data-def='0'><?php echo e(translate('1 room')); ?></button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='2'
                            data-def='0'><?php echo e(translate('2 room')); ?></button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='3'
                            data-def='0'><?php echo e(translate('3 room')); ?></button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='4'
                            data-def='0'><?php echo e(translate('4 room')); ?></button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='5'
                            data-def='0'><?php echo e(translate('5 room')); ?></button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='c' 
                            data-def='0'><?php echo e(translate('Commercial')); ?></button>
                        <button class="sozdatImyaSpisokSozdatButtonJkDale room-count-button btn" data-number='p' 
                            data-def='0'><?php echo e(translate('Parking')); ?></button>
                    </div>
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                    <div class="d-flex">
                        <div class="podyedzNameDaleNol count-rooms">0</div>
                        <input placeholder="<?php echo e(translate('Apartments to description')); ?>" type="text"
                            class="KvartirKopisaniyu show-hidden-input">
                    </div>
                </div>

                
                
                <?php if($show_next_button): ?>
                    <input type="hidden" id="basket-id" value="<?php echo e($basket_id); ?>">
                    <button type="submit" data-toggle="modal" data-target="#exampleModalNext"
                        class="sozdatImyaSpisokSozdatButtonSave attach-order btn"><?php echo e(translate('Next')); ?></button>

                    
                <?php else: ?>
                    <button type="submit" data-toggle="modal" data-target="#exampleModal"
                        class="sozdatImyaSpisokSozdatButtonSave save-flats btn" disabled><?php echo e(translate('save')); ?></button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;background-color: #E8F0FF;width: 315px;margin-left: 185px;">
                <div class="modal-body">
                    <form action="<?php echo e(route('forthebuilder.house.update-flats-data')); ?>" method="POST"
                        enctype="multipart/form-data" id="chees-modal">
                        <div class="change_content">
                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722"><?php echo e(translate('Total area')); ?></h3>
                                <input type="number" name="total_area" class="modalMiniCapsule4 text-left">
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722"><?php echo e(translate('Living space')); ?></h3>
                                <input type="number" name="living_space" class="modalMiniCapsule4 text-left">
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722"><?php echo e(translate('Kitchen area')); ?></h3>
                                <input type="number" name="kitchen_area" class="modalMiniCapsule4 text-left">
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722"><?php echo e(translate('Terrace')); ?> <input type="checkbox"
                                        id="terassa"></h3>
                                <input type="number" placeholder="" name="terassa" class="modalMiniCapsule4 text-left"
                                    id="terassa_input" disabled>
                            </div>

                            <div class="mt-3">
                                <h3 class="sozdatJkSpisokH3722"><?php echo e(translate('Balcony')); ?> <input type="checkbox"
                                        id="balcony"></h3>
                                <input type="text" placeholder="" name="balcony" class="modalMiniCapsule4 text-left"
                                    id="balcony_input" disabled>
                            </div>
                        </div>

                        
                        <label for="files"><?php echo e(__('locale.file__upload')); ?></label>
                        <input type="file" name="files[]" id="files" multiple>

                        <input type="submit" value="<?php echo e(translate('Save')); ?>"
                            class="mdodalSaxranitSozdatJkDale float-right save-flats-form btn">
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalNext" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;background-color: #E8F0FF;width: 315px;margin-left: 185px;">
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <form action="">
        <?php echo csrf_field(); ?>
    </form>
    <script>
        let page_name = 'house';
    </script>
<?php $__env->stopSection(); ?>

 

<?php echo $__env->make('forthebuilder::house.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house/basket-show-more.blade.php ENDPATH**/ ?>