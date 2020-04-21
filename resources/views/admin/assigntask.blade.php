
@extends('layouts.app')

@section('content')

    <div class="container">
<h3>Unassigned Tasks</h3>
        <div class="table table-bordered table-condensed table-striped">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Project Title</th>
                    <th scope="col">Project Description</th>
                    <th scope="col">Assign</th>
                </tr>
                </thead>
                <tbody>

                @if($posts)
                    @foreach($posts as $project)
                        <tr>
                            <td>{{$project->Title}} </td>
                            <td>{{$project->Text}}</td>
                            <td><form action="{{url('admin/'.$project->id.'/assignedTask')}}" method="Post">
                                    @csrf
                                    @method('GET')
                                    <select name="user">
                                    @foreach($users as $user)
                                  <option>{{$user->name}}</option>
@endforeach
                                    </select>
                                    <button class="btn btn-sm  btn-success">assign</button>
                                </form></td>

                        </tr>
                @endforeach

            </table>




            @else

            @endif
        </div>
        <div class="container">
            <a class="btn btn-success" href=" {{url('/admin/index')}} ">Back</a>

        </div>
@endsection
