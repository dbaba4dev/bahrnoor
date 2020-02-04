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
{{--        <div class="col-lg-2"></div>--}}
        <div class="col-lg-12">
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
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="area_id">Location</label>
                                    <select name="area_id" id="area_id" class="form-control">
                                        <option value="1">Abuja Talaka</option>
                                        <option value="2">Bulunkutu</option>
                                        <option value="3">Jidari</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="employee_id">Vendor</label>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value="1">Dee Baba</option>
                                        <option value="2">Y Baba</option>
                                        <option value="3">M Baba</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{old('address')}}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name="phone"  class="form-control" value="{{old('phone')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="avatar">Upload picture</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-3"></div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="credit_limit">Credit Limit</label>
                                    <input type="number" name="credit_limit"  class="form-control" value="{{old('credit_limit')}}">
                                </div>
                            </div>
                        </div>

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
{{--        <div class="col-lg-2"></div>--}}
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
