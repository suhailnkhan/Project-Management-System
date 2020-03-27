
@extends('layouts.app')

@section('content')

    <div class="Container-fluid">


      <div class="container">
          <h3 style="background: aqua; color: white">Project Details </h3>

      @if($project)

              <p><strong> Name : </strong>  {{$project->Title}}</p>
        <p><strong>   Discription : </strong>  {{$project->Text}}</p>

      </div>




@else

    @endif
    </div>
    <div class="container">
        <a class="btn btn-success" href=" {{url('/user/index')}} ">Back</a>

    </div>
    @endsection
