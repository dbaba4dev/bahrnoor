@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

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
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <a href="{{route('area.create')}}" role="button" class="btn btn-primary fa fa-plus" style="margin-bottom: 1rem"> New Area</a>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All Areas</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="area_list" class="table table-striped table-bordered table-sm">
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
        <div class="col-lg-1"></div>
    </section>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $('#area_list').DataTable()

        })
    </script>

@endsection
