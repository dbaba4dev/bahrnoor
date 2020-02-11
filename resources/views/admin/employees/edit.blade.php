@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('app/jquery-ui/themes/base/jquery-ui.css')}}">
@endsection

@section('page-header')
    <section class="content-header">
        <h1>
            Employees' Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Employees</a></li>
            <li class="active">Edit Employee</li>
        </ol>
        <hr style="border: solid 0.5px #00a157";>
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <!-- About Me Box -->
                <div class="box box-success">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{asset($employee->profile->avatar)}}" alt="profile picture">

                        <h3 class="profile-username text-center">{{$employee->name}}</h3>

                        <p class="text-muted text-center">{{$employee->category->name}}</p>

                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-phone margin-r-5"></i>{{$employee->profile->phone}}</strong>

                        <p class="text-muted " >
                            Balance: &#8358<span class="text-danger"> <strong>{{$employee->balance}}</strong></span>
                        </p>

                        <p class="text-muted " >
                            Joined on {{$employee->joined}}
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">{{$employee->profile->address}}</p>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-lg-9">
                @include('includes.errors')
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit profile</h3>
                    </div>
                    <form action="{{route('employee.profile.update',['id'=>$employee->id])}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$employee->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                @if($category->id == $employee->category->id)
                                                    selected
                                                @endif
                                                >{{$category->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image">Upload Picture</label>
                                        <input type="file" name="avatar" >
                                        <p class="help-block">upload small sized image passport</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="joined">Joined on</label>
                                        <input type="text" name="joined" id="datepicker" value="{{$employee->joined}}" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" value="{{$employee->profile->address}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" name="phone" value="{{$employee->profile->phone}}" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="text-center">
                                    <button class="btn btn-success" type="submit">
                                        Update profile
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
