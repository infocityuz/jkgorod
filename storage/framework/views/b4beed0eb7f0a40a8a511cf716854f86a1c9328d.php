

<?php $__env->startSection('title'); ?>
    <?php echo e(translate('show')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('/backend-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/backend-assets/plugins/toastr/toastr.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?php echo e(translate('installment_plan')); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="<?php echo e(route('forthebuilder.index')); ?>"><?php echo e(translate('home')); ?></a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?php echo e(route('forthebuilder.task.index')); ?>"><?php echo e(translate('task')); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo e(translate('show')); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-block table-border-style">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Атрибут</th>
                            <th>Данные</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><b><?php echo e(translate('title')); ?></b></td>
                            <td><?php echo e($model->title); ?></td>
                        </tr>
                        <tr>
                            <td><b><?php echo e(translate('task_user_id')); ?></b></td>
                            <td><?php echo e(isset($model->performer) ? $model->performer->last_name . ' ' . $model->performer->first_name . ' ' . $model->performer->middle_name : ''); ?>

                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo e(translate('type')); ?></b></td>
                            <td><?php echo e($model->type); ?></td>
                        </tr>
                        <tr>
                            <td><b><?php echo e(translate('task_date')); ?></b></td>
                            <td><?php echo e($model->task_date); ?></td>
                        </tr>
                        <tr>
                            <td><b><?php echo e(translate('prioritet')); ?></b></td>
                            <td><?php echo e($model->prioritet); ?></td>
                        </tr>
                        <tr>
                            <td><b><?php echo e(translate('status')); ?></b></td>
                            <td>
                                <select name="status" id="status" data-id="<?php echo e($model->id); ?>"
                                    data-placeholder="<?php echo e(translate('select')); ?>"
                                    class="form-control select2 <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid error-data-input <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="Новый" <?php echo e($model->status == 'Новый' ? 'selected' : ''); ?>>Новый
                                    </option>
                                    <option value="Процес" <?php echo e($model->status == 'Процес' ? 'selected' : ''); ?>>Процес
                                    </option>
                                    <option value="Закрыто" <?php echo e($model->status == 'Закрыто' ? 'selected' : ''); ?>>Закрыто
                                    </option>
                                </select>
                                <span class="error-data">
                                    <?php $__errorArgs = ['status'];
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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('/backend-assets/plugins/toastr/toastr.min.js')); ?>"></script>

    <script>
        let page_name = 'tasks';
        $('#status').on('change', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            var selectedstatuses = $(this).val();
            console.log(id)
            $.ajax({
                url: `/forthebuilder/task/update-status/${id}`,
                data: {
                    status: selectedstatuses
                },
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data['warning']) {
                        toastr.warning(data['warning']);
                    }
                    if (data['success']) {
                        toastr.success(data['success']);
                    }
                    // if(data['status'] == 'Не оплачен'){
                    //     color = 'red';
                    //     status1 = 'selected';
                    // }else{
                    //     color = 'rgb(25,132,86)';
                    //     status2 = 'selected';
                    // }
                    // $('.plan_status[data-id='+data['id']+']').css('background',color);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forthebuilder::layouts.forthebuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ikcrm_release\Modules/ForTheBuilder\Resources/views/task/show.blade.php ENDPATH**/ ?>