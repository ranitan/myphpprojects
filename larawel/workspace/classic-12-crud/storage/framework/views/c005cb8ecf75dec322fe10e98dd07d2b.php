
<?php $__env->startSection('content'); ?>
<div class="content-header">
    <h1 class="page-title">
        <i class="fas fa-eye me-3"></i>Product Details
    </h1>
    <p class="page-subtitle">View complete product information and specifications</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-classic">
                <div class="card-header">
                    <h3 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--classic-primary);">
                        <i class="fas fa-info-circle me-2"></i><?php echo e($product->name); ?>

                    </h3>
                    <small class="text-muted">Product ID: #<?php echo e($product->id); ?></small>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <?php if($product->image): ?>
                            <div class="col-md-4 mb-4">
                                <div class="product-image-container">
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" 
                                         class="img-fluid product-image" 
                                         alt="<?php echo e($product->name); ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="col-md-<?php echo e($product->image ? '8' : '12'); ?>">
                            <div class="product-details">
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-tag me-2"></i>Product Name
                                    </div>
                                    <div class="detail-value"><?php echo e($product->name); ?></div>
                                </div>

                                <?php if($product->description): ?>
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-align-left me-2"></i>Description
                                        </div>
                                        <div class="detail-value"><?php echo e($product->description); ?></div>
                                    </div>
                                <?php endif; ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-dollar-sign me-2"></i>Price
                                            </div>
                                            <div class="detail-value price-value">
                                                $<?php echo e(number_format($product->price, 2)); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-cubes me-2"></i>Quantity
                                            </div>
                                            <div class="detail-value quantity-value">
                                                <?php echo e($product->quantity); ?> <?php echo e($product->quantity == 1 ? 'unit' : 'units'); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-list me-2"></i>Category
                                            </div>
                                            <div class="detail-value">
                                                <span class="category-badge">
                                                    <?php echo e($product->category->name ?? 'Uncategorized'); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-toggle-on me-2"></i>Status
                                            </div>
                                            <div class="detail-value">
                                                <span class="status-badge status-<?php echo e($product->status); ?>">
                                                    <i class="fas fa-<?php echo e($product->status === 'active' ? 'check-circle' : 'pause-circle'); ?> me-1"></i>
                                                    <?php echo e(ucfirst($product->status)); ?>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if($product->created_at): ?>
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-calendar-plus me-2"></i>Created
                                        </div>
                                        <div class="detail-value">
                                            <?php echo e($product->created_at->format('M d, Y \a\t g:i A')); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($product->updated_at && $product->updated_at != $product->created_at): ?>
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-calendar-edit me-2"></i>Last Updated
                                        </div>
                                        <div class="detail-value">
                                            <?php echo e($product->updated_at->format('M d, Y \a\t g:i A')); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?php echo e(route('product.index')); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Products
                        </a>
                        <div class="btn-group">
                            <a href="<?php echo e(route('product.edit', $product->id)); ?>" class="btn btn-classic-warning">
                                <i class="fas fa-edit me-2"></i>Edit Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    background: var(--classic-light);
    padding: 1rem;
}

.product-image {
    width: 100%;
    height: auto;
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
}

.product-details {
    height: 100%;
}

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

.price-value {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 1.5rem;
    color: var(--classic-gold);
}

.quantity-value {
    font-weight: 600;
    color: var(--classic-secondary);
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

.category-badge {
    background: linear-gradient(135deg, var(--classic-primary) 0%, var(--classic-secondary) 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}

.card-footer {
    border-top: 2px solid var(--classic-border);
    background: linear-gradient(135deg, var(--classic-light) 0%, #fff 100%) !important;
}

@media (max-width: 768px) {
    .product-image-container {
        margin-bottom: 2rem;
    }
    
    .detail-item {
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
    }
    
    .price-value {
        font-size: 1.3rem;
    }
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/product/show.blade.php ENDPATH**/ ?>