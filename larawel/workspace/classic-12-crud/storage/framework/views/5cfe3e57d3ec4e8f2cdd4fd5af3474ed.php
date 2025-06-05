
<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">
                <i class="fas fa-trash-restore me-3"></i>Trashed Categories
            </h1>
            <p class="page-subtitle">Manage and restore deleted categories</p>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge bg-warning fs-6 me-3">
                <i class="fas fa-trash me-1"></i>
                <?php echo e($categories->total() ?? count($categories)); ?> Trashed Items
            </span>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <!-- Action Bar -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <form class="d-flex form-classic" role="search" action="<?php echo e(route('trashed.categories')); ?>" method="GET">
                <?php echo csrf_field(); ?>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border-color: var(--classic-border);">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" name="search" type="search" 
                           placeholder="Search trashed categories..." aria-label="Search" 
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
                <a href="<?php echo e(route('category.index')); ?>" class="btn btn-classic-success">
                    <i class="fas fa-arrow-left me-2"></i>Back to Categories
                </a>
                <!-- <?php if(count($categories) > 0): ?>
                <button type="button" class="btn btn-classic-warning" id="bulkRestoreBtn">
                    <i class="fas fa-undo me-2"></i>Bulk Restore
                </button>
                <?php endif; ?> -->
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
            <div class="trashed-category-card card-classic h-100">
                <div class="category-header">
                    <div class="category-icon trashed">
                        <i class="fas fa-folder-minus"></i>
                    </div>
                    <div class="category-status">
                        <span class="status-badge trashed">
                            <i class="fas fa-exclamation-circle"></i>
                        </span>
                    </div>
                </div>
                <div class="category-body">
                    <h5 class="category-name"><?php echo e($category->name); ?></h5>
                    <div class="category-meta">
                        <small class="text-muted">
                            <i class="fas fa-hashtag me-1"></i>ID: <?php echo e($category->id); ?>

                        </small>
                        <br>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>Deleted: <?php echo e($category->deleted_at ? $category->deleted_at->diffForHumans() : 'Unknown'); ?>

                        </small>
                    </div>
                    <div class="category-stats">
                        <div class="stat-item">
                            <i class="fas fa-ban text-warning me-2"></i>
                            <span>Status: <?php echo e($category->status); ?></span>
                        </div>
                    </div>
                </div>
                <div class="category-actions">
                    <div class="action-buttons d-flex justify-content-center gap-1">
                        <a href="<?php echo e(route('show.trashed.categories',$category->id)); ?>" 
                           class="btn btn-classic-success btn-sm" 
                           title="View Details" 
                           data-bs-toggle="tooltip">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="<?php echo e(route('category.restore',$category->id)); ?>" 
                              method="POST" 
                              style="display:inline-block"
                              class="restore-form">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <button type="button" 
                                    class="btn btn-classic-warning btn-sm restore-btn" 
                                    title="Restore Category" 
                                    data-bs-toggle="tooltip"
                                    data-category-name="<?php echo e($category->name); ?>">
                                <i class="fas fa-undo"></i>
                            </button>
                        </form>
                        <form action="<?php echo e(route('category.delete',$category->id)); ?>" 
                              method="POST" 
                              style="display:inline-block"
                              class="permanent-delete-form">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="button" 
                                    class="btn btn-classic-danger btn-sm permanent-delete-btn" 
                                    title="Delete Permanently" 
                                    data-bs-toggle="tooltip"
                                    data-category-name="<?php echo e($category->name); ?>">
                                <i class="fas fa-trash-alt"></i>
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
                    <i class="fas fa-table me-2"></i>Trashed Categories Overview
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
                                <input type="checkbox" id="selectAll" class="form-check-input">
                            </th>
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
                                <i class="fas fa-clock me-2"></i>Deleted At
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="trashed-category-row">
                            <td>
                                <input type="checkbox" class="form-check-input category-checkbox" value="<?php echo e($category->id); ?>">
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?php echo e($loop->iteration); ?>

                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="category-avatar trashed me-3">
                                        <i class="fas fa-folder-minus text-warning"></i>
                                    </div>
                                    <div>
                                        <strong><?php echo e($category->name); ?></strong>
                                        <br><small class="text-muted">ID: <?php echo e($category->id); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-warning">
                                    <i class="fas fa-exclamation-circle me-1"></i><?php echo e($category->status); ?>

                                </span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    <?php echo e($category->deleted_at ? $category->deleted_at->format('M d, Y') : 'Unknown'); ?>

                                    <br>
                                    <i class="fas fa-clock me-1"></i>
                                    <?php echo e($category->deleted_at ? $category->deleted_at->diffForHumans() : 'Unknown'); ?>

                                </small>
                            </td>
                            <td>
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <a href="<?php echo e(route('show.trashed.categories',$category->id)); ?>" 
                                       class="btn btn-classic-success btn-sm" 
                                       title="View Details" 
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="<?php echo e(route('category.restore',$category->id)); ?>" 
                                          method="POST" 
                                          style="display:inline-block"
                                          class="restore-form">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <button type="button" 
                                                class="btn btn-classic-warning btn-sm restore-btn" 
                                                title="Restore Category" 
                                                data-bs-toggle="tooltip"
                                                data-category-name="<?php echo e($category->name); ?>">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('category.delete',$category->id)); ?>" 
                                          method="POST" 
                                          style="display:inline-block"
                                          class="permanent-delete-form">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="button" 
                                                class="btn btn-classic-danger btn-sm permanent-delete-btn" 
                                                title="Delete Permanently" 
                                                data-bs-toggle="tooltip"
                                                data-category-name="<?php echo e($category->name); ?>">
                                            <i class="fas fa-trash-alt"></i>
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
                <i class="fas fa-trash-restore fa-4x text-muted mb-4"></i>
                <h4 class="text-muted mb-3">No Trashed Categories Found</h4>
                <p class="text-muted mb-4">Great! You don't have any deleted categories at the moment.</p>
                <a href="<?php echo e(route('category.index')); ?>" class="btn btn-classic-primary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Back to Categories
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

<!-- Custom CSS for Trashed Categories -->
<style>
.trashed-category-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 1px solid #f39c12;
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
    opacity: 0.85;
}

.trashed-category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(243, 156, 18, 0.2);
    opacity: 1;
}

.trashed-category-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #f39c12, #e67e22);
    z-index: 1;
}

.category-header {
    background: linear-gradient(135deg, #fdf2e9 0%, #fff 100%);
    padding: 1.5rem;
    position: relative;
    border-bottom: 1px solid #f39c12;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-icon.trashed {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
}

.status-badge.trashed {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    background: #e74c3c;
    color: white;
}

.category-body {
    padding: 1.5rem;
}

.category-name {
    font-family: 'Playfair Display', serif;
    font-weight: 600;
    color: #f39c12;
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.category-meta {
    margin-bottom: 1rem;
}

.category-stats {
    background: rgba(243, 156, 18, 0.1);
    padding: 0.75rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: 1px solid rgba(243, 156, 18, 0.2);
}

.stat-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: var(--classic-text);
}

.category-actions {
    padding: 1rem 1.5rem;
    background: rgba(243, 156, 18, 0.05);
    border-top: 1px solid rgba(243, 156, 18, 0.2);
}

.trashed-category-row {
    transition: all 0.3s ease;
    background: rgba(243, 156, 18, 0.02);
}

.trashed-category-row:hover {
    background: rgba(243, 156, 18, 0.1);
    transform: translateX(5px);
}

.category-avatar.trashed {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.1), rgba(243, 156, 18, 0.2));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    border: 1px solid rgba(243, 156, 18, 0.3);
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
.trashed-category-card {
    animation: slideInUp 0.6s ease-out forwards;
    opacity: 0;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 0.85;
        transform: translateY(0);
    }
}

/* Stagger animation for cards */
.trashed-category-card:nth-child(1) { animation-delay: 0.1s; }
.trashed-category-card:nth-child(2) { animation-delay: 0.2s; }
.trashed-category-card:nth-child(3) { animation-delay: 0.3s; }
.trashed-category-card:nth-child(4) { animation-delay: 0.4s; }
.trashed-category-card:nth-child(5) { animation-delay: 0.5s; }
.trashed-category-card:nth-child(6) { animation-delay: 0.6s; }
.trashed-category-card:nth-child(7) { animation-delay: 0.7s; }
.trashed-category-card:nth-child(8) { animation-delay: 0.8s; }

/* Bulk selection styles */
.form-check-input:checked {
    background-color: var(--classic-primary);
    border-color: var(--classic-primary);
}

/* Warning/Alert styling for trash context */
.alert-warning {
    background-color: #fff3cd;
    border-color: #ffeaa7;
    color: #856404;
}

.btn-classic-warning:hover {
    background-color: #e67e22;
    border-color: #d35400;
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

    // Enhanced restore confirmation
    document.querySelectorAll('.restore-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const categoryName = this.getAttribute('data-category-name');
            const form = this.closest('.restore-form');
            
            if (confirm(`Are you sure you want to restore "${categoryName}" category?\n\nThis will make it available again in the active categories.`)) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                setTimeout(() => {
                    form.submit();
                }, 500);
            }
        });
    });

    // Enhanced permanent delete confirmation
    document.querySelectorAll('.permanent-delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const categoryName = this.getAttribute('data-category-name');
            const form = this.closest('.permanent-delete-form');
            
            if (confirm(`⚠️ PERMANENT DELETE WARNING ⚠️\n\nAre you sure you want to permanently delete "${categoryName}" category?\n\n❌ This action CANNOT be undone!\n❌ All data will be lost forever!\n\nType "DELETE" to confirm this dangerous action.`)) {
                const confirmation = prompt('Type "DELETE" to confirm permanent deletion:');
                if (confirmation === 'DELETE') {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                } else {
                    alert('Deletion cancelled. The category is safe.');
                }
            }
        });
    });

    // Bulk selection functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const bulkRestoreBtn = document.getElementById('bulkRestoreBtn');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            categoryCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkRestoreButton();
        });
    }

    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateBulkRestoreButton();
            
            // Update select all checkbox
            const checkedCount = document.querySelectorAll('.category-checkbox:checked').length;
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = checkedCount === categoryCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < categoryCheckboxes.length;
            }
        });
    });

    function updateBulkRestoreButton() {
        const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
        if (bulkRestoreBtn) {
            if (checkedBoxes.length > 0) {
                bulkRestoreBtn.disabled = false;
                bulkRestoreBtn.innerHTML = `<i class="fas fa-undo me-2"></i>Restore Selected (${checkedBoxes.length})`;
            } else {
                bulkRestoreBtn.disabled = true;
                bulkRestoreBtn.innerHTML = '<i class="fas fa-undo me-2"></i>Bulk Restore';
            }
        }
    }

    // Bulk restore functionality
    if (bulkRestoreBtn) {
        bulkRestoreBtn.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
            if (checkedBoxes.length > 0) {
                if (confirm(`Are you sure you want to restore ${checkedBoxes.length} selected categories?`)) {
                    // Here you would implement the bulk restore logic
                    // For now, we'll show a message
                    alert(`Bulk restore functionality for ${checkedBoxes.length} categories would be implemented here.`);
                }
            }
        });
    }

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
    const categoryCards = document.querySelectorAll('.trashed-category-card');
    categoryCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.opacity = '1';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.opacity = '0.85';
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

/* Disabled button state */
button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/category/deleted-categories.blade.php ENDPATH**/ ?>