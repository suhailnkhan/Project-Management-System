
@extends('layouts.app')

@section('content')


    <div class="container">
        <form action="{{url('admin/store')}}" method="POST" >
            @csrf
            @method('GET')

{{----}}
            <div class="form-group">

                <label for="title">Select User:</label>
                <select class="form-control" id="select" name="select">

                    @foreach($users as $user)

                    <option>{{$user->name}}</option>
                    @endforeach

                </select>
                <br>
                <label for="title">Title:</label>
                <input type="title" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="text">Text:</label>
                <textarea class="form-control" name="text"> </textarea>
            </div>

            <button type="submit" class="btn btn-success btn-lg">Add</button>
        </form>

        @if($errors -> count())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{$error}}<br>

                @endforeach
            </div>

        @endif
    </div>
@endsection
