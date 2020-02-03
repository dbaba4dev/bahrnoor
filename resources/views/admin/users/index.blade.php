@extends('layouts.master')

@section('page-header')
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">users</a></li>
            <li class="active">all users</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    <section class="content">
       <div class="col-lg-2"></div>
       <div class="col-lg-8">
           <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title">Management users</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">
                       <table id="users" class="table table-striped table-bordered table-sm">
                           <thead>
                           <tr>
                               <th>image</th>
                               <th>Name</th>
                               <th>Permission</th>
                               <th>Edit</th>
                               <th>Trash</th>
                           </tr>
                           </thead>
                           <tbody>
                           @if(count($users)>0)
                           @foreach($users as $user)
                               <tr>
                                   <td><img src="{{asset($user->profile->avatar)}}" alt="" height="50px" width="50px" class="img-circle"></td>
                                   <td>{{$user->name}}</td>
                                   <td>
                                       @if($user->admin == 1)
                                           <a href="{{route('is_admin',['id'=>$user->id])}}" class="btn btn-danger btn-xs"> Remove permissions </a>
                                       @else
                                           <a href="{{route('not_admin',['id'=>$user->id])}}" class="btn btn-success btn-xs">Make admin</a>
                                       @endif
                                   </td>
                                   <td><a href="{{route('user.edit',['id'=>$user->id])}}" class="fa fa-edit text-success"></a></td>
                                   @if(Auth::id() !== $user->id)
                                       <td><a href="{{route('user.deactivated',['id'=>$user->id])}}" class="fa fa-trash-o text-danger"></a></td>
                                   @endif
                               </tr>
                           @endforeach
                           @else
                               <td>
                                   No users added yet!
                               </td>


                           @endif
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
        <div class="col-lg-2"></div>
    </section>
@endsection
