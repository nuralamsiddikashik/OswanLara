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
                <div class="bulk-action-area mb-3">
                    <div class="bulk-select d-inline-block">
                        <select name="dropdown-action" id="dropdown-action" class="form-control">
                            <option>Select action</option>
                            <option value="bulk-delete">Delete</option>
                            <option value="bulk-force-delete">Permanent Delete</option>
                            <option value="bulk-restore">Restore</option>
                        </select>
                    </div> 
                    <button id="delete-action" class="btn btn-danger">{{ __('Submit')}}</button>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width:50px;"><input type="checkbox" id="select-all"></th>
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
                            <th><input type="checkbox" class="bulk-item-id" data-id="{{ $productCategory->id}}"></th>
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
            let item_ids = []
            $(document).on('click', '.bulk-item-id', function() {
                let data_id = $(this).data('id');
                if($(this).prop('checked')) {
                    if(!item_ids.includes(data_id)) {
                        item_ids.push(data_id)
                    }
                } else {
                    if(item_ids.includes(data_id)) {
                        item_ids = item_ids.filter(element => element != data_id)
                    }
                }
                console.log(item_ids)
                
            })

            // Multi select
            $('#select-all').on('click', function() {
                if($(this).prop('checked')) {
                    $.each($('.bulk-item-id').prop('checked', 'checked'), function() {
                        data_id = $(this).data('id')
                        if(!item_ids.includes(data_id)) {
                        item_ids.push(data_id)
                    }
                    })
                    console.log(item_ids)
                } else  {
                    $('.bulk-item-id').prop('checked', '');
                    item_ids = []
                    console.log(item_ids)
                }
            })

            // Bulk action
            $('#delete-action').on('click', function() {

                if($('#dropdown-action').val() == 'bulk-delete') {
                    
                    if(item_ids.length > 0) {
                        axios.post("{{ route('admin.product-category.bulk_delete') }}", {
                            item_ids
                        })
                        .then(response => {
                            if(response.data.message == 'success') {
                                window.location.href = window.location.href
                            }
                        })
                        .catch(error => console.log(error))
                    }
                        
                } else if($('#dropdown-action').val() == 'bulk-force-delete') {
                    
                    if(item_ids.length > 0) {
                        axios.post("{{ route('admin.product-category.bulk_force_delete') }}", {
                            item_ids
                        })
                        .then(response => {
                            if(response.data.message == 'success') {
                                window.location.href = window.location.href
                            }
                        })
                        .catch(error => console.log(error))
                    }
                    
                } else if($('#dropdown-action').val() == 'bulk-restore') {
                    
                    if(item_ids.length > 0) {
                        axios.post("{{ route('admin.product-category.bulk_restore') }}", {
                            item_ids
                        })
                        .then(response => {
                            if(response.data.message == 'success') {
                                window.location.href = window.location.href
                            }
                        })
                        .catch(error => console.log(error))
                    }
                    
                }
            })
            
            
        })
    })(jQuery)
</script>
@endsection