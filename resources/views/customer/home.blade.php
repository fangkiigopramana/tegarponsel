@extends('layouts.customer.index')
@section('container')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="hero-1.png">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Handphone,Gadget</span>
                            <h1>Christmas Promo</h1>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            </p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="hero-2.png">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Accesorries</span>
                            <h1>December Happy</h1>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            </p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="product-slider owl-carousel">

                        @foreach ($products as $product)
                            
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="customer/img/mickey1.jpg" alt="" />
                                <ul>
                                    <li class="w-icon active">
                                        <a href={{ route('customer.product-detail', [$product->id]) }}><i class="icon_bag_alt"></i></a>
                                    </li>
                                    <li class="quick-view"><a href={{ route('customer.product-detail', [$product->id]) }}>+ Quick View</a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{$product->category_name}}</div>
                                <a href={{ route('customer.product-detail', [$product->id]) }}>
                                    <h5>{{ $product->name }}</h5>
                                </a>
                                <div class="product-price">
                                    Rp {{$product->price}}
                                    <span>Rp {{$product->price - 10000}}</span>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->
@endsection