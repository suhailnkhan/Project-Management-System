
@extends('layouts.app')

     <style type="text/css">
        body{ margin-top:50px;}
        .nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
        .tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
        .tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
        .tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
        .tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
        .tab-pane .list-group .glyphicon { margin-right:5px; }
        .tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
        a.list-group-item.read { color: #222;background-color: #F3F3F3; }
        hr { margin-top: 5px;margin-bottom: 10px; }
        .nav-pills>li>a {padding: 5px 10px;}
    </style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-2">

        </div>
        <div class="col-sm-9 col-md-10">

        </div>
    </div>

    <div class="row">

{{--        create composer model --}}

        <div class="col-sm-3 col-md-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
          Compose
        </button>
            <hr />
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Compose Mail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('/admin/SendMessage')}}" method="POST"  >
                            @csrf
                            @method('GET')
                                <div class="form-group">
                                <label for="exampleInputEmail1">Select User</label>
                                 <select  name="user">
                                  @foreach($users as $user)
                                  <option >{{$user->name}}  </option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" placeholder="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label for="Message">Message</label>
                                <textarea type="text" class="form-control" id="Message" placeholder="Message" name="Message"></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-9 col-md-10">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                </span>Primary</a></li>
            </ul>
                            <table class="table ">
                                    <tbody>
                                    @foreach($mails as $mail)
                                            <tr scope="row">

{{--                                           <a data-toggle="modal" data-target="#msg" onclick="">--}}
                                                <td >  <span class="name" style="min-width: 120px;display: inline-block;">{{$mail->name}}</span></td>
                                                <td> <span class="">{{$mail->subject}}</span></td>
                                                <td>   <span class="text-muted" style="font-size: 11px;">{{$mail->body}}</span></td>
                                                <td>  <span class="badge pull-right" >{{$mail->created_at}}</span></td>
                                                <td> <button class="btn btn-primary pull-right btn-edit"> View</button></td>
                                               <form action="{{url('/admin/'.$mail->id.'/deletemail')}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <td> <button class="btn btn-sm  btn-danger">Delete</button> </td>
                                                </form>

{{--                                           </a>--}}

{{--                                            <span class="glyphicon glyphicon-paperclip"></span>--}}

                                            </tr>


                                    @endforeach
                                           </tbody>
                                            </table>
                                </div>
                            </div>
                        </div>

<div class="modal fade " id="viewModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="">
                    <h4 >Subject: </h4>
                     <h5 id = "subject1"></h5>
                    <br>
                    <h4>Message: </h4>
                    <h5 id="body"></h5>

                </div>

                <div class="row">




                </div>
{{--<table>--}}
{{--  <tr scope="row">--}}
{{--    <td id="name"> </td>--}}
{{--</tr>--}}
{{--    <tr scope="row">--}}
{{--        --}}
{{--        <td id="body"> </td>--}}
{{--    </tr>--}}


{{--</table>--}}
                <h3></h3>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>





<script>

    $(document).ready(function () {
        $(".btn-edit").on('click',  function () {
            $('#viewModel').modal('show');

                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();}).get();
             //   console.log(data);
                $('#subject1').html(data[1]);
                $('#body').html(data[2]);
  });
    });

</script>
@endsection
