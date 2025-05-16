@extends("layouts.layout")
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Add New Category</h2>
        </div>
        <div class="card-body">
            <form action="{{route('category.store')}}" method="post">
                @csrf
               @include('category.form')
               <button type="submit" class="btn btn-primary">Save</button>
               <a href="{{route('category.index')}}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

</div>

@endsection