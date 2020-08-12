<?php

namespace App\Models\Admin;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

    protected $guarded = [];

    public function product() {

        return $this->belongsTo( Product::class );

    }

}
