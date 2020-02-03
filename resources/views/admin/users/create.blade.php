@extends('layouts.master')

@section('page-header')
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">users</a></li>
            <li class="active">New user</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    <section class="content">
       <div class="col-lg-2"></div>
       <div class="col-lg-8">
           @include('includes.errors')
           <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title">New user</h3>
               </div>
               <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                   {{csrf_field()}}

                   <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                                </div>
                            </div>
                        </div>
{{--                       <div class="row">--}}
{{--                           <div class="col-lg-6">--}}
{{--                               <div class="form-group">--}}
{{--                                   <label for="image">Picture</label>--}}
{{--                                   <input type="file" name="image" >--}}
{{--                                   <p class="help-block">upload small sized image passport</p>--}}
{{--                               </div>--}}
{{--                           </div>--}}
{{--                           <div class="col-lg-6">--}}
{{--                               <div class="form-group">--}}
{{--                                   <label for="password">Password</label>--}}
{{--                                   <input type="password" name="password" class="form-control" value="{{old('password')}}">--}}
{{--                               </div>--}}
{{--                           </div>--}}
{{--                       </div>--}}
                   </div>
                   <div class="box-footer">
                       <div class="form-group">
                           <div class="text-center">
                               <button class="btn btn-primary" type="submit">
                                   Add User
                               </button>
                           </div>
                       </div>
                   </div>
               </form>
           </div>
       </div>
        <div class="col-lg-2"></div>
    </section>
@endsection
