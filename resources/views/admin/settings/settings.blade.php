@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('app/jquery-ui/themes/base/jquery-ui.css')}}">
@endsection

@section('page-header')
    <section class="content-header">
        <h1>
            Settings
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
{{--            <li><a href="#">Customers</a></li>--}}
            <li class="active">Settings</li>
        </ol>
        <hr style="border: solid 0.5px #00a157";>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-4">

                <!-- About Me Box -->
                <div class="box box-info">
                    <form action="{{route('settings.price.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="box-body box-settings">

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">Price per Bags (&#8358)</span>
                                        <input type="text" name="bag_price" class="form-control" value="{{$setting->bag_price}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-md-10 -->
                                <div class="col-md-2"></div>
                            </div><!-- /.row -->

                        </div>
                        <div class="box-header with-border"> </div>
                        <!-- /.box-header -->
                        <div class="box-body text-center">
                            <input type="submit" class="btn btn-info btn-sm" value="Update price">
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                @include('includes.errors')
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Settings</h3>
                    </div>
                    <form action="{{route('settings.info.update')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Site Name</span>
                                        <input type="text" name="site_name" class="form-control" value="{{$setting->site_name}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-md-12 -->

                            </div><!-- /.row -->

                            <br>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">Email</span>
                                        <input type="tel" name="contact_email"  class="form-control" value="{{$setting->contact_email}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-3 -->
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <input type="tel" name="contact_number"  placeholder="Enter phone number"  class="form-control" value="{{$setting->contact_number}}">
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-3 -->
                            </div>

                            <br>

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">Address</span>
                                        <textarea name="contact_address" id="contact_address" cols="4" rows="4" class="form-control">{{$setting->contact_address}}</textarea>
{{--                                        <input type="number" name="credit_limit" id="credit_limit" min="0" class="form-control" value="{{$customer->credit_limit}}">--}}
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-3 -->

                            </div><!-- /.row -->


                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-info" type="submit">
                                        Update Settings
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
