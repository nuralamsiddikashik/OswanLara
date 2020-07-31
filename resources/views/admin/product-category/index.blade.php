@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h5 class="d-lnline-block mt-1">{{ __('All product caregories')}}</h5>
                </div>
            </div>

            <div class=" card card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productCategories as $productCategory)
                        <tr>
                            <td>
                                @if($productCategory->thumbnail)
                                    <img height="40" src="{{ asset($productCategory->thumbnail)}}" alt="{{$productCategory->name}}">
                                @endif
                            </td>
                            <td>{{ $productCategory->name }}</td>
                            <td>{{ $productCategory->slug }}</td>
                            <td>{{ $productCategory->status }}</td>
                            <td>Delete</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection