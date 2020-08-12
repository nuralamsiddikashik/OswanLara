<?php

namespace App\Models\Admin;

use App\Models\Admin\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use SoftDeletes;

    protected $guarded = [];

    public function getStatusTextAttribute() {
        if ( $this->status == false ) {
            return __( 'Inactive' );
        }
        return __( 'Active' );
    }

    public function setThumbnailAttribute( $value ) {
        $this->attributes['thumbnail'] = 'uploads/images/products/' . $value;
    }

    public function brand() {
        return $this->belongsTo( Brand::class );
    }

    public function product_category() {
        return $this->belongsTo( ProductCategory::class );
    }

    public function galllery() {
        return $this->hasOne( Gallery::class );
    }

}
