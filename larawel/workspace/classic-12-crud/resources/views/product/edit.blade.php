@extends('layouts.layout')
@section('content')
<div class="content-header">
    <h1 class="page-title">
        <i class="fas fa-edit me-3"></i>Edit Product
    </h1>
    <p class="page-subtitle">Update product information and settings</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card-classic">
                <div class="card-header">
                    <h3 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--classic-primary);">
                        <i class="fas fa-box me-2"></i>Product Information
                    </h3>
                    <small class="text-muted">Modify the details below to update this product</small>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('product.update',$id)}}" method="post" enctype="multipart/form-data" class="form-classic">
                        @csrf
                       
                        @include('product.form')
                        
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid var(--classic-border);">
                            <a href="{{ route('product.index')}}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Products
                            </a>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-classic-warning">
                                    <i class="fas fa-sync-alt me-2"></i>Update Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection