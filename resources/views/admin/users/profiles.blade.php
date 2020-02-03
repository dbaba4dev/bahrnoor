@extends('layouts.master')

@section('page-header')
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">users</a></li>
            <li class="active">Edit user</li>
        </ol>
        <hr style="border: solid 0.5px #00a157";>
    </section>
@endsection

@section('content')
    <section class="content">
       <div class="col-lg-2"></div>
       <div class="col-lg-8">
           @include('includes.errors')
           <div class="box box-success">
               <div class="box-header with-border">
                   <h3 class="box-title">Edit your profile</h3>
               </div>
               <form action="{{route('user.profile.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                   {{csrf_field()}}

                   <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}">
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
                                   <label for="password">New Password</label>
                                   <input type="password" name="password" class="form-control" >
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-8">
                               <div class="form-group">
                                   <label for="address">Address</label>
                                   <input type="text" name="address" value="{{$user->profile->address}}" class="form-control" >
                               </div>
                           </div>
                           <div class="col-lg-4">
                               <div class="form-group">
                                   <label for="phone">Phone</label>
                                   <input type="tel" name="phone" value="{{$user->profile->phone}}" class="form-control" >
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
        <div class="col-lg-2"></div>
    </section>
@endsection
