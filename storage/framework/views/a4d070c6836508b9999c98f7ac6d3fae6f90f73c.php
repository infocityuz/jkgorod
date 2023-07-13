<?php
    use Modules\ForTheBuilder\Entities\House;
    use Modules\ForTheBuilder\Entities\HouseFlat;
    use Modules\ForTheBuilder\Entities\Constants;
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(translate('JK')); ?>

<?php $__env->stopSection(); ?>
<style>
    .jkDataEdit1 {
        height: 100% !important;
    }

    .trashFlex {
        margin-top: -90px !important;
    }

    .jkEditData {
        min-height: 0% !important;
    }

    .select-items {
        background-color: transparent !important;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.house.index')); ?>" class="plus2 profileMaxNazadInformatsiyaKlient">
                        <img src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>" alt="">
                    </a>
                    <h2 class="panelUprText">
                        <?php if($model->room_count == 'c'): ?>
                            <?php echo e($model->number_of_flat); ?> - <?php echo e(translate('commercial')); ?>

                        <?php elseif($model->room_count == 'p'): ?>
                            <?php echo e($model->number_of_flat); ?> - <?php echo e(translate('parking')); ?>

                        <?php else: ?>
                            <?php echo e($model->number_of_flat); ?> - <?php echo e(translate('flat')); ?> <?php echo e($model->total_area); ?> м <sup>2</sup>
                        <?php endif; ?>
                    </h2>
                </div>
                <button class="downloadColor">
                    <div class="d-flex" style="cursor: pointer" data-toggle="modal" data-target="#exampleModal2">
                        <div class="raspechat"><?php echo e(translate('Print')); ?></div>
                        <div>
                            <ion-icon class="raspechatIcon" name="print-outline"></ion-icon>
                        </div>
                    </div>
                </button>
            </div>

            <?php if(!empty($model->files) && count($model->files) > 0): ?>
                
                <div id="carouselExampleControls" class="carousel slide jkEditNewFatherDiv" data-ride="carousel">
                    <div class="carousel-inner caruselMyJkEdit">
                        <?php
                            $n = 0;
                        ?>
                        <?php for($i = 1; $i <= ceil(count($model->files) / 3); $i++): ?>
                            <?php
                                $active = $n == 0 ? 'active' : '';
                            ?>
                            <div class="carousel-item <?php echo e($active); ?>" data-interval="10000000">
                                <div class="cards-wrapper">

                                    <?php for($j = $i * 3 - 3; $j <= $i * 3 - 1 && $j < count($model->files); $j++): ?>
                                        <div data-toggle="modal" data-target="#exampleModalKatalog">
                                            <img class="jkImageEditSee"
                                                src="<?php echo e(asset('/uploads/house-flat/' . $model->house_id . '/m_' . $model->files[$n++]->guid)); ?>"
                                                alt="Home">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endfor; ?>

                    </div>

                    <div class="d-flex justify-content-between" style="width: 1200px;">
                        <a class="jkEditImgeLeft" href="#carouselExampleControls" role="button" data-slide="prev">
                            <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                            <span class="sr-only">Previous</span>
                            <img src="<?php echo e(asset('backend-assets/forthebuilders/images/arrow-left.png')); ?>" alt="Left">

                        </a>

                        <a class="jkEditImgeRight" href="#carouselExampleControls" role="button" data-slide="next">
                            <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                            <span class="sr-only">Next</span>
                            <img src="<?php echo e(asset('backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>"
                                alt="Left">
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="jkEditData">
                <div class="jkDataEdit1">
                    <div class="jkEditText1">
                        <div class="jkAttributEdit"><?php echo e(translate('Attribute')); ?></div>
                        <div class="jkAttributEdit"><?php echo e(translate('Data')); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('JK')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($model->house->name); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Information')); ?></div>
                        <div class="jkAttributEdit3"><?php echo e($model->house->description ?? ''); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Entrance')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($model->entrance); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Floor')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($model->floor); ?></div>
                    </div>

                    <?php if(is_int($model->room_count)): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Apartment number')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($model->number_of_flat); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php
                        $areas = json_decode($model->areas);
                    ?>
                    
                    <?php if(isset($areas->housing)): ?>
                        <div class="jkEditText1 d-none">
                            <div class="jkAttributEdit2"><?php echo e(translate('Area')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($areas->housing ?? 0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($areas->hotel)): ?>
                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Hotel')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($areas->hotel ?? 0); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(isset($areas->bedroom)): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Bedroom')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($areas->bedroom ?? 0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($areas->terraca > 0): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Area (Terrace)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($areas->terraca ?? 0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($areas->basement > 0): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Area (Sokolny)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($areas->basement ?? 0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($areas->attic > 0): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Area (Attic)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($areas->attic ?? 0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if(is_int($model->room_count)): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Number rooms')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($model->room_count ?? 0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($areas->balcony > 0): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Balcony')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($areas->balcony ?? 0); ?></div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="jkDataEdit1">
                    <div class="jkEditText1">
                        <div class="jkAttributEdit"><?php echo e(translate('Attribute')); ?></div>
                        <div class="jkAttributEdit"><?php echo e(translate('Data')); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Total area')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($areas->total); ?> <?php echo e(translate('m2')); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Status')); ?></div>
                        <div class="custom-select klientNameInformatsiaButtonKontact"
                            style="width:200px;background-color: transparent;margin-top: -3px;margin-right: -14px;">
                            <input type="hidden" name="status" id="flat_status_value" value="<?php echo e($model->status); ?>">
                            <?php
                                $selectedBooking = '';
                                $selectedFree = '';
                                $selectedSold = '';
                                if ($model->status == Constants::STATUS_BOOKING) {
                                    $selectedBooking = 'selected';
                                } elseif ($model->status == Constants::STATUS_FREE) {
                                    $selectedFree = 'selected';
                                } elseif ($model->status == Constants::STATUS_SOLD) {
                                    $selectedSold = 'selected';
                                }
                            ?>

                            <?php if($model->status == Constants::STATUS_SOLD): ?>
                                <div class="client-show-buttons showDetailsStatus"
                                    style="background-color: #FF9D9D; width: 184px; border-radius: 20px; height: 31px; display: flex; justify-content: center; align-items: center; text-align: center; border: none;">
                                    <?php echo e(translate('Sold')); ?>

                                </div>
                            <?php else: ?>
                                <select class="selectModal">
                                    <option value="<?php echo e(Constants::STATUS_BOOKING); ?>"><?php echo e(translate('Busy')); ?></option>
                                    <option value="<?php echo e(Constants::STATUS_SOLD); ?>"
                                        data-select="<?php echo e(HouseFlat::STATUS_SOLD); ?>" <?php echo e($selectedSold); ?>>
                                        <?php echo e(translate('Sold')); ?>

                                    </option>
                                    <option value="<?php echo e(Constants::STATUS_BOOKING); ?>"
                                        data-select="<?php echo e(HouseFlat::STATUS_BOOKING); ?>" <?php echo e($selectedBooking); ?>>
                                        <?php echo e(translate('Busy')); ?></option>
                                    <option value="<?php echo e(Constants::STATUS_FREE); ?>"
                                        data-select="<?php echo e(HouseFlat::STATUS_FREE); ?>" <?php echo e($selectedFree); ?>>
                                        <?php echo e(translate('Free')); ?>

                                    </option>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Date')); ?></div>
                        <div class="jkAttributEdit2"><small><?php echo e(date('d.m.Y H:i', strtotime($model->created_at))); ?></small>
                        </div>
                    </div>

                    <?php if(is_int($model->room_count)): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Registry number')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($model->doc_number ?? $model->number_of_flat); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php
                        $ares_price = json_decode($model->ares_price);
                    ?>
                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($ares_price->hundred->total ?? 0.0); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (30%)')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($ares_price->thirty->total ?? 0.0); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (50%)')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($ares_price->fifty->total ?? 0.0); ?></div>
                    </div>

                    <div class="jkEditText1">
                        <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (70%)')); ?></div>
                        <div class="jkAttributEdit2"><?php echo e($ares_price->seventy->total ?? 0.0); ?></div>
                    </div>

                    <?php if($areas->basement > 0): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Ground)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->hundred->basement ?? 0.0); ?></div>
                        </div>

                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Ground 30%)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->thirty->basement ?? 0.0); ?></div>
                        </div>

                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Ground 50%)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->fifty->basement ?? 0.0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($areas->attic > 0): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Attic)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->hundred->attic ?? 0.0); ?></div>
                        </div>

                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Attic 30%)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->thirty->attic ?? 0.0); ?></div>
                        </div>

                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Attic 50%)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->fifty->attic ?? 0.0); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($areas->terraca > 0): ?>
                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Terrace)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->hundred->terraca ?? 0.0); ?></div>
                        </div>

                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Terrace 30%)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->thirty->terraca ?? 0.0); ?></div>
                        </div>

                        <div class="jkEditText1">
                            <div class="jkAttributEdit2"><?php echo e(translate('Price for 1m2 (Terrace 50%)')); ?></div>
                            <div class="jkAttributEdit2"><?php echo e($ares_price->fifty->terraca ?? 0.0); ?></div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <?php if($model->status != Constants::STATUS_SOLD): ?>
                <div style="max-width: 1144px;" class="trashFlex">
                    <div style="margin-right: 170px;" class="d-flex">
                        <a href="<?php echo e(route('forthebuilder.house-flat.edit', $model->id)); ?>" class="trashBigButton"
                            style="cursor: pointer;">
                            <img class="deleteEditButton"
                                src="<?php echo e(asset('backend-assets/forthebuilders/images/edit2.png')); ?>" alt="Delete">
                        </a>
                        <button class="trashBigButton2" style="cursor: pointer;">
                            <img class="deleteEditButton" data-toggle="modal" data-target="#exampleModalLong"
                                src="<?php echo e(asset('backend-assets/forthebuilders/images/Vector.png')); ?>" alt="Delete">
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="modal fade" id="exampleModalKatalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog myModalWdthGallery" role="document">
            <div class="modal-content galareModalFather">
                <div class="modal-body">
                    <div id="carouselExampleControls2" data-interval="10000000" class="carousel slide"
                        data-ride="carousel">
                        <div class="carousel-inner">

                            <?php if(!empty($model->files)): ?>
                                <?php
                                    $first = true;
                                ?>
                                <?php $__currentLoopData = $model->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $class = '';
                                        if ($first) {
                                            $first = false;
                                            $class = 'active';
                                        }
                                    ?>
                                    <div class="carousel-item <?php echo e($class); ?>">
                                        <img class="madlImageJkEdit"
                                            src="<?php echo e(asset('/uploads/house-flat/' . $model->house_id . '/m_' . $img->guid)); ?>"
                                            alt="Home">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            
                        </div>
                        <div>
                            <a class="carousel-control-prev nextPrevioudFather" href="#carouselExampleControls2"
                                role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only"><?php echo e(translate('Previous')); ?></span>
                            </a>
                            <a class="carousel-control-next nextPrevioudFather" href="#carouselExampleControls2"
                                role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only"><?php echo e(translate('Next')); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
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
                            
                            <input type="hidden" class="house_flat_id" value="<?php echo e($model->id); ?>">
                            <input type="hidden" class="house_number_of_flat" value="<?php echo e($model->number_of_flat); ?>">
                            <input type="hidden" class="house_house_id" value="<?php echo e($model->house_id); ?>">
                            <input type="hidden" class="house_house_name" value="<?php echo e($model->house->name); ?>">
                            <input type="hidden" class="house_contract_number" value="<?php echo e($model->doc_number); ?>">
                            <input type="hidden" class="house_entrance" value="<?php echo e($model->entrance); ?>">
                            <input type="hidden" class="house_floor" value="<?php echo e($model->room_count); ?>">
                            <p class="flat_price d-none"><?php echo e($model->price); ?></p>
                            <?php
                                $price_m2 = 0;
                                if ($model->ares_price)
                                    $price_m2 = json_decode($model->ares_price)->hundred->total;

                            ?>
                            <input type="hidden" class="house_price_m2" value="<?php echo e($price_m2); ?>">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno"><?php echo e(translate('Do you really want to delete')); ?></h2>
                    <div class="d-flex justify-content-center mt-5">
                        <form style="display: inline-block; margin-right: 15px;"
                            action="<?php echo e(route('forthebuilder.house-flat.destroy', $model->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="modalVideystvitelnoDa"><?php echo e(translate('Yes')); ?></button>
                        </form>
                        <button class="modalVideystvitelnoNet" style="cursor: pointer;"><?php echo e(translate('No')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="modal-body" action="<?php echo e(route('forthebuilder.house-flat.print', $model->id)); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body modalPechat">
                        <h5 class="jkAttributEdit"><?php echo e(translate('Print')); ?></h5>

                        

                        <div class="sozdatImyaSpsok">
                            <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Valid until:')); ?></h3>
                            <input class="sozdatImyaSpisokInput" style="padding-right: 10px;" type="date"
                                name="date_picker" autocomplete="off" id="datePicker" value="">
                        </div>

                        <div class="sozdatImyaSpsok">
                            <h3 class="sozdatImyaSpisokH3"><?php echo e(translate('Coupon')); ?></h3>
                            <input class="sozdatImyaSpisokInput" style="padding-right: 10px;" type="text"
                                name="coupon" autocomplete="off" id="coupon" value="">
                            <span id="applied" style="color: green"></span>
                            <input type="hidden" name="coupon_percent" id="coupon_percent">
                        </div>

                        <button type="submit" class="pechatButtonModal btn"><?php echo e(translate('Print')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let page_name = 'house';
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/laravel/ikcrm_release/Modules/ForTheBuilder/Resources/views/house-flat/show.blade.php ENDPATH**/ ?>