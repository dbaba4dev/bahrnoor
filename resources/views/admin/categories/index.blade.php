@extends('layouts.master')

@section('page-header')
    <section class="content-header">
        <h1>
            Employees
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Employees</a></li>
            <li><a href="#">Employees Categories</a></li>
            <li class="active">all Categories</li>
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
                   <h3 class="box-title">Employees Categories</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">
                       <table id="users" class="table table-striped table-sm">
                           <thead>
                           <tr>
                               <th>Name</th>
                               <th>Created At</th>
                               <th>Updated At</th>
                               <th>Edit</th>
                               <th>deleted</th>
                           </tr>
                           </thead>
                           <tbody>
                           @if(count($categories)>0)
                           @foreach($categories as $category)
                               <tr>
                                   <td>{{$category->name}}</td>
                                   <td>{{\Carbon\Carbon::parse($category->created_at)->format('jS  F Y h:i:s A')}}</td>
                                   <td>{{\Carbon\Carbon::parse($category->updated_at)->format('jS  F Y h:i:s A')}}</td>
                                   <td><a href="{{route('category.edit',['id'=>$category->id])}}" class="fa fa-edit text-success"></a></td>
                                   <td><a href="{{route('category.delete',['id'=>$category->id])}}" class="fa fa-trash-o text-danger"></a></td>

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
