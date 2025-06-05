
<div class="mb-4">
    <label class="form-label">
        <i class="fas fa-tag me-2"></i>Category Name *
    </label>
    <input type="text" 
           name="name" 
           class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
           value="<?php echo e(old('name', $category->name ?? '')); ?>"
           placeholder="Enter category name..."
           required>
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-4">
    <label class="form-label">
        <i class="fas fa-toggle-on me-2"></i>Status *
    </label>
    <select name="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
        <option value="">Select Status</option>
        <option value="active" <?php echo e((old('status', $category->status ?? '') == 'active') ? 'selected' : ''); ?>>
            <i class="fas fa-check-circle"></i> Active
        </option>
        <option value="in-active" <?php echo e((old('status', $category->status ?? '') == 'in-active') ? 'selected' : ''); ?>>
            <i class="fas fa-pause-circle"></i> Inactive
        </option>
    </select>
    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <i class="fas fa-exclamation-circle me-1"></i><?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<style>
/* Additional form styling for better integration */
.form-classic .form-control.is-invalid {
    border-color: var(--classic-accent);
    box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.25);
}

.form-classic .invalid-feedback {
    display: block;
    color: var(--classic-accent);
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 500;
}

.form-classic .form-control::placeholder {
    color: #adb5bd;
    font-style: italic;
}

.btn-outline-secondary {
    border: 2px solid var(--classic-border);
    color: var(--classic-secondary);
    background: transparent;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background: var(--classic-secondary);
    border-color: var(--classic-secondary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(52, 73, 94, 0.3);
}
</style><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/category/form.blade.php ENDPATH**/ ?>