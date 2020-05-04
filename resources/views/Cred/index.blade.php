@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <a class="btn btn-success " href="{{url('/user/create')}}">Create</a>
                      <a class="btn btn-success pull-right" href="{{url('/user/map')}}" >  Go to Weather Api </a>
                        <a class="btn btn-warning " href="{{url('/user/message')}}">Message</a>

                    </div>

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
                                        <th scope="col">Title</th>
                                        <th scope="col">Post</th>
                                        <th scope="col">Created On</th>
                                        <th scope="col">Updated On</th>
                                        <th scope="col">Operations</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                        @if($projects)
                                            @foreach($projects as $project )
<tr>
                                                <td>{{$project->Title}} </td>
                                                <td>{{$project->Text}}</td>
                                                <td>{{$project->created_at}}</td>
                                                 <td>{{$project->updated_at}}</td>
                                                <td> <a class="btn  btn-primary btn-sm"  href="{{url('/user/'. $project->id.'/show')}}">Show</a>
                                               <a class="btn btn-warning  btn-sm" href="{{url('/user/'. $project->id.'/edit')}}">Edit</a>

                                                </td>

    {{--                                                 <form action="{{url('/user/'.$project->id.'/delete')}}" method="POST">--}}
{{--                                                     @csrf--}}
{{--                                                     @method('DELETE')--}}

{{--                                                <td> <button class="btn  btn-danger">Delete</button></td>--}}

{{--                                                 </form>--}}
                                            </tr>
                                                            @endforeach

                                              <tr>
                                            <td>  @else
                                                <p colspan="5" class="text-danger text-center"> No Data Found </p></td>
                                            @endif

                                    </tr>
                                    </tbody>
                                </table>

                            </div>
<div class="row" >




</div>




                    </div>
                </div>
            </div>
        </div>

@endsection
