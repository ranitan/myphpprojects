
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Add New Product</h2>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('product.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
               <?php echo $__env->make('product.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
               <button type="submit" class="btn btn-primary">Save</button>
               <a href="<?php echo e(route('product.index')); ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.layout", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\laravel-12-crud\resources\views/product/create.blade.php ENDPATH**/ ?>