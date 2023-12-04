@extends('admin.admin_master')
@section('admin')


<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Purchase Pending</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- <a href="{{ route('purchase.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right">
                        <i class="fas fa-plus-circle"> Purchase Pending</i></a>
                    <br><br> --}}

                    <h4 class="card-title">Purchase All Pending Data </h4>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Purchase No</th>
                            <th>Date</th>
                            {{-- <th>Supplier</th> --}}
                            {{-- <th>Category</th> --}}
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Action</th>

                        </thead>


                        <tbody>

                        	@foreach($allData as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{  $item->purchase_no }} </td>
                            <td> {{ date('d-m-Y',strtotime($item->date)) }} </td>
                            {{-- <td> {{ $item['supplier']['name'] }} </td>
                            <td> {{ $item['category']['name'] }} </td> --}}
                            <td> {{ $item->product_name }} </td>
                            <td> {{ $item->customer_name }} </td>
                            <td> {{ $item->quantity }} </td>

                            @if ($item->is_paid == 0 && $item->is_sell == 0 )
                                <td> <span class="btn btn-primary">Waiting Paid</span> </td>
                            @elseif ($item->is_paid == 1 && $item->is_sell == 0)
                                <td> <span class="btn btn-warning">Need Approved Paid</span> </td>
                            @elseif ($item->is_paid == 1 && $item->is_sell == 1)
                                <td> <span class="btn btn-success">Completed Paid</span> </td>
                            @endif
                                <td>
                                    @if ($item->is_paid == 1 && $item->is_sell == 0)
                                        <a href={{ route('customer.cart.confirm', [$item->purchase_no]) }} class="btn btn-warning sm" title="Approve Data" id="approve">Approve</a>
                                    @else
                                    <a href="#" class="btn btn-success sm" title="Approve Data" id="approve">Completed</a>
                                    @endif
                                </td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>


@endsection
