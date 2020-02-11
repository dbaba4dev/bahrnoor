@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('page-header')
    <section class="content-header">
        <h1>
            Customers
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Customers</a></li>
            <li class="active">All customers</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    <section class="content customer_page">
        <div class="col-xl-1"></div>
        <div class="col-xl-10 col-sm-12 customer_list">
            <a href="{{route('customer.create')}}" role="button" class="btn btn-primary fa fa-plus" style="margin-bottom: 1rem"> New Customer</a>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Customers list</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="customer_list" class="table table-striped table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>image</th>
                                <th>Name</th>
                                <th>Balance</th>
                                <th>Area</th>
                                <th>Vendor</th>
                                <th>Credit Limit</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Edit</th>
                                <th>De-activate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($customers)>0)
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>
                                            <img  src="{{empty($customer->profile->avatar) ? asset('uploads/customers/images/customer_avatar.png') :  asset($customer->profile->avatar)}}"
                                                  alt="" height="50px" width="50px" class="img-circle">
                                        </td>
                                        <td>{{$customer->name}}</td>
                                        <td>&#8358 {{$customer->balance}}</td>
                                        <td>{{$customer->area->name}}</td>
                                        <td>{{$customer->employee->name}}</td>
                                        <td>&#8358 {{$customer->credit_limit}}</td>
                                        <td>{{$customer->profile->phone}}</td>
                                        <td>{{$customer->profile->address}}</td>

                                        <td><a href="{{route('customer.edit',['id'=>$customer->id])}}" class="btn btn-success btn-xs fa fa-edit text-success"> Edit</a></td>
                                        <td><a href="{{route('customer.deactivate',['id'=>$customer->id])}}" class="btn btn-warning btn-xs fa fa-remove"> De-activate</a></td>

                                    </tr>
                                @endforeach
                            @else
                                <td>
                                    No Customer added yet!
                                </td>


                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-1"></div>
    </section>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $('#customer_list').DataTable()

        })
    </script>

@endsection
