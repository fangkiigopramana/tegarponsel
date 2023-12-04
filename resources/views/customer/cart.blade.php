@extends('layouts.customer.index')
@section('container')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href={{ route('customer.home') }}><i class="fa fa-home"></i> Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="p-name text-center">Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($datas as $data)
                                        <tr>
                                            <td class="cart-title first-row text-center">
                                                <h5>{{ $data->name }}</h5>
                                            </td>
                                            <td class="p-price first-row">Rp {{$data->price}}</td>
                                            <td class="p-price first-row">{{$data->quantity}}</td>
                                            <td class="delete-item">
                                                <a href={{ route('customer.cart.buy', [$data->id]) }}>
                                                    @if ($data->is_paid == 0 && $data->is_sell == 0 )
                                                    <p class="text-primary fw-bold">Buy Now</p>
                                                    @endif
                                                </a>
                                                <a href="#">
                                                    @if ($data->is_paid == 1 && $data->is_sell == 0)
                                                    <p class="text-warning fw-bold">Waiting Admin Confirm</p>
                                                    @endif
                                                </a>
                                                <a href="#">
                                                    @if ($data->is_sell == 1 && $data->is_sell == 1)
                                                    <p class="text-success fw-bold">Paid Success</p>
                                                    @endif
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection