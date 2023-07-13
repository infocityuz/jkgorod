

<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Currency')); ?>

<?php $__env->stopSection(); ?>
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/datatables/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet"
    href="<?php echo e(asset('/backend-assets/forthebuilders/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('/backend-assets/forthebuilders/toastr/css/toastr.min.css')); ?>">

<?php $__env->startSection('content'); ?>
    <div class="d-flex aad">
        <?php echo $__env->make('forthebuilder::layouts.content.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="mainMargin">
            <?php echo $__env->make('forthebuilder::layouts.content.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="<?php echo e(route('forthebuilder.settings.index')); ?>"
                        class="plus2 profileMaxNazadInformatsiyaKlient"><img
                            src="<?php echo e(asset('/backend-assets/forthebuilders/images/icons/arrow-left.png')); ?>"
                            alt=""></a>
                    <h2 class="panelUprText"><?php echo e(translate('Translation')); ?></h2>
                </div>
            </div>

            <div class="card-header row gutters-5">
                <div class="col text-center text-md-left">
                    <h5 class="mb-md-0 h6"><?php echo e($language->name); ?></h5>
                    
                </div>
                <div class="col-md-4">
                    <form class="" id="sort_keys" action="" method="GET">
                        <input type="hidden" id="language_code" value="<?php echo e($language->code); ?>">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" id="search"
                                name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?>
                                placeholder="<?php echo e(translate('Type key & Enter')); ?>">
                        </div>
                    </form>
                </div>
            </div>


            <div class="nastroykiData">
                
                <form class="form-horizontal" action="<?php echo e(route('forthebuilder.translation.save')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($language->id); ?>">
                    <div class="sozdatPerveodMini">
                        <div class="checkboxDivInput">
                            №
                        </div>
    
                        <div class="d-flex" style="width: 100%;">
                            <div class="checkboxDivPerewvod">
                                <?php echo e(translate('Key')); ?>

                            </div>
                            <div class="checkboxDivPerewvod">
                                <?php echo e(translate('Translation')); ?>

                            </div>
                        </div>
                    </div>

                    <?php
                       $i = 1;
                    ?>
                    <?php $__currentLoopData = $lang_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="sozdatPerveodMini2">
                            <div class="checkboxDivInput">
                                <?php
                                echo $i++;
                                ?>
                            </div>
                            <div class="d-flex" style="width: 100%;">
                                <div class="checkboxDivPerewvod key" id="google_translate">
                                    <?php echo e($translation->lang_key); ?>

                                </div>
                                <input type="text" class="checkboxDivPerewvod value" id="input"
                                        style="width:100%" name="values[<?php echo e($translation->lang_key); ?>]"
                                        <?php if(($traslate_lang = \Modules\ForTheBuilder\Entities\Translation::where('lang', $language->code)->where('lang_key', $translation->lang_key)->first()) != null): ?> value="<?php echo e($traslate_lang->lang_value); ?>" <?php endif; ?>>
                                
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="aiz-pagination mt-2">
                                <?php echo e($lang_keys->appends(request()->input())->links()); ?>

                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2 text-right">
                                <button type="button" class="btn btn-primary"
                                    onclick="copyTranslation()"><?php echo e(translate('Copy Translations')); ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                            </div>
                        </div>
                    </div>
                    


                    

                </form>




            </div>
        </div>
    </div>
    


    <script src="<?php echo e(asset('/backend-assets/plugins/select2/js/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/toastr/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/backend-assets/plugins/bootstrap-datetimepicker.js')); ?>"></script>

    <script type="text/javascript">
        function copyTranslation() {
            $('.key').each(function(index) {
                console.log($(this).text());
                // var key=document.getElementsByClassName("checkboxDivPerewvod").inner;
                // console.log(key);
                // console.log();

                // $(tr).find('.value').val($(tr).find('.key').text());
                var _this = $(this)

                $.post('<?php echo e(route('languages.update_value')); ?>', {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: index,
                    code: document.getElementById("language_code").value,
                    status: $(this).text()
                }, function(data) {
                    console.log(data);
                    const tsestQ = document.getElementsByClassName("value");
                    // tsestQ.value=data;
                    // console.log(tsestQ);
                    _this.siblings('.value').val(data);
                    // $('.value').val(data);

                });
            });
        }

        function sort_keys(el) {
            $('#sort_keys').submit();
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/language/show.blade.php ENDPATH**/ ?>