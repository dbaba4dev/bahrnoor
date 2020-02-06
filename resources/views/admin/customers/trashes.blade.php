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
            <li class="active">Deactivated customers</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Deactivated Customers</h3>
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
                                            <img  src="{{empty(\App\Profile::where('customer_id',$customer->id)->onlyTrashed()->first()->avatar) ?
                                            asset('uploads/customers/images/customer_avatar.png') :  asset(\App\Profile::where('customer_id',$customer->id)->onlyTrashed()->first()->avatar)}}"
                                                  alt="" height="50px" width="50px" class="img-circle">
                                        </td>
                                        <td>{{$customer->name}}</td>
                                        <td>&#8358 {{$customer->balance}}</td>
                                        <td>{{$customer->area->name}}</td>
                                        <td>{{$customer->employee->name}}</td>
                                        <td>&#8358 {{$customer->credit_limit}}</td>
                                        <td>{{\App\Profile::where('customer_id',$customer->id)->onlyTrashed()->first()->phone}}</td>
                                        <td>{{\App\Profile::where('customer_id',$customer->id)->onlyTrashed()->first()->address}}</td>

                                        <td><a href="{{route('customer.restore',['id'=>$customer->id])}}" class="btn btn-success btn-xs fa fa-edit text-success"> Restore</a></td>
                                        <td><a href="{{route('customer.delete',['id'=>$customer->id])}}" class="btn btn-danger btn-xs fa fa-trash"> Delete</a></td>

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
        <div class="col-lg-1"></div>
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
