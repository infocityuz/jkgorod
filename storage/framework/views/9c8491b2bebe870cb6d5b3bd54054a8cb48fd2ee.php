

<?php $__env->startSection('title'); ?>
    <?php echo e(translate('update')); ?>

<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet"
    href="<?php echo e(asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')); ?>">

<style>
    /* .jkMiniData,
    .jkMiniData2 {
        width: 1000px !important;
    } */

    .sdelkaData {
        width: 90% !important;
    }
    .bronyaFiofirst{
         overflow: hidden !important;
        white-space: nowrap !important;
        padding-left: 5px !important;
        justify-content:left !important;
    }
</style>

<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex justify-content-between">
                <div>
                    <h2 class="panelUprText"><?php echo e(translate('Installment plan')); ?></h2>
                </div>
                <div class="miniSearchDiv6">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="<?php echo e(translate('Search by installment plan')); ?>" class="miniInputSdelka5 searchTable"
                        type="text">
                </div>
            </div>

            <div style="width: auto;" class="sdelkaData">
                <div style="width: auto;" class="jkMiniData2">
                    <a href="" class="d-flex">
                        <div class="checkboxDivInput checkingInputRassrochkaChecked">
                            <input class="checkBoxInput" type="checkbox" id="master">
                        </div>
                        <div class="checkboxDivInput checkingInputRassrochkaChecked">
                            №
                        </div>
                        <div class="bronyaFio bronyaFioRassrochka bronyaFiofirst ">
                            <?php echo e(translate('Full name of the Customer')); ?>

                        </div>
                        <div class="checkboxDivTextInput2">
                            <?php echo e(translate('Apartment number')); ?>

                        </div>
                        <div style="width: 9.3vw;" class="sdlekaPriceJk">
                            <?php echo e(translate('Sum')); ?>

                        </div>
                        <div style="width: 9.3vw;" class="rassrochkaPokazatStatus">
                            <?php echo e(translate('Period')); ?>

                        </div>
                        <div style="width: 9.3vw;" class="rassrochkaPokazatStatus">
                            <?php echo e(translate('Status')); ?>

                        </div>
                    </a>
                    <div class="checkboxDivTextInput4">
                        <?php echo e(translate('Action')); ?>

                    </div>
                </div>

                <?php if(empty(!$models)): ?>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($model->client): ?>
                            <div style="width: auto;" class="jkMiniData mb-1 hideData">
                                <input type="hidden" class="hiddenData"
                                    value="<?php echo e(!empty($model->client) ? $model->client->last_name . ' ' . $model->client->first_name . ' ' . $model->client->middle_name : ''); ?> <?php echo e($model->agreement_number ?? ''); ?> <?php echo e(number_format($model->price_sell, 2)); ?> <?php echo e($model->installmentPlan->period ?? 0); ?> ">
                                <div class='d-flex'>
                                    <a href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="checkboxDivInput checkingInputRassrochkaChecked">
                                        <input class="checkBoxInput sub_chk" type="checkbox" data-id="<?php echo e($model->id); ?>">
                                    </a>
                                    <a href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="checkboxDivInput checkingInputRassrochkaChecked">
                                        <?php echo e($models->firstItem() + $key); ?>

                                    </a>
                                    <a href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="bronyaFio">
                                        <?php if(!empty($model->client)): ?>
                                            <?php echo e($model->client->last_name . ' ' . $model->client->first_name . ' ' . $model->client->middle_name); ?>

                                        <?php endif; ?>
                                    </a>
                                    <a href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="checkboxDivTextInput2">
                                        <?php echo e($model->agreement_number ?? ''); ?>

                                    </a>
                                    <a style="width: 9.3vw;" href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="sdlekaPriceJk">
                                        <?php echo e(number_format($model->price_sell, 2)); ?>

                                    </a>
                                    <a style="width: 9.3vw;" href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="rassrochkaPokazatStatus">
                                        <?php echo e($model->installmentPlan->period ?? 0); ?>

                                    </a>
                                    <a style="width: 9.3vw;" href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="rassrochkaPokazatStatusGreen show-status" data-id="<?php echo e($model->id); ?>"
                                        data-period="<?php echo e($model->installmentPlan->period); ?>"
                                        data-price="<?php echo e($model->price_sell); ?>">
                                        <?php echo e(translate('Show status')); ?>

                                    </a>
                                    <div class="checkboxDivTextInput4">
                                        <a href="<?php echo e(route('forthebuilder.installment-plan.show', $model->id)); ?>" class="seaDiv">
                                            <img style="margin-top: 4px;" width="25" height="25"
                                                src="<?php echo e(asset('/backend-assets/forthebuilders/images/eye.png')); ?>" alt="Eye">
                                        </a>
                                        <a href="<?php echo e(route('forthebuilder.installment-plan.edit', $model->id)); ?>" class="seaDiv">
                                            <img class="mt-1" width="20" height="20"
                                                src="<?php echo e(asset('/backend-assets/forthebuilders/images/edit.png')); ?>" alt="Edit">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="aiz-pagination mt-2">
                    <?php echo e($models->appends(request()->input())->links()); ?>

                </div>
            </div>
        </div>
    </div>
    <script>
        let page_name = 'installment-plan';
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/installment-plan/index.blade.php ENDPATH**/ ?>