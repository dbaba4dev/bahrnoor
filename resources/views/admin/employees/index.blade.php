@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('page-header')
    <section class="content-header">
        <h1>
            Employees
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Employees</a></li>
            <li class="active">all Employees</li>
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
                   <h3 class="box-title">All Employees</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">
                       <table id="employee_list" class="table table-striped table-sm">
                           <thead>
                           <tr>
                               <th>Image</th>
                               <th>Name</th>
                               <th>Role</th>
                               <th>Balance</th>
                               <th>phone</th>
                               <th>Detail</th>
                               <th>Trash</th>
                           </tr>
                           </thead>
                           <tbody>
                           @if(count($employees)>0 )
                           @foreach($employees as $employee)
{{--                               @if($employee-)--}}
                                   <tr>
                                       <td>
                                           <img
                                               src="{{empty($employee->profile->avatar) ? asset('uploads/avatars/avatar5.png') :  asset($employee->profile->avatar)}}"
                                               alt="" height="50px" width="50px" class="img-circle">
                                       </td>
                                       <td>{{$employee->name}}</td>
                                       <td>{{$employee->category->name}}</td>
                                       <td>&#8358 {{$employee->balance}}</td>
                                       <td>{{$employee->profile->phone}}</td>
                                       <td><a href="{{route('employee.edit',['id'=>$employee->id])}}" class="fa fa-eye text-success"></a></td>
                                       <td><a href="{{route('employee.deactivated',['id'=>$employee->id])}}" class="fa fa-trash-o text-danger"></a></td>
                                   </tr>
{{--                               @endif--}}
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
           {{$employees->links()}}

       </div>
        <div class="col-lg-2"></div>
    </section>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $('#employee_list').DataTable()

        })
    </script>

@endsection
