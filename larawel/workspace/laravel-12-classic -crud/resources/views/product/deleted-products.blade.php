@extends('layouts.layout')
@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">
                <i class="fas fa-trash-alt me-3"></i>Trashed Products
            </h1>
            <p class="page-subtitle">Manage your trashed products elegantly</p>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge bg-warning fs-6 me-3">
                <i class="fas fa-cubes me-1"></i>
                {{ $products->total() ?? count($products) }} Trashed Products
            </span>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <!-- Action Bar -->
    <div class="row mb-4">
        <div class="col-lg-6">
            <form class="d-flex form-classic" role="search" action="{{ route('product.trashed')}}" method="GET">
                @csrf
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border-color: var(--classic-border);">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input class="form-control border-start-0 ps-0" name="search" type="search"
                        placeholder="Search trashed products..." aria-label="Search"
                        value="{{ request('search') }}"
                        style="border-color: var(--classic-border);">
                    <button class="btn btn-classic-primary" type="submit">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('product.index')}}" class="btn btn-classic-warning">
                    <i class="fas fa-box-open me-2"></i>View All Products
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (Session::has('success'))
    <div class="alert alert-success alert-classic d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-3 fs-5"></i>
        <div>
            <strong>Success!</strong> {{Session::get('success')}}
        </div>
    </div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger alert-classic d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-triangle me-3 fs-5"></i>
        <div>
            <strong>Error!</strong> {{Session::get('error')}}
        </div>
    </div>
    @endif

    <!-- Trashed Products Table Card -->
    <div class="card-classic">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0" style="color: var(--classic-warning); font-family: 'Playfair Display', serif;">
                    <i class="fas fa-trash me-2"></i>Trashed Products List
                </h4>
                <div class="d-flex align-items-center">
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>
                        Last updated: {{ now()->format('M d, Y') }}
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
                        @if (count($products) > 0)
                        @foreach ($products as $product)
                        <tr class="product-row">
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <strong>{{ $product->name }}</strong>
                            </td>
                            <td>
                                <span class="badge rounded-pill" style="background: var(--classic-secondary); color: white;">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td>
                                {{ $product->quantity }}
                            </td>
                            <td>
                                <span class="fw-bold text-success">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-trash me-1"></i>Trashed
                                </span>
                            </td>
                            <td>
                                <div class="description-cell">
                                    {{ Str::limit($product->description, 50) }}
                                    @if(strlen($product->description) > 50)
                                        <i class="fas fa-ellipsis-h text-muted ms-1"
                                           title="{{ $product->description }}"
                                           data-bs-toggle="tooltip"></i>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <a href="{{ route('trashed.show', $product->id) }}"
                                       class="btn btn-classic-success btn-sm"
                                       title="View Details"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('product.restore', $product->id) }}" method="POST"
                                        class="delete-form" style="display:inline-block">
                                        @csrf @method('PUT')
                                        <button type="submit" 
                                        class="btn btn-classic-warning btn-sm restore-btn" 
                                                title="Restore Product" 
                                                data-bs-toggle="tooltip"
                                            onclick="return confirm('Are you sure to restore?')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                        class="delete-form" style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-classic-danger btn-sm delete-btn"
                                            title="Delete Permanently" 
                                            data-bs-toggle="tooltip"
                                            onclick="return confirm('Are you sure to delete permanently?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-trash-alt fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Trashed Products Found</h5>
                                    <p class="text-muted">Start by managing your product inventory!</p>
                                    <a href="{{ route('product.index') }}" class="btn btn-classic-primary">
                                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(method_exists($products, 'links'))
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }}
                        of {{ $products->total() ?? 0 }} results
                    </small>
                </div>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Same Enhanced JavaScript & CSS as product list page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const rows = document.querySelectorAll('.product-row');
    rows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.1}s`;
        row.classList.add('animate-row');
    });
});
</script>

<style>
.product-row {
    transition: all 0.3s ease;
}
.product-row:hover {
    background: rgba(52, 73, 94, 0.05);
    transform: translateX(5px);
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
.animate-row {
    animation: slideInLeft 0.6s ease-out forwards;
    opacity: 0;
}
@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}
</style>
@endsection
