@extends('layouts.master')

@section('page-header')
    <section class="content-header">
        <h1>
            Customers
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Customers</a></li>
            <li><a href="#">Customer's areas</a></li>
            <li class="active">Edit area</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    <section class="content">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            @include('includes.errors')
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Area</h3>
                </div>
                <form action="{{route('area.update',$area->id)}}" method="post">
{{--                    {{ method_field('PUT') }}--}}

                    {{csrf_field()}}
                    @method('PATCH')

                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-3"></div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$area->name}}">
                                </div>
                            </div>

                            <div class="col-lg-3"></div>

                        </div>

                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">
                                    Update Area
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
