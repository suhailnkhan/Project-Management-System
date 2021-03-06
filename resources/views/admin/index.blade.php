@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card row ">
                    <div class="card-header ">

                        <a class="btn btn-success " href="{{url('/admin/createTask')}}" style="align-content: center">Create Task</a>
                        <a class="btn btn-info " href="{{url('/admin/createUser')}}">Add User</a>
                        <a class="btn btn-success  pull-right" href="{{url('/user/map')}}" >  Go to Weather Api </a>
                        <a class="btn btn-warning  " href="{{url('/admin/message')}}">Mail</a>
                        @can('assigntask',Auth::user())
                        <a class="btn btn-success pull-right" href="{{url('/admin/assigntask')}}" >  Assign Task</a>
                        @endcan
                    </div>
                </div>
                <div class="search-container">
                    <form class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2" action="{{url('/admin/search')}}" method="POST">
                        @csrf
                        @method('GET')
                        <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search" name="input">
                        <button class="btn btn-primary" type="submit"> Submit </button>

                    </form>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table table-bordered table-condensed table-striped">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">No Of Tasks</th>
                                <th scope="col">Role</th>
                                <th class="justify-content-center">  Operations </th>
                                <th></th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users)
                                @foreach($users as $user )
                                    <tr>
                                        <td>{{$user->id}} </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->posts->count()}}</td>

                                        <td>{{$user->Role}}</td>
                                        <td> <a class="btn btn-sm  btn-primary"  href="{{url('/admin/'. $user->id.'/show')}}">Show Task List</a>
                                        <a class="btn btn-warning btn-sm" href="{{url('/admin/'. $user->id.'/edit')}}">Edit User Details</a>
                                        <a class="btn btn-warning btn-sm" href="{{url('/admin/'. $user->id.'/uploads')}}">Upload</a></td>


                                    @can('Delete_user',Auth::user())

                                        <form action="{{url('/admin/'.$user->id.'/delete')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                 <td> <button class="btn btn-sm  btn-danger">Delete</button> </td>
                                        </form>
                                            @endcan

                                        @if($user->isonline())
                                            <td>  <i class="fa fa-circle" style="color:green">  </td>
                                        @else
                                            <td> <i class="fa fa-circle" style="color: red"></i>
                                                @endif
                                            </td>
                                                </tr>




                                @endforeach
                            @else
                                     <tr>
                                     <td>
                                        <p colspan="5" class="text-danger text-center"> No Data Found </p></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>

                    </div>
                        <div class="row container">
                            @if(session()->has('message'))
                                <div class="alert alert-warning">
                                      {{ session()->get('message')}} &#9888;
                                </div>
                            @endif
                        </div>
                  </div>
            </div>
        </div>
    </div>

@endsection
