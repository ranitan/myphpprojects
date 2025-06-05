
<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">
                <i class="fas fa-sitemap me-3"></i>Category Management
            </h1>
            <p class="page-subtitle">Organize your products with structured categories</p>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge bg-primary fs-6 me-3">
                <i class="fas fa-tags me-1"></i>
                <?php echo e($categories->total() ?? count($categories)); ?> Categories
            </span>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <!-- Action Bar -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <form class="d-flex form-classic" role="search" action="<?php echo e(route('category.index')); ?>" method="GET">
                <?php echo csrf_field(); ?>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border-color: var(--classic-border);">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" name="search" type="search" 
                           placeholder="Search categories..." aria-label="Search" 
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
                <a href="<?php echo e(route('trashed.categories')); ?>" class="btn btn-classic-warning">
                    <i class="fas fa-trash-alt me-2"></i>View Trashed
                </a>
                <a href="<?php echo e(route('category.create')); ?>" class="btn btn-classic-success">
                    <i class="fas fa-plus me-2"></i>Add New Category
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

    <!-- Categories Display -->
    <?php if(count($categories) > 0): ?>
    <!-- Categories Grid View -->
    <div class="row mb-4">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="category-card card-classic h-100">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <div class="category-status">
                        <?php if($category->status == 'active' || $category->status == 'Active'): ?>
                            <span class="status-badge active">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php else: ?>
                            <span class="status-badge inactive">
                                <i class="fas fa-pause-circle"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="category-body">
                    <h5 class="category-name"><?php echo e($category->name); ?></h5>
                    <div class="category-meta">
                        <small class="text-muted">
                            <i class="fas fa-hashtag me-1"></i>ID: <?php echo e($category->id); ?>

                        </small>
                    </div>
                    <div class="category-stats">
                        <div class="stat-item">
                            <i class="fas fa-box text-primary me-2"></i>
                            <span><?php echo e($category->products_count ?? 0); ?> Products</span>
                        </div>
                    </div>
                </div>
                <div class="category-actions">
                    <div class="action-buttons d-flex justify-content-center gap-1">
                        <a href="<?php echo e(route('category.show',$category->id)); ?>" 
                           class="btn btn-classic-success btn-sm" 
                           title="View Details" 
                           data-bs-toggle="tooltip">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?php echo e(route('category.edit',$category->id)); ?>" 
                           class="btn btn-classic-warning btn-sm" 
                           title="Edit Category" 
                           data-bs-toggle="tooltip">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('category.destroy',$category->id)); ?>" 
                              method="POST" 
                              style="display:inline-block"
                              class="delete-form">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="button" 
                                    class="btn btn-classic-danger btn-sm delete-btn" 
                                    title="Move to Trash" 
                                    data-bs-toggle="tooltip"
                                    data-category-name="<?php echo e($category->name); ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Table View Toggle -->
    <div class="d-flex justify-content-end mb-3">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-secondary active" id="gridView">
                <i class="fas fa-th me-1"></i>Grid
            </button>
            <button type="button" class="btn btn-outline-secondary" id="tableView">
                <i class="fas fa-list me-1"></i>Table
            </button>
        </div>
    </div>

    <!-- Categories Table (Initially Hidden) -->
    <div class="card-classic" id="categoriesTable" style="display: none;">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0" style="color: var(--classic-primary); font-family: 'Playfair Display', serif;">
                    <i class="fas fa-table me-2"></i>Categories Overview
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
                                <i class="fas fa-tag me-2"></i>Category Name
                            </th>
                            <th scope="col">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </th>
                            <th scope="col">
                                <i class="fas fa-box me-2"></i>Products
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="category-row">
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?php echo e($loop->iteration); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="category-avatar me-3">
                                        <i class="fas fa-folder text-primary"></i>
                                    </div>
                                    <div>
                                        <strong><?php echo e($category->name); ?></strong>
                                        <br><small class="text-muted">ID: <?php echo e($category->id); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($category->status == 'active' || $category->status == 'Active'): ?>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-pause-circle me-1"></i><?php echo e($category->status); ?>

                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <i class="fas fa-box me-1"></i>
                                    <?php echo e($category->products_count ?? 0); ?>

                                </span>
                            </td>
                            <td>
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <a href="<?php echo e(route('category.show',$category->id)); ?>" 
                                       class="btn btn-classic-success btn-sm" 
                                       title="View Details" 
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('category.edit',$category->id)); ?>" 
                                       class="btn btn-classic-warning btn-sm" 
                                       title="Edit Category" 
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('category.destroy',$category->id)); ?>" 
                                          method="POST" 
                                          style="display:inline-block"
                                          class="delete-form">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="button" 
                                                class="btn btn-classic-danger btn-sm delete-btn" 
                                                title="Move to Trash" 
                                                data-bs-toggle="tooltip"
                                                data-category-name="<?php echo e($category->name); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php else: ?>
    <!-- Empty State -->
    <div class="card-classic">
        <div class="card-body text-center py-5">
            <div class="empty-state">
                <i class="fas fa-folder-plus fa-4x text-muted mb-4"></i>
                <h4 class="text-muted mb-3">No Categories Found</h4>
                <p class="text-muted mb-4">Start organizing your products by creating your first category!</p>
                <a href="<?php echo e(route('category.create')); ?>" class="btn btn-classic-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Create Your First Category
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Pagination -->
    <?php if(method_exists($categories, 'links') && count($categories) > 0): ?>
    <div class="d-flex justify-content-center mt-4">
        <div class="pagination-wrapper">
            <?php echo e($categories->links()); ?>

        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Custom CSS for Categories -->
<style>
.category-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 1px solid var(--classic-border);
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
}

.category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.category-header {
    background: linear-gradient(135deg, var(--classic-light) 0%, #fff 100%);
    padding: 1.5rem;
    position: relative;
    border-bottom: 1px solid var(--classic-border);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--classic-primary), var(--classic-secondary));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
}

.status-badge {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.status-badge.active {
    background: #27ae60;
    color: white;
}

.status-badge.inactive {
    background: #95a5a6;
    color: white;
}

.category-body {
    padding: 1.5rem;
}

.category-name {
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    color: var(--classic-primary);
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.category-meta {
    margin-bottom: 1rem;
}

.category-stats {
    background: rgba(52, 73, 94, 0.05);
    padding: 0.75rem;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: var(--classic-text);
}

.category-actions {
    padding: 1rem 1.5rem;
    background: rgba(52, 73, 94, 0.02);
    border-top: 1px solid var(--classic-border);
}

.category-row {
    transition: all 0.3s ease;
}

.category-row:hover {
    background: rgba(52, 73, 94, 0.05);
    transform: translateX(5px);
}

.category-avatar {
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

.empty-state {
    padding: 3rem 2rem;
}

.empty-state i {
    opacity: 0.6;
}

.btn-group .btn {
    transition: all 0.3s ease;
}

.btn-group .btn.active {
    background: var(--classic-primary);
    border-color: var(--classic-primary);
    color: white;
}

.pagination-wrapper .pagination .page-link {
    color: var(--classic-primary);
    border: 1px solid var(--classic-border);
    padding: 0.5rem 0.75rem;
    margin: 0 2px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.pagination-wrapper .pagination .page-link:hover {
    background-color: var(--classic-gold);
    border-color: var(--classic-gold);
    color: white;
}

.pagination-wrapper .pagination .page-item.active .page-link {
    background-color: var(--classic-primary);
    border-color: var(--classic-primary);
}

/* Card entrance animation */
.category-card {
    animation: slideInUp 0.6s ease-out forwards;
    opacity: 0;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Stagger animation for cards */
.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }
.category-card:nth-child(5) { animation-delay: 0.5s; }
.category-card:nth-child(6) { animation-delay: 0.6s; }
.category-card:nth-child(7) { animation-delay: 0.7s; }
.category-card:nth-child(8) { animation-delay: 0.8s; }
</style>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // View toggle functionality
    const gridViewBtn = document.getElementById('gridView');
    const tableViewBtn = document.getElementById('tableView');
    const categoriesGrid = document.querySelector('.row');
    const categoriesTable = document.getElementById('categoriesTable');

    if (gridViewBtn && tableViewBtn) {
        gridViewBtn.addEventListener('click', function() {
            this.classList.add('active');
            tableViewBtn.classList.remove('active');
            categoriesGrid.style.display = 'flex';
            categoriesTable.style.display = 'none';
        });

        tableViewBtn.addEventListener('click', function() {
            this.classList.add('active');
            gridViewBtn.classList.remove('active');
            categoriesGrid.style.display = 'none';
            categoriesTable.style.display = 'block';
        });
    }

    // Enhanced delete confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const categoryName = this.getAttribute('data-category-name');
            const form = this.closest('.delete-form');
            
            // Create custom confirmation dialog
            if (confirm(`Are you sure you want to move "${categoryName}" category to trash?\n\nThis action can be undone from the trash section.`)) {
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

    // Add hover effect to category cards
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>

<style>
.search-active {
    box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.15) !important;
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
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/category/category-list.blade.php ENDPATH**/ ?>