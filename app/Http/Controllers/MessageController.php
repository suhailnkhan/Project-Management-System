<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {$this->middleware('auth');
    }


    public function viewPage()
    {
         $users = User::all();
         $mail  = DB::table('messages')
       ->join('users', 'messages.sender_id', '=', 'users.id')
       ->select('messages.id','messages.subject','messages.body', 'users.name','messages.created_at' )
       ->where('messages.sent_to_id','=',Auth::user()->id)
       ->get();
     return view('admin.mail' ,[
         'mails' => $mail,
         'users'=> $users
     ]);  }

    public function SendMessage(Request $request)
    {
        $name = $request->user;
        $users = User::where('name',$name)->get();
        foreach ($users as $user)
        {$user_id = $user->id;}
        $message = New Message();
        $message->sender_id = Auth::user()->id;
        $message->sent_to_id = $user_id;
        $message->body = $request->Message;
        $message->subject = $request->subject;
        $message->save();
        if(Auth::user()->Role === 'admin')
         return redirect('/admin/message');
        else
            return redirect('/user/message');
    }

     public function destroyMail($id){

        $mail = Message::find($id);
            $mail->delete();
         return redirect('/admin/message');
}



}
