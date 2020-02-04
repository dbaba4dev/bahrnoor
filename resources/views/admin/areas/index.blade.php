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
            <li class="active">all areas</li>
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
                    <h3 class="box-title">All Areas</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="users" class="table table-striped table-bordered table-sm">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Edit</th>
                                <th>deleted</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($areas)>0)
                                @foreach($areas as $area)
                                    <tr>
                                        <td>{{$area->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($area->created_at)->format('jS  F Y h:i:s A')}}</td>
                                        <td>{{\Carbon\Carbon::parse($area->updated_at)->format('jS  F Y h:i:s A')}}</td>
                                        <td><a href="{{route('area.edit',$area->id)}}" class="btn btn-success btn-xs fa fa-edit text-success"></a></td>
                                        <td>
                                            <form action="{{ route('area.destroy', $area->id) }}" method="post">
                                                @method('DELETE')
                                                @CSRF
                                                <button class="btn btn-danger btn-xs fa fa-trash-o"></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <td>
                                    No Area added yet!
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
