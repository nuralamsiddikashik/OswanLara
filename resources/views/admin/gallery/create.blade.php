@extends('layouts.admin')

@section('meta-title', __('Gallery'))

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.gallery.store', $product_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="images">Add Images</label>
                    </br>
                        <input type="file" name="images[]" id="images" multiple>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
                {{-- {{ dd($id)}} --}}
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if(count($galleries) > 0)
                    <div class="row">
                        @foreach($galleries as $gallery)
                            <div class="col-md-3">
                                <img class="img-fluid" src="{{ asset($gallery)}}">
                            </div>
                        @endforeach 
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection