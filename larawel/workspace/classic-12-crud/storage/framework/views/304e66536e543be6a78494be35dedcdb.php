<div class="mb-3">
    <label class="form-label">Category Name *</label>
    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $category->name ?? '')); ?>">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-3">
    <label class="form-label">Status *</label>
    <select name="status" class="form-select">
        <option value="active" <?php echo e((old('status', $category->status ?? '') == 'active') ? 'selected' : ''); ?>>Active</option>
        <option value="in-active" <?php echo e((old('status', $category->status ?? '') == 'in-active') ? 'selected' : ''); ?>>Inactive
        </option>
    </select>
    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\laravel-12-crud\resources\views/category/form.blade.php ENDPATH**/ ?>