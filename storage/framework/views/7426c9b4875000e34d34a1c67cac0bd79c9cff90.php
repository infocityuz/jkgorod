

<?php $__env->startSection('title'); ?>
    <?php echo e(translate('leads')); ?>

<?php $__env->stopSection(); ?>

<style>
    .bronyaData {
        width: 86% !important;
    }

    .jkMiniData2,
    .jkMiniData {
        width: 98% !important;
    }
</style>

<?php
    use Modules\ForTheBuilder\Entities\Clients;
    use Modules\ForTheBuilder\Entities\Constants;
    $list = [];
        foreach ($booking as $key => $model) {
            if ($client = Clients::where('id', $model->client_id)->where('status', Constants::CLIENT_ACTIVE)->first()) {
                // $client = Clients::where('id', $model->client_id)->first();
                // dd($model);
                $data = [
                    'id' => $model->id,
                    'full_name' => ($client) ? $client->first_name . ' ' . $client->last_name . ' ' . $client->middle_name : '',
                    'phone' => ($client) ? $client->phone : '',
                    'status' => $model->status,
                    'prepayment' => $model->prepayment,
                ];
                array_push($list, $data);
            }
        }
        $models=$list;
?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <div style="max-width: 1394px;">
                <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText"><?php echo e(translate('booking')); ?></h2>
                </div>
                <div class="miniSearchDivaffloDour">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="<?php echo e(translate('Search by booking')); ?>" class="miniInputSdelka5 searchTable"
                        type="text">
                </div>
            </div>
            <div class="bronyaData">
                <div class="jkMiniData2">
                    <a href="" class="d-flex">
                        <div class="checkboxDivInput">
                            <input class="checkBoxInput" type="checkbox">
                        </div>
                        <div class="checkboxDivInput">
                            №
                        </div>
                        <div class="bronyaFio" style="justify-content: center;">
                            
                            <?php echo e(translate('Full Name')); ?>

                        </div>
                        <div class="bronyaTelefon">
                            
                            <?php echo e(translate('Phone')); ?>

                        </div>
                        <div class="checkboxDivTextInput3 srokDeystvieBronya">
                            
                            <?php echo e(translate('Palidity')); ?>

                        </div>
                        <div class="checkboxDivTextInput" style="width: 19vw;">
                            
                            <?php echo e(translate('Prepayment')); ?>

                        </div>
                    </a>
                    <div class="checkboxDivTextInput4 bronyaDeystvie">
                        
                        <?php echo e(translate('Actions')); ?>

                    </div>
                </div>
                
                <?php if(!empty($models)): ?>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="jkMiniData mb-1 hideData">
                            <input type="hidden" class="hiddenData"
                                value="<?php echo e($model['full_name'] . ' ' . $model['phone']); ?> <?php echo e($model['status'] == 1 ? translate('Active') : translate('No active')); ?> <?php echo e($model['prepayment']); ?>">
                            <div class="d-flex">
                                <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="checkboxDivInput">
                                    <input class="checkBoxInput sub_chk" data-id="<?php echo e($model['id']); ?>" type="checkbox">
                                </a>
                                <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="checkboxDivInput">
                                    <?php echo e($key + 1); ?>

                                </a>
                                <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="bronyaFio ">
                                    <?php echo e($model['full_name']); ?>

                                </a>
                                <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="bronyaTelefon">
                                    <?php echo e($model['phone']); ?>

                                </a>
                                <?php if($model['status'] == 1): ?>
                                    <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="bronyaActivniy text-info">
                                        <?php echo e(translate('Active')); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="bronyaActivniy text-danger">
                                        <?php echo e(translate('No active')); ?>

                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="checkboxDivTextInput" style="width: 19vw;">
                                    <?php echo e($model['prepayment']); ?>

                                </a>
                            </div>
                            <div class="checkboxDivTextInput4">
                                <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="seaDiv">
                                    <img style="margin-top: 4px;" width="25" height="25"
                                        src="<?php echo e(asset('/backend-assets/forthebuilders/images/eye.png')); ?>" alt="Eye">
                                </a>
                                <a href="<?php echo e(route('forthebuilder.booking.show', $model['id'])); ?>" class="seaDiv">
                                    <img class="mt-1" width="20" height="20"
                                        src="<?php echo e(asset('/backend-assets/forthebuilders/images/edit.png')); ?>" alt="Edit">
                                </a>
                                <a class="button seaDiv" style="cursor: pointer;">
                                    <input type="hidden" class="model_id" value="<?php echo e($model['id']); ?>">
                                    <img class="mt-1" data-toggle="modal" data-target="#exampleModalLong" class="mt-1"
                                        width="20" height="20"
                                        src="<?php echo e(asset('/backend-assets/forthebuilders/images/trash.png')); ?>"
                                        alt="Trash">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>


                <div class="aiz-pagination mt-2">
                    
                    <?php echo e($booking->links()); ?>

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
                        <button class="modalVideystvitelnoDa" data-dismiss="modal"><?php echo e(translate('Yes')); ?></button>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal"><?php echo e(translate('No')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>




<script src="<?php echo e(asset('/backend-assets/forthebuilders/javascript/jquery.min.js')); ?>"></script>
<script>
    let page_name = 'booking';
    console.log(page_name)
    $(document).ready(function() {
        $('.modalVideystvitelnoDa').on('click', function() {
            // var model_id=document.getElementById("model_id").value;
            var model_id = $('.model_id').val();
            //    console.log(model_id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "booking/destroy/" + model_id,
                type: 'DELETE',
                data: {
                    booking_id: model_id
                },
                success: function(response) {
                    console.log(response);
                    // location.reload();
                }
            });
        });
    });
</script>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/booking/index.blade.php ENDPATH**/ ?>