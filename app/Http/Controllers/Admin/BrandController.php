<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller {
    public function index() {

        if ( request()->has( 'type' ) && request()->input( 'type' ) == 'trash' ) {
            $brands = Brand::onlyTrashed()->orderBy( 'created_at', 'desc' )->paginate( 8 );
        } elseif ( request()->has( 'type' ) && request()->input( 'type' ) == 'all' ) {
            $brands = Brand::withTrashed()->orderBy( 'created_at', 'desc' )->paginate( 8 );
        } else {
            $brands = Brand::orderBy( 'created_at', 'desc' )->paginate( 8 );
        }

        return view( 'admin.brand.index', compact( 'brands' ) );
    }

    public function create() {
        return view( 'admin.brand.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name' => 'required',
        ] );

        $brand              = new Brand();
        $brand->name        = $request->input( 'name' );
        $brand->description = $request->input( 'description' );

        // Slug generation
        $uniqueSlug = Str::slug( $request->input( 'name' ) );
        $next       = 2;
        while ( Brand::where( 'slug', $uniqueSlug )->first() ) {
            $uniqueSlug = Str::slug( $request->input( 'name' ) ) . '-' . $next;
            $next++;
        }
        $brand->slug = $uniqueSlug;

        // Thumbnail upload
        if ( $request->has( 'thumbnail' ) ) {
            $thumbnail     = $request->file( 'thumbnail' );
            $path          = 'uploads/images/product-brands';
            $thumbnailName = time() . '_' . rand( 100, 999 ) . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move( public_path( $path ), $thumbnailName );
            $brand->thumbnail = $thumbnailName;
        }

        if ( $brand->save() ) {
            return redirect()->route( 'admin.brand.edit', $brand->id )->with( 'success', __( 'Product brand added.' ) );
        }
        return redirect()->back()->with( 'error', __( 'Please try again.' ) );
    }

    public function edit( Request $request, Brand $brand ) {
        return view( 'admin.brand.edit', compact( 'brand' ) );
    }

    public function update( Request $request, Brand $brand ) {

        $request->validate( [
            'name' => 'required',
        ] );

        $brand->name        = $request->input( 'name' );
        $brand->description = $request->input( 'description' );

        // Slug generation
        $uniqueSlug = Str::slug( $request->input( 'name' ) );
        $next       = 2;
        while ( Brand::where( 'slug', $uniqueSlug )->first() ) {
            if ( $brand->name == $request->input( 'name' ) ) {
                $uniqueSlug = $brand->slug;
                break;
            }
            $uniqueSlug = Str::slug( $request->input( 'name' ) ) . '-' . $next;
            $next++;
        }
        $brand->slug = $uniqueSlug;

        // Thumbnail upload
        if ( $request->has( 'thumbnail' ) ) {
            if ( $brand->thumbnail ) {
                File::delete( $brand->thumbnail );
            }
            $thumbnail     = $request->file( 'thumbnail' );
            $path          = 'uploads/images/product-brands';
            $thumbnailName = time() . '_' . rand( 100, 999 ) . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move( public_path( $path ), $thumbnailName );
            $brand->thumbnail = $thumbnailName;
        }

        if ( $brand->save() ) {
            return redirect()->route( 'admin.brand.edit', $brand->id )->with( 'success', __( 'Product brand added.' ) );
        }
        return redirect()->back()->with( 'error', __( 'Please try again.' ) );
    }

    public function destroy( Brand $brand ) {
        if ( $brand->delete() ) {
            return redirect()->back()->with( 'success', __( 'Product brand deleted.' ) );
        }

        return redirect()->back()->with( 'error', __( 'Please try again.' ) );
    }

    public function restore( $id ) {
        $brand = Brand::onlyTrashed()->find( $id );
        if ( $brand ) {
            if ( $brand->restore() ) {
                return redirect()->back()->with( 'success', __( 'Brand restored.' ) );
            }
            return redirect()->back()->with( 'error', __( 'Please try again.' ) );
        }
        return redirect()->back()->with( 'error', __( 'No brand to restore.' ) );
    }

    public function force_delete( $id ) {
        $brand = Brand::onlyTrashed()->find( $id );
        if ( $brand ) {
            if ( $brand->thumbnail ) {
                File::delete( $brand->thumbnail );
            }

            if ( $brand->forceDelete() ) {
                return redirect()->back()->with( 'success', __( 'Brand permanently deleted.' ) );
            }
            return redirect()->back()->with( 'error', __( 'Please try again.' ) );
        }

        return redirect()->back()->with( 'error', __( 'No brand to delete.' ) );
    }

    public function bulk_delete( Request $request ) {
        $item_ids = $request->input( 'item_ids' );
        foreach ( $item_ids as $id ) {
            $brand = Brand::find( $id );
            if ( $brand ) {
                $brand->delete();
            }
        }
        return response()->json( [
            'message' => 'success',
        ] );
    }

    public function bulk_force_delete( Request $request ) {
        $item_ids = $request->input( 'item_ids' );
        foreach ( $item_ids as $id ) {
            $brand = Brand::withTrashed()->find( $id );
            if ( $brand ) {
                if ( $brand->thumbnail ) {
                    File::delete( $brand->thumbnail );
                }
                $brand->forceDelete();
            }
        }
        return response()->json( [
            'message' => 'success',
        ] );
    }

    public function bulk_restore( Request $request ) {
        $item_ids = $request->input( 'item_ids' );
        foreach ( $item_ids as $id ) {
            $brand = Brand::onlyTrashed()->find( $id );
            if ( $brand ) {
                $brand->restore();
            }
        }
        return response()->json( [
            'message' => 'success',
        ] );
    }

}
