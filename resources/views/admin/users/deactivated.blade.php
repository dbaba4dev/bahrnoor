@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('page-header')
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">users</a></li>
            <li class="active">deactivated users</li>
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
                   <h3 class="box-title">Deactivated users</h3>
               </div>
               <div class="box-body">
                   <div class="table-responsive">
                       <table id="users_list" class="table table-striped table-sm">
                           <thead>
                           <tr>
                               <th>image</th>
                               <th>Name</th>
                               <th>Restore</th>
                               <th>Permanent delete</th>
{{--                               <th></th>--}}
                           </tr>
                           </thead>
                           <tbody>
                            @if(count($users)>0)
                                @foreach($users as $user)
                                    <tr>
                                        <td><img src="{{asset(\App\Profile::where('user_id',$user->id)->onlyTrashed()->first()->avatar)}}" alt="" height="50px" width="50px" class="img-circle"></td>
                                        <td>{{$user->name}}</td>
                                        <td><a href="{{route('user.restore',['id'=>$user->id])}}" class="fa fa-share text-success"></a></td>
                                        <td><a href="{{route('user.delete',['id'=>$user->id])}}" class="fa fa-trash text-danger"></a></td>
                                    </tr>
                                @endforeach
                            @else
                                <td>
                                    No Deactivated users in the trash can
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

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $('#users_list').DataTable()

        })
    </script>

@endsection
