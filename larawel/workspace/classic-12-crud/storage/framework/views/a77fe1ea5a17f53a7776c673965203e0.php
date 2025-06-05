
<div class="row">
    <div class="col-md-6">
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-tag me-2"></i>Product Name *
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
                   value="<?php echo e(old('name', $product->name ?? '')); ?>"
                   placeholder="Enter product name..."
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
    </div>
    
    <div class="col-md-6">
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-list me-2"></i>Category
            </label>
            <select name="category_id" class="form-control <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <option value=""><?php echo e($product->category->name ?? 'Choose Category'); ?></option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e((old('category_id', $product->category_id ?? '') == $category->id) ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['category_id'];
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
    </div>
</div>

<div class="mb-4">
    <label class="form-label">
        <i class="fas fa-align-left me-2"></i>Description
    </label>
    <textarea name="description" 
              class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
              rows="4" 
              placeholder="Enter product description..."><?php echo e(old('description', $product->description ?? '')); ?></textarea>
    <?php $__errorArgs = ['description'];
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

<div class="row">
    <div class="col-md-4">
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-dollar-sign me-2"></i>Price *
            </label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" 
                       name="price" 
                       step="0.01" 
                       class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       value="<?php echo e(old('price', $product->price ?? '')); ?>"
                       placeholder="0.00"
                       required>
                <?php $__errorArgs = ['price'];
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
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-cubes me-2"></i>Quantity *
            </label>
            <input type="number" 
                   name="quantity" 
                   class="form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   value="<?php echo e(old('quantity', $product->quantity ?? '')); ?>"
                   placeholder="0"
                   min="0"
                   required>
            <?php $__errorArgs = ['quantity'];
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
    </div>
    
    <div class="col-md-4">
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
                <option value="active" <?php echo e((old('status', $product->status ?? '') == 'active') ? 'selected' : ''); ?>>
                    Active
                </option>
                <option value="in-active" <?php echo e((old('status', $product->status ?? '') == 'in-active') ? 'selected' : ''); ?>>
                    Inactive
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
    </div>
</div>

<div class="mb-4">
    <label class="form-label">
        <i class="fas fa-image me-2"></i>Product Image
    </label>
    <div class="image-upload-container">
        <input type="file" 
               name="image" 
               class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               accept="image/*"
               id="imageInput">
        <?php $__errorArgs = ['image'];
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
        
        <?php if(!empty($product->image)): ?>
            <div class="current-image mt-3">
                <label class="form-label text-muted">Current Image:</label>
                <div class="image-preview">
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" 
                         class="img-thumbnail" 
                         alt="Product Image"
                         style="max-width: 200px; height: auto;">
                </div>
            </div>
        <?php endif; ?>
        
        <div class="image-preview-new mt-3" id="imagePreview" style="display: none;">
            <label class="form-label text-muted">New Image Preview:</label>
            <div>
                <img id="previewImg" class="img-thumbnail" style="max-width: 200px; height: auto;">
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced styling for product form */
.input-group-text {
    background: var(--classic-light);
    border: 2px solid var(--classic-border);
    color: var(--classic-primary);
    font-weight: 600;
    border-radius: 10px 0 0 10px;
}

.input-group .form-control {
    border-left: none;
    border-radius: 0 10px 10px 0;
}

.input-group .form-control:focus {
    border-color: var(--classic-gold);
    box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
}

.image-upload-container {
    position: relative;
}

.image-preview {
    padding: 1rem;
    background: var(--classic-light);
    border-radius: 10px;
    border: 2px dashed var(--classic-border);
    text-align: center;
}

.image-preview img {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.form-control[type="file"] {
    padding: 0.5rem;
}

.form-control[type="file"]::-webkit-file-upload-button {
    background: var(--classic-primary);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    margin-right: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-control[type="file"]::-webkit-file-upload-button:hover {
    background: var(--classic-secondary);
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* Form validation enhancements */
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
</style>

<script>
// Image preview functionality
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('imagePreview').style.display = 'none';
    }
});
</script><?php /**PATH C:\Users\G2TECH\OneDrive\Desktop\files\learning\myphpprojects\larawel\workspace\classic-12-crud\resources\views/product/form.blade.php ENDPATH**/ ?>