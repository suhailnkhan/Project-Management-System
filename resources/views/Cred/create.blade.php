
@extends('layouts.app')

@section('content')


   <div class="container">
    <form action="{{url('/user/store')}}" method="POST" >
        @csrf
        @method('GET')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="title" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="text">Text:</label>
            <textarea class="form-control" name="text"> </textarea>
        </div>

 <button type="submit" class="btn btn-success btn-lg">Submit</button>
    </form>
   </div>
@endsection
