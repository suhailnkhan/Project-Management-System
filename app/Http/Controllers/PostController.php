<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Post::orderBy('id', 'desc')->get();

       return view('Cred.index',[
           'projects' => $projects

     ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {


        $post = new Post;
        $post->title = $request->title;
        $post->text = $request->text;
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
        $projects=Post::find($id);

        return view('Cred.show',[
            'project' => $projects

        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $projects=Post::find($id);

return view('/Cred/edit',[
   'projects'  => $projects

]);

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
        //

        $post = Post::find($id);
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();
        return redirect('/user/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $projects=Post::find($id);
        $projects->delete();

        return redirect('/user/index');


    }
}
