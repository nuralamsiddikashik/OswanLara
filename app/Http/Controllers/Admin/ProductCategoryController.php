<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller {
    public function index() {
        
        if ( request()->has( 'type' ) && request()->input( 'type' ) == 'trash' ) {
            $productCategories = ProductCategory::onlyTrashed()->orderBy( 'created_at', 'desc' )->paginate( 8 );
        } else {
            $productCategories = ProductCategory::orderBy( 'created_at', 'desc' )->paginate( 8 );
        }
        return view( 'admin.product-category.index', compact( 'productCategories' ) );
    }

    public function create() {
        return view( 'admin.product-category.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required',
        ] );

        $productCategory              = new ProductCategory();
        $productCategory->name        = $request->input( 'name' );
        $productCategory->description = $request->input( 'description' );

        // Slug Generation

        $uniqueSlug = Str::slug( $request->input( 'name' ) );
        $next       = 2;
        while ( ProductCategory::where( 'slug', $uniqueSlug )->first() ) {
            $uniqueSlug = Str::slug( $request->input( 'name' ) ) . '-' . $next;
            $next++;
        }

        $productCategory->slug = $uniqueSlug;

        if ( $request->has( 'thumbnail' ) ) {
            $thumbnail     = $request->file( 'thumbnail' );
            $path          = 'uploads/images/product-categories';
            $thumbnailName = time() . '_' . rand( 100, 999 ) . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move( public_path( $path ), $thumbnailName );
            $productCategory->thumbnail = $thumbnailName;
        }

        if ( $productCategory->save() ) {
            return redirect()->route( 'admin.product-category.edit', $productCategory->id )->with( 'success', __( 'Product Category Add' ) );
        }
        return redirect()->back()->with( 'error', __( 'Please try again.' ) );
    }

    public function edit( ProductCategory $productCategory ) {
        return view( 'admin.product-category.edit', compact( 'productCategory' ) );
    }
}