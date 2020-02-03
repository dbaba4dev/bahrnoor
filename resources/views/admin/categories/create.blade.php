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
            <li class="active">New Category</li>
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
                   <h3 class="box-title">New Category</h3>
               </div>
               <form action="{{route('category.store')}}" method="post">
                   {{csrf_field()}}

                   <div class="box-body">
                        <div class="row">
                            <div class="col-lg-3"></div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                </div>
                            </div>

                            <div class="col-lg-3"></div>

                        </div>

                   </div>
                   <div class="box-footer">
                       <div class="form-group">
                           <div class="text-center">
                               <button class="btn btn-primary" type="submit">
                                   Add Category
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
