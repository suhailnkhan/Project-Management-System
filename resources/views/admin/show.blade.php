
@extends('layouts.app')

@section('content')

    <div class="container">

          <div class="table table-bordered table-condensed table-striped">

              <table class="table">
                  <thead>
                  <tr>
                      <th scope="col">Project Title</th>
                      <th scope="col">Project Description</th>
                      <th scope="col">Project Status</th>
                      <th scope="col">Operations</th>



                  </tr>
                  </thead>
                  <tbody>

                  @if($projects)
                      @foreach($projects as $project)
                          <tr>
                              <td>{{$project->Title}} </td>
                              <td>{{$project->Text}}</td>
                              <td>{{$project->id}}</td>

<td>        <a class="btn btn-success" href=" {{url('/admin/'.$project->id.'/editPost')}} ">Edit</a> </td>

                              <td><form action="{{url('admin/'.$project->id.'/destroyPost')}}" method="Post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-sm  btn-danger">Delete</button>
                                   </form>
                              </td>
                          </tr>
                      @endforeach

        </table>




@else

    @endif
    </div>
    <div class="container">
        <a class="btn btn-success" href=" {{url('/admin/index')}} ">Back</a>

    </div>
    </div>
    @endsection
