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
            <li class="active">New Customer</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            @include('includes.errors')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">New Customer</h3>
                </div>
                <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="box-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                  <span class="input-group-addon">Name</span>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">Location</span>
                                    <select name="area_id" id="area_id" class="form-control">
                                        <option value="" selected disabled>Select Area</option>
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach

                                    </select>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-3 -->
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Vendor</span>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value="" selected disabled>Select Sales Reps</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
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
                                    <input type="text" name="address" class="form-control" value="{{old('address')}}">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="tel" name="phone"  placeholder="Enter phone number"  class="form-control" value="{{old('phone')}}">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-3 -->

                        </div><!-- /.row -->

                        <br>
                        <div class="row">

                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Upload picture</span>
                                    <input type="file" name="avatar" class="form-control">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Credit limit (&#8358)</span>
                                    <input type="number" name="credit_limit" id="credit_limit" min="0" class="form-control" value="0">
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-3 -->
                            <div class="col-lg-6"></div>
                        </div><!-- /.row -->


                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-primary" type="submit">
                                    Add Customer
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('app/jquery-ui/jquery-ui.js')}}"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>

    <script>
        var number = document.getElementById('credit_limit');

        // Listen for input event on numInput.
        number.onkeydown = function(e) {
            if(!((e.keyCode  > 95 && e.keyCode  < 106)
                || (e.keyCode  > 47 && e.keyCode  < 58)
                || e.keyCode  === 8)) {
                return false;
            }
        }
    </script>
@endsection
