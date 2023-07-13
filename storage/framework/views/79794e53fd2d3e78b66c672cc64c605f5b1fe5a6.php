<style>
    .btnFilterFlat:hover {
        border: 5px solid lightgrey;
    }
</style>
<div>
    <div class="col-md-11">
        <span style="background-color: #44BE26; width: 10px; height: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <?php echo e(translate('The green ones are not given a price')); ?>

    </div>

    <div class="col-md-11">
        <span style="background-color: #FB3030; width: 10px; height: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <?php echo e(translate('The red ones are given a price even if it`s a piece')); ?>

    </div>
</div>
<div class="d-flex">
    <div class="dalePodyedzEtaj" style="margin: 50px 20px 0 0;">
        <?php if(empty(!$arr['entrance_count'])): ?>
            <?php $__currentLoopData = $arr['entrance_count']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val_entrance_count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h2 class="etajNameNomerDale"><?php echo e($val_entrance_count); ?></h2>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>

    <div class="d-flex" style="overflow: scroll">
        <?php if(empty(!$arr['list'])): ?>
            <?php
                $n = 0;
            ?>
            <?php $__currentLoopData = $arr['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $n++;
                    if ($status == 'client') {
                        $house_details_url = e(url('forthebuilder/clients/client-show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0 . '/' . $client_id;
                    } else {
                        $house_details_url = e(url('forthebuilder/house/show-details')) . '/' . $model->id . '/' . ($val['entrance'] ?? 0) . '/' . 0;
                    }
                ?>
                <div>
                    <div class="dalePodyedzBig2">
                        <h2 class="podyedzNameDale">
                            <?php echo e(translate('Entrance') . ' ' . ($val['entrance'] ?? '')); ?>

                        </h2>
                        <?php if(empty(!$arr['list'])): ?>
                            <?php $__currentLoopData = $val['list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $val2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex">
                                    <?php $__currentLoopData = $val2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="min-width: 60px; height: 60px;">
                                            <?php
                                                $partStr = translate('No data');
                                                if ($val3['areas_price']) {
                                                    $partStr = '';
                                                    $prices = json_decode($val3['areas_price']);
                                                    foreach ($prices as $key => $value) {
                                                        switch ($key) {
                                                            case 'fifty':
                                                                $keyPercent = 50;
                                                                break;
                                                            case 'thirty':
                                                                $keyPercent = 30;
                                                                break;
                                                            case 'hundred':
                                                                $keyPercent = 100;
                                                                break;
                                                        }
                                                        $partStr .= $keyPercent . ' - ( ';
                                                        foreach ($value as $key2 => $val) {
                                                            $partStr .= translate($key2) . ' = ' . $val . ', ';
                                                        }
                                                        $partStr .= ' ) ';
                                                    }
                                                    // dd($partStr);
                                                }
                                            ?>
                                            
                                            <?php
                                                $color = '#44BE26';
                                                if ($val3['areas_price']) {
                                                    $color = '#FB3030';
                                                }
                                            ?>
                                            <div class="podyedzNameDaleNol padyedzNameJkSeeaGreen btnFilterFlat btn bc"
                                                style="background-color: <?php echo e($color); ?>; z-index: 99999;"
                                                data-category="<?php echo e($val3['color_status']); ?>"
                                                datd-color="<?php echo e($colors[$val3['color_status']]); ?>" data-default="0"
                                                data-id=<?php echo e($val3['id']); ?> title="<?php echo e($partStr); ?>">
                                                <?php echo e($val3['room_count'] ?? 0); ?>

                                            </div>
                                            
                                            
                                            
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house/price-formation-flats.blade.php ENDPATH**/ ?>