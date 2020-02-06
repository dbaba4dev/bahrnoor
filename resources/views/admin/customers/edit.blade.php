@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('app/jquery-ui/themes/base/jquery-ui.css')}}">
@endsection

@section('page-header')
    <section class="content-header">
        <h1>
            Customers
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Customers</a></li>
            <li class="active">Edit Customers</li>
        </ol>
        <hr style="border: solid 0.5px #00a157";>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <!-- About Me Box -->
                <div class="box box-warning">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{empty($customer->profile->avatar) ? asset('uploads/customers/images/customer_avatar.png') :  asset($customer->profile->avatar)}}" alt="profile picture">

                        <h3 class="profile-username text-center">{{$customer->name}}</h3>

{{--                        <p class="text-muted text-center">{{$employee->category->name}}</p>--}}

                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-phone margin-r-5"></i>{{$customer->profile->phone}}</strong>

                        <p class="text-muted " >
                            Balance: &#8358<span class="text-danger"> <strong>{{$customer->balance}}</strong></span>
                        </p>

                        <p class="text-muted " >
{{--                            Joined on {{$employee->joined}}--}}
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">{{$customer->profile->address}}, Area: {{$customer->area->name}}</p>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-lg-9">
                @include('includes.errors')
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Customer</h3>
                    </div>
                    <form action="{{route('customer.update',['id'=>$customer->id])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="box-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Name</span>
                                        <input type="text" name="name" class="form-control" value="{{$customer->name}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Location</span>
                                        <select name="area_id" id="area_id" class="form-control">
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}"
                                                @if($customer->area->id == $area->id)
                                                    'selected'
                                                @endif
                                                >{{$area->name}}</option>
                                            @endforeach

                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-3 -->
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Vendor</span>
                                        <select name="employee_id" id="employee_id" class="form-control">
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}"
                                                    @if($customer->employee->id == $employee->id)
                                                        'selected'
                                                    @endif
                                                > {{$employee->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-3 -->
                            </div><!-- /.row -->

                            <br>
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">Address</span>
                                        <input type="text" name="address" class="form-control" value="{{$customer->profile->address}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" name="phone"  placeholder="Enter phone number"  class="form-control" value="{{$customer->profile->phone}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-3 -->

                            </div><!-- /.row -->

                            <br>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Upload picture</span>
                                        <input type="file" name="avatar" class="form-control">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Credit limit (&#8358)</span>
                                        <input type="number" name="credit_limit" id="credit_limit" min="0" class="form-control" value="{{$customer->credit_limit}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-3 -->
                                <div class="col-lg-3"></div>
                            </div><!-- /.row -->


                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-warning" type="submit">
                                        Update Customer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('app/jquery-ui/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endsection
