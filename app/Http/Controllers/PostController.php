<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Auth;
use App\Post;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

// call It Post controller or Task Controller  . This Part actually controls the taks of the employees

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // display the Task of the employee
    public function index()
      {
        // using one to many relationship .
             $uid =  Auth::user()->id;
             $user = User::find($uid);
             $projects = $user->posts;
             return view('Cred.index',[
            'projects' => $projects

        ]);
/*
//$post = Post::first();
//dd($user->posts);
        //$projects = Post::all();
//        $projects = Post::orderBy('id', 'desc')->get();
//
//
//        //return $user->id;
//
  */

      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //redirects to create page to create the tasks

    public function create()
    {
        return view('Cred.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request )
    {
        $uid =  Auth::user()->id;
        $user = User::find($uid);

        $this->validate($request,[
            'title'=>'required' ,
            'text'=>'required'
        ]);

       // Post::create($request->all());
            //exit();

       $user = Post::find($uid);
        $post = new Post;
        $post->title = $request->title;
        $post->text = $request->text;
        $post->user_id = $uid;
        $post->save();

     return redirect('/user/index');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $uid = Auth::user()->id;
        $userPostid = Post::find($id)->user_id;
        if ($uid == $userPostid) {
        $projects=Post::find($id);
        return view('Cred.show',[
            'project' => $projects

        ]);}
        else{
            return redirect('/user/index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uid = Auth::user()->id;
        $userPostid = Post::find($id)->user_id;
        if ($uid == $userPostid) {
           $projects=Post::find($id);
           return view('/Cred/edit',[
               'projects'  => $projects
           ]);
        }
        else{
            return redirect('/user/index');
        }


       }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $uid = Auth::user()->id;
        $userPostid = Post::find($id)->user_id;
        if ($uid == $userPostid) {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->text = $request->text;
            $post->save();
            return redirect('/user/index');
        }
        else{
            return redirect('/user/index');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $uid = Auth::user()->id;
        $userPostid = Post::find($id)->user_id;
        if ($uid == $userPostid) {
        $projects=Post::find($id);
        $projects->delete();
        return redirect('/user/index');
    } else{
            return redirect('/user/index');
        }
    }
}
