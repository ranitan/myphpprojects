
<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2>Product Details</h2>

        <div class="card">
            <div class="card-body">
                <?php if($product->image): ?>
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" width="250" class="mb-3">
                <?php endif; ?>

                <p><strong>Name:</strong> <?php echo e($product->name); ?></p>
                <p><strong>Description:</strong> <?php echo e($product->description); ?></p>
                <p><strong>Price:</strong> $<?php echo e(number_format($product->price, 2)); ?></p>
                <p><strong>Quantity:</strong> <?php echo e($product->quantity); ?></p>
                <p><strong>Category:</strong> <?php echo e($product->category->name ?? '-'); ?></p>
                <p><strong>Status:</strong>
                    <span class="badge bg-<?php echo e($product->status === 'active' ? 'success' : 'secondary'); ?>">
                        <?php echo e(ucfirst($product->status)); ?>

                    </span>
                </p>


                <a href="<?php echo e(route('product.trashed')); ?>" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\laravel-12-crud\resources\views/product/show-trashed.blade.php ENDPATH**/ ?>