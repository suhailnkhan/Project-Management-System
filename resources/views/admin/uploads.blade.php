                    @extends('layouts.app')
                    @section('content')


            <style>

            .card{


            }


            </style>
            <div class="container-fluid">



            </div>

                    <div class="container">
                           <div class="row">
                                <div  class="col-md-6  col-md-offset-4">
                                    <div class="card">
                                        <h5 class="card-header"> Uploded files</h5>
                                        <div class="card-body">
                 <form method="POST" action="{{url('admin/'.$users->id.'/uploadfiles')}}" enctype="multipart/form-data">
                                            @method('GET')

                                            <label for="" class="col-md-4 col-form-label text-md-right">Upload Image:</label>

                                            <div class="col-md-9">
                                                <input id="imageup" type="file" class="form-control" name="file" class="">
            <br>
                                            <button type="submit" class="btn btn-success" > Upload  </button> </div>

                                       </form>
                                            <br>
                                            <a class="btn btn-warning" href="{{url('/admin/index')}}"> Back </a>

                                        </div>
                                    </div>
                                </div>
                           </div>
                        <br>
                                <div class="row">
                                          @if($uploads)
                                           @foreach($uploads as $upload )
                                                <div class="col-md-4">
                                                        <div class="card">
                                                   <img src="{{URL::asset('/storage/'. $upload->path)}}">
            {{--                                          <img src="{{Storage::url($upload->path)}}">--}}
                                                               <div class="card-body">
                                                             <strong class="card-title">{{$upload->path}} </strong>
                                                                <a class="btn btn-danger" href="{{url('/admin/delete/'.$upload->id.'/'.$upload->user_id)}}">Delete</a>
                                                                <a class="btn btn-warning" href="{{url('/admin/download/'.$upload->id)}}">Download</a>
                                                                 <p class="card-text  "></p>
                                                </div>
                                            </div>
                                      </div>
                                        @endforeach
                                        @endif
                                </div>
                          </div>


            @endsection
