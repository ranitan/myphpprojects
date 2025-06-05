
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2>Category List</h2>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-md-6">
                        <form class="d-flex" role="search" action="<?php echo e(route('category.index')); ?>" method="GET">
                                    <?php echo csrf_field(); ?>
                                    <input class="form-control me-2" name="search" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col">
                                <a href="<?php echo e(route('trashed.categories')); ?>" class="float-end btn btn-warning" style="margin-right: -57px;">Show Trashed</a>

                                </div>
                                <div class="col">
                                <a href="<?php echo e(route('category.create')); ?>" class="float-end btn btn-success">Add New</a>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <?php if(Session::has('success')): ?>
            <span class="alert alert-success p-2"><?php echo e(Session::get('success')); ?></span>
            <?php endif; ?>
            <?php if(Session::has('error')): ?>
            <span><?php echo e(Session::get('error')); ?></span>
            <?php endif; ?>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($categories) > 0): ?>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($loop->iteration); ?></th>
                            <td><?php echo e($category->name); ?></td>
                            <td><?php echo e($category->status); ?></td>
                            <td><a href="<?php echo e(route('category.show',$category->id)); ?>" class="btn btn-success btn-sm">show</a></td>
                            <td><a href="<?php echo e(route('category.edit',$category->id)); ?>" class="btn btn-primary btn-sm">edit</a></td>
                            <td>
                                <form action="<?php echo e(route('category.destroy',$category->id)); ?>" method="POST"
                                    style="display:inline-block">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button onclick="return confirm('Are you sure?')"
                                        class="btn btn-sm btn-danger">Trash Me</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No Data Found !</td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
                <?php echo e($categories->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\laravel-12-crud\resources\views/category/category-list.blade.php ENDPATH**/ ?>