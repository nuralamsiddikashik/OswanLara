@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h5 class="d-lnline-block mt-1">{{ __('All product caregories')}}</h5>
                </div>
            </div>  

            <div class="card-body">
                <div class="btn-group mb-3">
                    <a href="{{ route('admin.product-category.index') . '?type=all' }}"
                        class="btn btn-outline-dark {{ request()->get('type') == 'all' ? 'active' : ''  }}">{{ __('All') }}</a>
                    <a href="{{ route('admin.product-category.index') }}"
                        class="btn btn-outline-dark {{ request()->has('type') ? '' : 'active'  }}">{{ __('Active') }}</a>
                    <a href="{{ route('admin.product-category.index') . '?type=trash' }}"
                        class="btn btn-outline-dark {{ request()->get('type') == 'trash' ? 'active' : ''  }}">{{ __('Trashed') }}</a>
                </div>
            </div>

            <div class="card card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td></td>
                            <td colspan="5">
                                <button id="bulk-delete" type="submit" class="btn btn-danger">{{ __('Deleted Select')}}</button>
                                <button id="bulk-force-delete" type="submit"
                                class="btn btn-danger">{{ __('Permanently Delete selected') }}</button>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
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
                            <th><input type="checkbox" class="bulk-cat-id" data-id="{{ $productCategory->id}}"></th>
                            <td>
                                @if($productCategory->thumbnail)
                                    <img height="40" src="{{ asset($productCategory->thumbnail)}}" alt="{{$productCategory->name}}">
                                @endif
                            </td>
                            <td>{{ $productCategory->name }}</td>
                            <td>{{ $productCategory->slug }}</td>
                            <td><span
                                class="badge badge-@if($productCategory->status == true){{ 'success' }} @else{{ 'warning' }} @endif">{{ $productCategory->status_text }}</span>
                            </td>

                            <td>
                                <a class="btn btn-outline-warning btn-sm" href="{{ route('admin.product-category.edit', $productCategory->id)}}"><i class="fas fa-edit"></i></a>
                               
                                @if($productCategory->deleted_at !== null)
                                    <form action="{{ route('admin.product-category.restore',$productCategory->id)}}" class="d-inline-block" method="POST">
                                        @csrf 

                                       
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa fa-history"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.product-category.force_delete',$productCategory->id)}}" class="d-inline-block" method="POST">
                                        @csrf 
                        
                                        <button title="{{ __('Permanet Delete')}}" type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa fa-trash"></i>
                                        </button>
                                    </form>
                                @else 
                                    <form action="{{ route('admin.product-category.destroy',$productCategory->id)}}" class="d-inline-block" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection

@section('scripts')
<script>
    (function($) {
        $(document).ready(function() {
            let cat_ids = []
            $(document).on('click', '.bulk-cat-id', function() {
                let data_id = $(this).data('id');
                if($(this).prop('checked')) {
                    if(!cat_ids.includes(data_id)) {
                        cat_ids.push(data_id)
                    }
                } else {
                    if(cat_ids.includes(data_id)) {
                        cat_ids = cat_ids.filter(element => element != data_id)
                    }
                }
                
                // console.log(cat_ids)
            })
            $('#bulk-delete').on('click', function() {
                if(cat_ids.length > 0) {
                    axios.post("{{ route('admin.product-category.bulk_delete') }}", {
                        cat_ids
                    })
                    .then(response => {
                        if(response.data.message == 'success') {
                            window.location.href = window.location.href
                        }
                    })
                    .catch(error => console.log(error))
                }
            })
            $('#bulk-force-delete').on('click', function() {
                if(cat_ids.length > 0) {
                    axios.post("{{ route('admin.product-category.bulk_force_delete') }}", {
                        cat_ids
                    })
                    .then(response => {
                        if(response.data.message == 'success') {
                            window.location.href = window.location.href
                        }
                    })
                    .catch(error => console.log(error))
                }
            })
        })
    })(jQuery)
</script>
@endsection