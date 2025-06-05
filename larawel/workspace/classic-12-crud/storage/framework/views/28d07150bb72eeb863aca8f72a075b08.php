

<?php $__env->startSection('content'); ?>
<div class="content-header">
    <h1 class="page-title">
        <i class="fas fa-eye me-3"></i>Category Details
    </h1>
    <p class="page-subtitle">View complete category information</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-classic">
                <div class="card-header">
                    <h3 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--classic-primary);">
                        <i class="fas fa-info-circle me-2"></i><?php echo e($category->name); ?>

                    </h3>
                    <small class="text-muted">Category ID: #<?php echo e($category->id); ?></small>
                </div>
                <div class="card-body p-4">
                    <div class="category-details">
                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-tag me-2"></i>Category Name
                            </div>
                            <div class="detail-value"><?php echo e($category->name); ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-label">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </div>
                            <div class="detail-value">
                                <span class="status-badge status-<?php echo e($category->status); ?>">
                                    <i class="fas fa-<?php echo e($category->status === 'active' ? 'check-circle' : 'pause-circle'); ?> me-1"></i>
                                    <?php echo e(ucfirst($category->status)); ?>

                                </span>
                            </div>
                        </div>

                        <?php if($category->created_at): ?>
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-calendar-plus me-2"></i>Created
                                </div>
                                <div class="detail-value">
                                    <?php echo e($category->created_at->format('M d, Y \a\t g:i A')); ?>

                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($category->updated_at && $category->updated_at != $category->created_at): ?>
                            <div class="detail-item">
                                <div class="detail-label">
                                    <i class="fas fa-calendar-edit me-2"></i>Last Updated
                                </div>
                                <div class="detail-value">
                                    <?php echo e($category->updated_at->format('M d, Y \a\t g:i A')); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?php echo e(route('trashed.categories')); ?>"
                           class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                        <!-- <div class="btn-group">
                            <?php if(Route::currentRouteName() !== 'trashed.categories.show'): ?>
                                <a href="<?php echo e(route('category.edit', $category->id)); ?>" class="btn btn-classic-warning">
                                    <i class="fas fa-edit me-2"></i>Edit Category
                                </a>
                            <?php endif; ?>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.detail-item {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

.detail-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.detail-label {
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    color: var(--classic-primary);
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 1.1rem;
    color: var(--classic-text);
    line-height: 1.6;
}

.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-active {
    background: linear-gradient(135deg, rgba(39, 174, 96, 0.2) 0%, rgba(46, 204, 113, 0.2) 100%);
    color: #27ae60;
    border: 2px solid #27ae60;
}

.status-in-active {
    background: linear-gradient(135deg, rgba(149, 165, 166, 0.2) 0%, rgba(127, 140, 141, 0.2) 100%);
    color: #7f8c8d;
    border: 2px solid #7f8c8d;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/category/show-trashed.blade.php ENDPATH**/ ?>