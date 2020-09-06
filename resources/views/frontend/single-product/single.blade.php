@extends('layouts.frontend')
@section('content')
 <div class="breadcrumb-area pt-255 pb-170" style="background-image: url({{ asset('assets/frontend')}}/img/banner/banner-4.jpg)">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center">
            <h2>product details </h2>
            <ul>
                <li>
                    <a href="#">home</a>
                </li>
                <li>product details </li>
            </ul>
        </div>
    </div>
</div>
            <div class="product-details-area fluid-padding-3 ptb-130">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-details-img-content">
                                <div class="product-details-tab mr-40">
                                    <div class="product-details-large tab-content">
                                        <div class="tab-pane active" id="pro-details1">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/bl1.jpg">
                                                    <img src="{{ asset($product->thumbnail)}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details2">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/bl2.jpg">
                                                    <img src="assets/img/product-details/l2.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details3">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/bl3.jpg">
                                                    <img src="assets/img/product-details/l3.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details4">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/bl4.jpg">
                                                    <img src="assets/img/product-details/l4.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="pro-details5">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="assets/img/product-details/bl3.jpg">
                                                    <img src="assets/img/product-details/l3.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-details-small nav mt-12 product-dec-slider owl-carousel">
                                        <a class="active" href="#pro-details1">
                                            <img src="assets/img/product-details/s1.jpg" alt="">
                                        </a>
                                        <a href="#pro-details2">
                                            <img src="assets/img/product-details/s2.jpg" alt="">
                                        </a>
                                        <a href="#pro-details3">
                                            <img src="assets/img/product-details/s3.jpg" alt="">
                                        </a>
                                        <a href="#pro-details4">
                                            <img src="assets/img/product-details/s4.jpg" alt="">
                                        </a>
                                        <a href="#pro-details5">
                                            <img src="assets/img/product-details/s3.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-content">
                                <h2>{{ $product->title}}</h2>
                                <div class="quick-view-rating">
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <i class="fa fa-star reting-color"></i>
                                    <span> ( 01 Customer Review )</span>
                                </div>
                                <div class="product-price">
                                    <span>$2549</span>
                                </div>
                                <div class="product-overview">
                                    <h5 class="pd-sub-title">Product Overview</h5>
                                    <p>{{ $product->short_description }}</p>
                                </div>
                                <div class="product-color">
                                    <h5 class="pd-sub-title">Product color</h5>
                                    <ul>
                                        <li class="red">b</li>
                                        <li class="pink">p</li>
                                        <li class="blue">b</li>
                                        <li class="sky2">b</li>
                                        <li class="green">y</li>
                                        <li class="purple2">g</li>
                                    </ul>
                                </div>
                                <div class="quickview-plus-minus">
                                    <div class="cart-plus-minus">
                                        <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                    </div>
                                    <div class="quickview-btn-cart">
                                        <a class="btn-style cr-btn" href="#"><span>add to cart</span></a>
                                    </div>
                                    <div class="quickview-btn-wishlist">
                                        <a class="btn-hover cr-btn" href="#"><span><i class="icofont icofont-heart-alt"></i></span></a>
                                    </div>
                                </div>
                                <div class="product-categories">
                                    <h5 class="pd-sub-title">Categories</h5>
                                    <ul>
                                        <li>
                                            <a href="#">fashion ,</a>
                                        </li>
                                        <li>
                                            <a href="#">electronics ,</a>
                                        </li>
                                        <li>
                                            <a href="#">toys ,</a>
                                        </li>
                                        <li>
                                            <a href="#">food ,</a>
                                        </li>
                                        <li>
                                            <a href="#">jewellery </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-share">
                                    <h5 class="pd-sub-title">Share</h5>
                                    <ul>
                                        <li>
                                            <a href="#"><i class="icofont icofont-social-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icofont icofont-social-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="icofont icofont-social-pinterest"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"> <i class="icofont icofont-social-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    @if(count($relatedProducts) > 0)
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12 text-center my-4">
                <h4>Related Items</h4>
            </div>
            @foreach($relatedProducts as $relatedItem)
            <div class="col-md-4 mb-4">
                <div class="product-wrapper">
                    <div class="product-img">
                        <a href="{{ route('frontend.single.product', $relatedItem->slug) }}">
                            <img src="{{ asset($relatedItem->thumbnail)}}" alt="">
                        </a>
                        <div class="product-item-dec">
                            <ul>
                                <li>{{ $relatedItem->model }}</li>
                                <li>{{ $relatedItem->fuel_type }}</li>
                                <li>{{ $relatedItem->cc }} CC</li>
                            </ul>
                        </div>
                        <div class="product-action">
                            <a class="action-plus-2" title="Add To Cart" href="#">
                                <i class=" ti-shopping-cart"></i>
                            </a>
                            <a class="action-cart-2" title="Wishlist" href="#">
                                <i class=" ti-heart"></i>
                            </a>
                            <a class="action-reload" title="Quick View" data-toggle="modal" data-target="#exampleModal"
                                href="#">
                                <i class=" ti-zoom-in"></i>
                            </a>
                        </div>
                        <div class="product-content-wrapper">
                            <div class="product-title-spreed">
                                <h4><a
                                        href="{{ route('frontend.single.product', $relatedItem->slug) }}">{{ $relatedItem->title }}</a>
                                </h4>
                                <span>{{ $relatedItem->rpm }} RPM</span>
                            </div>
                            <div class="product-price">
                                <span>${{ $relatedItem->final_price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

  </div>
@endsection