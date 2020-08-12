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
                        <label for="product_category_id">Select Category</label>
                        <select class="form-control" name="product_category_id" id="product_category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $c)
                                <option value="{{ $c->id}}" @if($product->product_category_id == $c->id) selected @endif>{{ $c->name }}</option>
                            @endforeach
                        </select>
                   </div>

                    <div class="form-group">
                        <label for="brand_id">Select Brand</label>
                        <select class="form-control" name="brand_id" id="brand_id">
                            <option value="">Select brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id}}" @if($product->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                   </div>


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
                        <label for="status">Vitual</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $product->virtual == 1 ? 'selected="selected"' : '' }} value="1">Yes
                            </option>
                            <option {{ $product->virtual == 0 ? 'selected="selected"' : '' }} value="0">No
                            </option>
                        </select>
                    </div>

                    @if($product->thumbnail)
                        <div class="form-group">
                            <img src="{{ asset($product->thumbnail)}}" alt="{{ $product->name}}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="exampleInputFile">Thumbnail</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="thumbnail">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
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