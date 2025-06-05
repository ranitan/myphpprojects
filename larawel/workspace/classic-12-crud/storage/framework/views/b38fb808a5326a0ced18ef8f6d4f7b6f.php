
<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">
                <i class="fas fa-box-open me-3"></i>Product Management
            </h1>
            <p class="page-subtitle">Manage your inventory with elegance and precision</p>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge bg-primary fs-6 me-3">
                <i class="fas fa-cubes me-1"></i>
                <?php echo e($products->total() ?? count($products)); ?> Products
            </span>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <!-- Action Bar -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <form class="d-flex form-classic" role="search" action="<?php echo e(route('product.index')); ?>" method="GET">
                <?php echo csrf_field(); ?>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border-color: var(--classic-border);">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" name="search" type="search" 
                           placeholder="Search products..." aria-label="Search" 
                           value="<?php echo e(request('search')); ?>"
                           style="border-color: var(--classic-border);">
                    <button class="btn btn-classic-primary" type="submit">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="d-flex justify-content-end gap-2">
                <a href="<?php echo e(route('product.trashed')); ?>" class="btn btn-classic-warning">
                    <i class="fas fa-trash-alt me-2"></i>View Trashed
                </a>
                <a href="<?php echo e(route('product.create')); ?>" class="btn btn-classic-success">
                    <i class="fas fa-plus me-2"></i>Add New Product
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if(Session::has('success')): ?>
    <div class="alert alert-success alert-classic d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-3 fs-5"></i>
        <div>
            <strong>Success!</strong> <?php echo e(Session::get('success')); ?>

        </div>
    </div>
    <?php endif; ?>

    <?php if(Session::has('error')): ?>
    <div class="alert alert-danger alert-classic d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-triangle me-3 fs-5"></i>
        <div>
            <strong>Error!</strong> <?php echo e(Session::get('error')); ?>

        </div>
    </div>
    <?php endif; ?>

    <!-- Products Table Card -->
    <div class="card-classic">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0" style="color: var(--classic-primary); font-family: 'Playfair Display', serif;">
                    <i class="fas fa-list me-2"></i>Products Inventory
                </h4>
                <div class="d-flex align-items-center">
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        Last updated: <?php echo e(now()->format('M d, Y')); ?>

                    </small>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-classic mb-0">
                    <thead>
                        <tr>
                            <th scope="col">
                                <i class="fas fa-hashtag me-2"></i>#
                            </th>
                            <th scope="col">
                                <i class="fas fa-tag me-2"></i>Product Name
                            </th>
                            <th scope="col">
                                <i class="fas fa-folder me-2"></i>Category
                            </th>
                            <th scope="col">
                                <i class="fas fa-boxes me-2"></i>Quantity
                            </th>
                            <th scope="col">
                                <i class="fas fa-dollar-sign me-2"></i>Price
                            </th>
                            <th scope="col">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="fas fa-align-left me-2"></i>Description
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($products) > 0): ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="product-row">
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?php echo e($loop->iteration); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-avatar me-3">
                                        <i class="fas fa-cube text-primary"></i>
                                    </div>
                                    <div>
                                        <strong><?php echo e($product->name); ?></strong>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill" style="background: var(--classic-secondary); color: white;">
                                    <i class="fas fa-tag me-1"></i>
                                    <?php echo e($product->category->name); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if($product->quantity > 10): ?>
                                        <span class="badge bg-success"><?php echo e($product->quantity); ?></span>
                                    <?php elseif($product->quantity > 5): ?>
                                        <span class="badge bg-warning"><?php echo e($product->quantity); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><?php echo e($product->quantity); ?></span>
                                    <?php endif; ?>
                                    <small class="text-muted ms-2">units</small>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-success">
                                    $<?php echo e(number_format($product->price, 2)); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($product->status == 'active' || $product->status == 'Active'): ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-pause-circle me-1"></i><?php echo e($product->status); ?>

                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="description-cell">
                                    <?php echo e(Str::limit($product->description, 50)); ?>

                                    <?php if(strlen($product->description) > 50): ?>
                                        <i class="fas fa-ellipsis-h text-muted ms-1" 
                                           title="<?php echo e($product->description); ?>" 
                                           data-bs-toggle="tooltip"></i>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <a href="<?php echo e(route('product.show',$product->id)); ?>" 
                                       class="btn btn-classic-success btn-sm" 
                                       title="View Details" 
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('product.edit',$product->id)); ?>" 
                                       class="btn btn-classic-warning btn-sm" 
                                       title="Edit Product" 
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('product.destroy', $product->id)); ?>" 
                                          method="POST" 
                                          style="display:inline-block"
                                          class="delete-form">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="button" 
                                                class="btn btn-classic-danger btn-sm delete-btn" 
                                                title="Move to Trash" 
                                                data-bs-toggle="tooltip"
                                                data-product-name="<?php echo e($product->name); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Products Found</h5>
                                    <p class="text-muted">Get started by adding your first product!</p>
                                    <a href="<?php echo e(route('product.create')); ?>" class="btn btn-classic-primary">
                                        <i class="fas fa-plus me-2"></i>Add Your First Product
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <?php if(method_exists($products, 'links')): ?>
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing <?php echo e($products->firstItem() ?? 0); ?> to <?php echo e($products->lastItem() ?? 0); ?> 
                        of <?php echo e($products->total() ?? 0); ?> results
                    </small>
                </div>
                <div>
                    <?php echo e($products->links()); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Custom CSS for this page -->
<style>
.product-row {
    transition: all 0.3s ease;
}

.product-row:hover {
    background: rgba(52, 73, 94, 0.05);
    transform: translateX(5px);
}

.product-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(52, 73, 94, 0.1), rgba(52, 73, 94, 0.2));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.action-buttons .btn {
    transition: all 0.3s ease;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
}

.description-cell {
    max-width: 200px;
    line-height: 1.4;
}

.empty-state {
    padding: 2rem;
}

.empty-state i {
    opacity: 0.6;
}

.input-group .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
    border-color: var(--classic-gold);
}

.input-group-text {
    transition: all 0.3s ease;
}

.input-group .form-control:focus + .input-group-text {
    border-color: var(--classic-gold);
}

/* Custom pagination styling */
.pagination .page-link {
    color: var(--classic-primary);
    border: 1px solid var(--classic-border);
    padding: 0.5rem 0.75rem;
    margin: 0 2px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background-color: var(--classic-gold);
    border-color: var(--classic-gold);
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: var(--classic-primary);
    border-color: var(--classic-primary);
}

/* Badge animations */
.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
}
</style>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Enhanced delete confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productName = this.getAttribute('data-product-name');
            const form = this.closest('.delete-form');
            
            // Create custom confirmation dialog
            if (confirm(`Are you sure you want to move "${productName}" to trash?\n\nThis action can be undone from the trash section.`)) {
                // Add loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                // Submit form after short delay for better UX
                setTimeout(() => {
                    form.submit();
                }, 500);
            }
        });
    });

    // Add search enhancement
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.parentElement.classList.add('search-active');
            } else {
                this.parentElement.classList.remove('search-active');
            }
        });
    }

    // Add subtle animations to table rows
    const rows = document.querySelectorAll('.product-row');
    rows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.1}s`;
        row.classList.add('animate-row');
    });
});
</script>

<style>
.search-active {
    box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.15) !important;
}

.animate-row {
    animation: slideInLeft 0.6s ease-out forwards;
    opacity: 0;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Loading spinner animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spinner {
    animation: spin 1s linear infinite;
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/product/product-list.blade.php ENDPATH**/ ?>