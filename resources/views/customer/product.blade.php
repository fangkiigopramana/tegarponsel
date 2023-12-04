@extends('layouts.customer.index')
@section('container')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href={{ route('customer.home') }}><i class="fa fa-home"></i> Home</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{ asset('customer/img/mickey1.jpg') }}" alt="" />
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    <div class="pt active" data-imgbigurl="customer/img/mickey1.jpg">
                                        <img src="{{ asset('customer/img/mickey1.jpg') }}" alt="" />
                                    </div>

                                    <div class="pt" data-imgbigurl="customer/img/mickey2.jpg">
                                        <img src="{{ asset('customer/img/mickey2.jpg') }}" alt="" />
                                    </div>

                                    <div class="pt" data-imgbigurl="customer/img/mickey3.jpg">
                                        <img src="{{ asset('customer/img/mickey3.jpg') }}" alt="" />
                                    </div>

                                    <div class="pt" data-imgbigurl="customer/img/mickey4.jpg">
                                        <img src="{{ asset('customer/img/mickey4.jpg') }}" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{ $product->category_name }}</span>
                                    <h3>{{ $product->name }}</h3>
                                </div>
                                <div class="pd-desc">
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, error officia. Rem aperiam laborum voluptatum vel, pariatur modi hic provident eum iure natus quos non a sequi, id accusantium! Autem.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam possimus quisquam animi, commodi, nihil voluptate nostrum neque architecto illo officiis doloremque et corrupti cupiditate voluptatibus error illum. Commodi expedita animi nulla aspernatur.
                                        Id asperiores blanditiis, omnis repudiandae iste inventore cum, quam sint molestiae accusamus voluptates ex tempora illum sit perspiciatis. Nostrum dolor tenetur amet, illo natus magni veniam quia sit nihil dolores.
                                        Commodi ratione distinctio harum voluptatum velit facilis voluptas animi non laudantium, id dolorem atque perferendis enim ducimus? A exercitationem recusandae aliquam quod. Itaque inventore obcaecati, unde quam
                                        impedit praesentium veritatis quis beatae ea atque perferendis voluptates velit architecto?
                                    </p>
                                    <h5 class="text-success">Stock: {{$product->stock}}</h5>
                                    <h4>Rp {{$product->price}}</h4>
                                </div>
                                <div class="quantity">
                                    {{-- <a href={{ route('customer.add-to-cart') }} class=""> --}}
                                        <button type="button" class="btn primary-btn pd-cart" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Add To Cart
                                          </button>
                                        {{-- </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Button trigger modal -->

  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pembelian Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('customer.cart.add') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name_product">Nama Produk</label>
                            <input type="text" class="form-control" name="name_product" value="{{ $product->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Jumlah barang</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products->take(4) as $item)
                    
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('customer/img/products/women-1.jpg') }}" alt="" />
                            <ul>
                                <li class="w-icon active">
                                    <a href={{ route('customer.product-detail', [$item->id]) }}><i class="icon_bag_alt"></i></a>
                                </li>
                                <li class="quick-view"><a href={{ route('customer.product-detail', [$item->id]) }}>+ Quick View</a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$item->category_name}}</div>
                            <a href={{ route('customer.product-detail', [$item->id]) }}>
                                <h5>{{$item->name}}</h5>
                            </a>
                            <div class="product-price">
                                Rp {{$item->price}}
                                <span>{{$item->price - 10000}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->
@endsection