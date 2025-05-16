@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2>Trashed Category List</h2>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="d-flex" role="search" action="{{ route('trashed.categories')}}" method="GET">
                                @csrf
                                <input class="form-control me-2" name="search" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('category.index')}}" class="float-end btn btn-warning">View All categories</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
            <span class="alert alert-success p-2">{{Session::get('success')}}</span>
            @endif
            @if (Session::has('error'))
            <span>{{Session::get('error')}}</span>
            @endif
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($categories) > 0)
                        @foreach ( $categories as $category )
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$category->status}}</td>
                            <td><a href="{{route('show.trashed.categories',$category->id)}}" class="btn btn-success btn-sm">show</a>
                            <td>
                                <form action="{{route('category.restore',$category->id)}}" method="POST"
                                    style="display:inline-block">
                                   @csrf @method('PUT')
                                    <button onclick="return confirm('Are you sure?')"
                                        class="btn btn-sm btn-info">Restore</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route('category.delete',$category->id)}}" method="POST"
                                    style="display:inline-block">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">No Data Found !</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection