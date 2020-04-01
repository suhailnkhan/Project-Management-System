
@extends('layouts.app')

@section('content')


    <div class="container">
        <form action="{{url('admin/'.$post->id.'/updatePost')}}" method="POST" >
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Project Title:</label>
                <input type="text" class="form-control" id="name" name="Title" value="{{$post->Title}}">
            </div>

            <div class="form-group">
                <label for="text">Project Description:</label>
                <input type="text" class="form-control" id="name" name="Text" value="{{$post->Text}}">
            </div>



            <button type="submit" class="btn btn-success btn-lg">Update</button>
        </form>
    </div>
@endsection
