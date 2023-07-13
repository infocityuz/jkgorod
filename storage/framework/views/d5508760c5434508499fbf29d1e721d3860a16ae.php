

<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div style="max-width: 1394px;" class="d-flex justify-content-between">
                <div class="d-flex">
                    <h2 class="panelUprText"><?php echo e(translate('Clients')); ?></h2>
                    
                </div>
                <div class="miniSearchDiv">
                    <ion-icon class="miniSearchIconInput" name="search-outline"></ion-icon>
                    <input placeholder="<?php echo e(translate('Client search')); ?>" class="miniInputSdelka searchTable" type="text">
                </div>
            </div>

            <div>
                <a href="<?php echo e(route('forthebuilder.clients.index')); ?>" class="cdelki_c_klientamiBlue2">
                    <?php echo e(translate('Deals with clients')); ?>

                </a>
                <a href="<?php echo e(route('forthebuilder.clients.all-clients')); ?>" class="cdelki_c_klientami2">
                    <?php echo e(translate('All clients')); ?>

                </a>
            </div>

            <div class="sdelkaData">
                <div class="jkMiniData2">
                    <div class="checkboxDivInput">
                        <input class="checkBoxInput" type="checkbox">
                    </div>
                    <div class="checkboxDivInput spisokMarginRight7">
                        №
                    </div>
                    <div class="checkboxDivTextInput vseClientiVaqtinchaWith  spisokMarginRight7">
                        <?php echo e(translate('F.I.O. Clients')); ?>

                    </div>
                    <div class="vseClientiStatus spisokMarginRight7">
                        <?php echo e(translate('Status')); ?>

                    </div>
                    <div class="spisokCheckImia spisokMarginRight7">
                        <?php echo e(translate('Last Activity')); ?>

                    </div>
                    <div class="checkboxDivTextInput4">
                        <?php echo e(translate('Action')); ?>

                    </div>
                </div>

                <?php if(empty(!$models)): ?>
                    <?php
                        $n = 1;
                    ?>
                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="jkMiniData mb-1 hideData">
                            <input type="hidden" class="hiddenData"
                                value="<?php echo e($value->last_name . ' ' . $value->first_name . ' ' . $value->middle_name); ?> <?php echo e($value->status == $active ? translate('Active') : translate('Not active')); ?> <?php echo e(date('d.m.Y', strtotime($value->created_at))); ?>">
                            <div class="jkMiniData mb-1">
                                <a href="<?php echo e(route('forthebuilder.clients.show', [$value->id, '0', '0'])); ?>" class="checkboxDivInput">
                                    <input class="checkBoxInput" type="checkbox">
                                </a>
                                <a href="<?php echo e(route('forthebuilder.clients.show', [$value->id, '0', '0'])); ?>" class="checkboxDivInput spisokMarginRight7">
                                    
                                    <?php echo e($models->firstItem() + $key); ?>

                                </a>
                                <a href="<?php echo e(route('forthebuilder.clients.show', [$value->id, '0', '0'])); ?>" class="checkboxDivTextInput vseClientiVaqtinchaWith  spisokMarginRight7">
                                    <?php echo e($value->last_name . ' ' . $value->first_name . ' ' . $value->middle_name); ?>

                                </a>
                                <?php
                                    $class = 'vseClientiStatus dataSdelkaJkPinkNthChild dataSdelkaJkPinkNthChild spisokMarginRight7';
                                    if ($value->status == $active) {
                                        $class = 'vseClientiStatus dataSdelkaJkGreenNthChild dataSdelkaJkPinkNthChild spisokMarginRight7';
                                    }
                                ?>
                                <a href="<?php echo e(route('forthebuilder.clients.show', [$value->id, '0', '0'])); ?>" class="<?php echo e($class); ?>">
                                    <?php echo e($value->status == $active ? translate('Active') : translate('Not active')); ?>

                                </a>
                                <a href="<?php echo e(route('forthebuilder.clients.show', [$value->id, '0', '0'])); ?>" class="spisokCheckImia spisokMarginRight7">
                                    <?php echo e(date('d.m.Y', strtotime($value->created_at))); ?>

                                </a>
                                <div class="checkboxDivTextInput4">
                                    <!-- style="margin-right: 20px;" -->
                                        <a href="tel: <?php echo e($value->phone); ?>" class="seaDiv">
                                            <img class="mt-1" width="20" height="20"
                                                src="<?php echo e(asset('backend-assets/forthebuilders/images/Call.png')); ?>"
                                                alt="Trash">
                                        </a>
                                        <a href="<?php echo e($value->email); ?>" class="seaDiv">
                                            <img class="mt-1" width="20" height="20"
                                                src="<?php echo e(asset('backend-assets/forthebuilders/images/Mail.png')); ?>"
                                                alt="Trash">
                                        </a>
                                        <div class="seaDiv clientDelete"
                                            data-url="<?php echo e(route('forthebuilder.clients.destroy', $value->id)); ?>">
                                            <img data-toggle="modal" data-target="#exampleModalLong" class="mt-1"
                                                width="20" height="20"
                                                src="<?php echo e(asset('backend-assets/forthebuilders/images/trash.png')); ?>"
                                                alt="Trash">
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="aiz-pagination mt-4">
                        <?php echo e($models->links()); ?>

                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border: none;">
                <div class="modal-body">
                    <h2 class="modalVideystvitelno">Вы действительно хотите удалить</h2>
                    <div class="d-flex justify-content-center mt-5">
                        <form style="display: inline-block;" action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="modalVideystvitelnoDa">Да</button>
                        </form>
                        <button class="modalVideystvitelnoNet" data-dismiss="modal">Нет</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script>
    let page_name = 'clients';
</script>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\NewOSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/clients/all-clients.blade.php ENDPATH**/ ?>