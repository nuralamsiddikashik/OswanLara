@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.product-category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-dark">
                    <div class="card-header">
                        <h5 class="d-inline-block mt-1">{{ __('Add new category')}}</h5>
                        <a href="" class="btn btn-outline-warning float-right btn-sm">{{ __('View All')}}</a>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thumbnail</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="thumbnail">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">{{ __('Save Product Category') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 
@endsection