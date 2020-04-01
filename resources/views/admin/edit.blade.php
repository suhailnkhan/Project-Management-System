
@extends('layouts.app')

@section('content')


    <div class="container">
        <form action="{{url('/admin/'.$user->id.'/update')}}" method="POST" >
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="text">Email:</label>
                <input type="text" class="form-control" id="name" name="email" value="{{$user->email}}">
            </div>

            <div class="form-group">
                <label for="text">role:</label>
                <input type="text" class="form-control" id="name" name="role" value="{{$user->Role}}">
            </div>

            <button type="submit" class="btn btn-success btn-lg">Submit</button>
        </form>
    </div>
@endsection
