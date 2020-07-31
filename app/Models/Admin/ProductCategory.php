<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {
    protected $guarded = [];

    public function getStatusTextAttribute() {
        if ( $this->status == false ) {
            return __( 'Inactive' );
        }
        return __( 'Active' );
    }

    public function setThumbnailAttribute( $value ) {
        $this->attributes['thumbnail'] = 'uploads/images/product-categories/' . $value;
    }
}
