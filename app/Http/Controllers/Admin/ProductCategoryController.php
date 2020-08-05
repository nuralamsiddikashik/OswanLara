<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller {

    public function index() {

        if ( request()->has( 'type' ) && request()->input( 'type' ) == 'trash' ) {
            $productCategories = ProductCategory::onlyTrashed()->orderBy( 'created_at', 'desc' )->paginate( 8 );
        } elseif ( request()->has( 'type' ) && request()->input( 'type' ) == 'all' ) {
            $productCategories = ProductCategory::withTrashed()->orderBy( 'created_at', 'desc' )->paginate( 8 );
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

    // Product Category Update

    public function update( ProductCategory $productCategory, Request $request ) {
        $request->validate( [
            'name' => 'required',
        ] );

        $productCategory->name        = $request->input( 'name' );
        $productCategory->description = $request->input( 'description' );
        $productCategory->status      = $request->input( 'status' );

        $uniqueSlug = Str::slug( $request->input( 'name' ) );
        $next       = 2;
        while ( ProductCategory::where( 'slug', $uniqueSlug )->first() ) {
            if ( $request->input( 'name' ) == $productCategory->name ) {
                $uniqueSlug = $productCategory->slug;
                break;
            }

            $uniqueSlug = Str::slug( $request->input( 'name' ) ) . '-' . $next;
            $next++;
        }
        $productCategory->slug = $uniqueSlug;

        if ( $request->has( 'thumbnail' ) ) {
            if ( $productCategory->thumbnail ) {
                File::delete( $productCategory->thumbnail );
            }

            $thumbnail     = $request->file( 'thumbnail' );
            $path          = 'uploads/images/product-categories';
            $thumbnailName = time() . '_' . rand( 100, 999 ) . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move( public_path( $path ), $thumbnailName );
            $productCategory->thumbnail = $thumbnailName;
        }

        if ( $productCategory->save() ) {
            return redirect()->route( 'admin.product-category.edit', $productCategory->id )->with( 'success', __( 'Product category updated.' ) );
        }
        return redirect()->back()->with( 'error', __( 'Please try again.' ) );
    }

    public function destroy( ProductCategory $productCategory ) {
        if ( $productCategory->delete() ) {
            return redirect()->route( 'admin.product-category.index' )->with( 'success', __( 'Product category delete' ) );
        }
        return redirect()->back()->with( 'error', __( 'Please try again' ) );
    }

    public function restore( $id ) {

        $productCategory = ProductCategory::onlyTrashed()->find( $id );

        if ( $productCategory ) {

            if ( $productCategory->restore() ) {
                return redirect()->route( 'admin.product-category.index' )->with( 'success', __( 'Product Category Restore' ) );
            }
            return redirect()->back()->with( 'error', __( 'Please try again' ) );

        }

        return redirect()->back()->with( 'error', __( 'No product to restore' ) );
    }

    public function forceDelete( $id ) {
        $productCategory = ProductCategory::onlyTrashed()->find( $id );

        if ( $productCategory ) {

            if ( $productCategory->thumbnail ) {
                File::delete( $productCategory->thumbnail );
            }

            if ( $productCategory->forceDelete() ) {
                return redirect()->route( 'admin.product-category.index' )->with( 'success', __( 'Product category permanently delete' ) );
            }
            return redirect()->back()->with( 'error', __( 'Please try again' ) );
        }

        return redirect()->back()->with( 'error', __( 'No product to delete' ) );
    }

    public function bulk_delete( Request $request ) {
        $item_ids = $request->input( 'item_ids' );
        foreach ( $item_ids as $id ) {
            $productCategory = ProductCategory::find( $id );
            if ( $productCategory ) {
                $productCategory->delete();
            }
        }
        return response()->json( [
            'message' => 'success',
        ] );
    }

    public function bulk_force_delete( Request $request ) {
        $item_ids = $request->input( 'item_ids' );
        foreach ( $item_ids as $id ) {
            $productCategory = ProductCategory::withTrashed()->find( $id );
            if ( $productCategory ) {
                if ( $productCategory->thumbnail ) {
                    File::delete( $productCategory->thumbnail );
                }
                $productCategory->forceDelete();
            }
        }
        return response()->json( [
            'message' => 'success',
        ] );
    }

    public function bulk_restore( Request $request ) {
        $item_ids = $request->input( 'item_ids' );
        foreach ( $item_ids as $id ) {
            $productCategory = ProductCategory::withTrashed()->find( $id );
            if ( $productCategory ) {
                $productCategory->restore();
            }
        }
        return response()->json( [
            'message' => 'success',
        ] );
    }
}
