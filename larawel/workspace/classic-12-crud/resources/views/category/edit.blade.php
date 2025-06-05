@extends('layouts.layout')
@section('content')
<div class="content-header">
    <h1 class="page-title">
        <i class="fas fa-edit me-3"></i>Edit Category
    </h1>
    <p class="page-subtitle">Update category information and settings</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-classic">
                <div class="card-header">
                    <h3 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--classic-primary);">
                        <i class="fas fa-tag me-2"></i>Category Information
                    </h3>
                    <small class="text-muted">Modify the details below to update this category</small>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('category.update',$id)}}" method="post" class="form-classic">
                        @csrf
                       
                        @include('category.form')
                        
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3" style="border-top: 1px solid var(--classic-border);">
                            <a href="{{ route('category.index')}}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Categories
                            </a>
                            <div class="btn-group">
                                <button type="submit" class="btn btn-classic-warning">
                                    <i class="fas fa-sync-alt me-2"></i>Update Category
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