@extends('layouts.master')

@section('page-header')
    <section class="content-header">
        <h1>
            Deleted Employees
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Employees</a></li>
            <li class="active">Deactivated Employees</li>
        </ol>
        <hr style="border: solid 0.5px #a3a3a3">
    </section>
@endsection

@section('content')
    <section class="content">
       <div class="col-lg-2"></div>
       <div class="col-lg-8">
           <div class="box box-danger">
               <div class="box-header with-border">
                   <h3 class="box-title">Deactivated Employees</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">
                       <table id="users" class="table table-striped table-sm">
                           <thead>
                           <tr>
                               <th>Image</th>
                               <th>Name</th>
                               <th>phone</th>
                               <th>Restore</th>
                               <th>Permanent Delete</th>
                           </tr>
                           </thead>
                           <tbody>
                           @if(count($employees)>0 )
                           @foreach($employees as $employee)
{{--                               @if($employee-)--}}
                                   <tr>
                                       <td>
                                           <img
                                               src="{{asset(\App\Profile::where('employee_id',$employee->id)->onlyTrashed()->first()->avatar)}}"
                                               alt="" height="50px" width="50px" class="img-circle">
                                       </td>
                                       <td>{{$employee->name}}</td>
                                       <td>{{\App\Profile::where('employee_id',$employee->id)->onlyTrashed()->first()->phone}}</td>
                                       <td><a href="{{route('employee.restore',['id'=>$employee->id])}}" class="fa fa-share text-success"></a></td>
                                       <td><a href="{{route('employee.delete',['id'=>$employee->id])}}" class="fa fa-trash text-danger"></a></td>
                                   </tr>
{{--                               @endif--}}
                           @endforeach
                           @else
                               <td>
                                   The trash can is empty!
                               </td>


                           @endif
                           </tbody>
                       </table>
                   </div>
               </div>

           </div>
{{--           {{$employees->links()}}--}}

       </div>
        <div class="col-lg-2"></div>
    </section>
@endsection
