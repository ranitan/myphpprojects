
<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Category Details</h2>

        <div class="card">
            <div class="card-body">

                <p><strong>Name:</strong> <?php echo e($category->name); ?></p>
                <p><strong>Status:</strong>
                    <span class="badge bg-<?php echo e($category->status === 'active' ? 'success' : 'secondary'); ?>">
                        <?php echo e(ucfirst($category->status)); ?>

                    </span>
                </p>


                <a href="<?php echo e(route('trashed.categories')); ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\laravel-12-crud\resources\views/category/show-trashed.blade.php ENDPATH**/ ?>