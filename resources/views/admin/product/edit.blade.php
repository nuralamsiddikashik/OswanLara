@extends('layouts.admin')

@section('meta-title', __('Edit brand'))

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card card-dark">
                <div class="card-header">
                    <h5 class="d-inline-block mt-1">{{ __('Edit Product') }}</h5>
                    <a href="{{ route('admin.product.index') }}"
                        class="btn btn-outline-warning float-right btn-sm">{{ __('View All') }}</a>
                </div>
                <div class="card-body">
                   
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="form-control" type="title" name="title" id="title" value="{{$product->title}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" type="text" name="description" id="description" value="{{$product->description}}">
                    </div>
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <input class="form-control" type="text" name="short_description" id="short_description" value="{{$product->short_description}}">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input class="form-control" type="text" name="price" id="price" value="{{$product->price}}">
                    </div>

                    <div class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input class="form-control" type="text" name="selling_price" id="selling_price" value="{{$product->selling_price}}">
                    </div>

                    <div class="form-group">
                        <label for="qty">QTY</label>
                        <input class="form-control" type="text" name="qty" id="qty" value="{{$product->qty}}">
                    </div>

                    <div class="form-group">
                        <label for="sku">Sku</label>
                        <input class="form-control" type="text" name="sku" id="sku" value="{{$product->sku}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">{{ __('Update Product') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection