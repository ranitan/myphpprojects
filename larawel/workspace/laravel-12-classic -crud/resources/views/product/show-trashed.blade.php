@extends('layouts.layout')
@section('content')
<div class="content-header">
    <h1 class="page-title">
        <i class="fas fa-trash-alt me-3"></i>Trashed Product Details
    </h1>
    <p class="page-subtitle">View details of deleted product - can be restored if needed</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="alert alert-warning alert-classic mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Deleted Product:</strong> This product has been moved to trash and is not visible to customers.
            </div>
            
            <div class="card-classic trashed-product">
                <div class="card-header">
                    <h3 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--classic-primary);">
                        <i class="fas fa-info-circle me-2"></i>{{ $product->name }}
                        <span class="trashed-badge">DELETED</span>
                    </h3>
                    <small class="text-muted">Product ID: #{{ $product->id }}</small>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        @if($product->image)
                            <div class="col-md-4 mb-4">
                                <div class="product-image-container trashed-image">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         class="img-fluid product-image" 
                                         alt="{{ $product->name }}">
                                    <div class="image-overlay">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <div class="col-md-{{ $product->image ? '8' : '12' }}">
                            <div class="product-details">
                                <div class="detail-item">
                                    <div class="detail-label">
                                        <i class="fas fa-tag me-2"></i>Product Name
                                    </div>
                                    <div class="detail-value">{{ $product->name }}</div>
                                </div>

                                @if($product->description)
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-align-left me-2"></i>Description
                                        </div>
                                        <div class="detail-value">{{ $product->description }}</div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-dollar-sign me-2"></i>Price
                                            </div>
                                            <div class="detail-value price-value">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="detail-item">
                                            <div class="detail-label">
                                                <i class="fas fa-cubes me-2"></i>Quantity
                                            </div>
                                            <div class="detail-value quantity-value">
                                                {{ $product->quantity }} {{ $product->quantity == 1 ? 'unit' : 'units' }}
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
                                                    {{ $product->category->name ?? 'Uncategorized' }}
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
                                                <span class="status-badge status-{{ $product->status }}">
                                                    <i class="fas fa-{{ $product->status === 'active' ? 'check-circle' : 'pause-circle' }} me-1"></i>
                                                    {{ ucfirst($product->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($product->deleted_at)
                                    <div class="detail-item deleted-info">
                                        <div class="detail-label">
                                            <i class="fas fa-trash me-2"></i>Deleted At
                                        </div>
                                        <div class="detail-value">
                                            {{ $product->deleted_at->format('M d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                @endif

                                @if($product->created_at)
                                    <div class="detail-item">
                                        <div class="detail-label">
                                            <i class="fas fa-calendar-plus me-2"></i>Originally Created
                                        </div>
                                        <div class="detail-value">
                                            {{ $product->created_at->format('M d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('product.trashed') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Trashed Products
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-classic-success" onclick="restoreProduct('{{ $product->id }}')">
                                <i class="fas fa-undo me-2"></i>Restore Product
                            </button>
                            <button type="button" class="btn btn-classic-danger" onclick="permanentDelete('{{ $product->id }}')">
                                <i class="fas fa-times me-2"></i>Delete Permanently
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.trashed-product {
    position: relative;
    opacity: 0.9;
}

.trashed-badge {
    background: var(--classic-accent);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: 1rem;
    letter-spacing: 1px;
}

.trashed-image {
    position: relative;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(231, 76, 60, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-overlay i {
    font-size: 2rem;
    color: white;
}

.trashed-image:hover .image-overlay {
    opacity: 1;
}

.deleted-info .detail-label {
    color: var(--classic-accent);
}

.deleted-info .detail-value {
    color: var(--classic-accent);
    font-weight: 600;
}

.alert-warning {
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.1) 0%, rgba(230, 126, 34, 0.1) 100%);
    color: #f39c12;
    border-left: 4px solid #f39c12;
}

/* Inherit other styles from the regular show page */
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
</style>

<script>
function restoreProduct(productId) {
    if (confirm('Are you sure you want to restore this product?')) {
        // Add your restore logic here
        // Example: window.location.href = `/products/${productId}/restore`;
        console.log('Restoring product:', productId);
    }
}

function permanentDelete(productId) {
    if (confirm('Are you sure you want to permanently delete this product? This action cannot be undone!')) {
        // Add your permanent delete logic here
        // Example: window.location.href = `/products/${productId}/force-delete`;
        console.log('Permanently deleting product:', productId);
    }
}
</script>
@endsection