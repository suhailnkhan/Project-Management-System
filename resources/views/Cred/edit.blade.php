
@extends('layouts.app')

@section('content')


    <div class="container">
        <form action="{{url('/user/'.$projects->id.'/update')}}" method="POST" >
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="title" class="form-control" id="title" name="title" value="{{$projects->Title}}">
            </div>
            <div class="form-group">
                <label for="text">Text:</label>
                <textarea class="form-control" name="text" value="{{$projects->Title}}">{{$projects->Title}} </textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg">Submit</button>
        </form>
    </div>
@endsection
