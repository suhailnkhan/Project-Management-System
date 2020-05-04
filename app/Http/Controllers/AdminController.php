<?php

namespace App\Http\Controllers;
use App\Events\NewCustHasRegEvent;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Upload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Response;


class AdminController extends Controller
{

    public function __construct()
    {
$this->middleware('auth');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //main index after login
    public function index()
    {
        $users = User::all();

        return view('admin.index',[
              'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //create new user via admin login
    public function create()
    {
        return view('admin.createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //create new task for any user by admin !
    public function storeTask(Request $request)
    {
        $name = $request->select;
        $users = User::where('name',$name)->get();
        foreach ($users as $user)
        {
           $user_id = $user->id;
        }
        $post = new Post;
        if($request->has('name')){
        $post->user_id =$user_id;}
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();
        return redirect('/admin/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //shows all users from the database
    public function show($id)
    {
                 $user = User::find($id);
                 $project = $user->posts;
                return view('admin.show',[
                  'projects' => $project
                     ]);
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //redirect to user edit page to update user details .
    public function edit($id)
    {
        $user  = User::find($id);
      return view('/admin/edit',[
         'user'=> $user
      ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    //updates the user's details without admin
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user->Role == 'admin'){
      return redirect('/admin/index')->with('message', "Can't edit admin");
        }else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->Role = $request->role;
            $user->save();
            return redirect('/admin/index');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //delete a user form database
    public function destroy($id)
    {
        //
    }

    //edit Any user's Task when logged in from admin redirects to updatePost
    public function editPost($id)
    {
        $post  = Post::find($id);
        return view('/admin/editPost',[
            'post'=> $post
        ]);
    }

        //update user tasks in  DB
    public function updatePost(Request $request, $id)
    {
            $post  = Post::find($id);
            $post->Title = $request->Title;
            $post->Text  = $request->Text;
            $post->save();
            return redirect('/admin/'.$post->user_id.'/show');
        }


     // Add the new user in DB by fetching details from createUser Blade

    public function StoreUser(Request $request )
    {
        $this->validate($request,[
//            'name'=>'required' ,
//            'password'=>'required',
//            'email'=>'required'
        ]);
        $password = bcrypt($request->password);
        $user = new User;
        $user->name = $request->name;
        $user->password = $password;
        $user->email = $request-> email;
       if($request->hasFile('image')){
           $file = $request->file('image');
           $filename = $file->getClientOriginalName();
           $file->move('userimg',$filename );
           $user->image =  $filename;
       }

       $user->save();
       event(new NewCustHasRegEvent($user));
          return redirect('/admin/index');
    }


    //delete user
    public function destroyUser($id)
    {
        $user = User::find($id);
            if($user->Role == 'admin') {
                return redirect('/admin/index')->with('message', "Operation Not Allowed " );
            }else if( $user->posts->count() != 0  ){
                return redirect('/admin/index')->with('message', "This user has task pending" );
            }
            else{
                $user->delete();
                return redirect('/admin/index');
            }
    }
    //Create user task
    public function createTask()
    {
        $users = User::all();
        return view('admin.createTask',[
            'users'=>$users
        ]);
    }
    public function destroyPost($id)
    {

        $Post = Post::find($id);
        $Post->delete();
        return redirect('/admin/index');
}

        // Files Upload section
    public function uploads($id){
            $user = User::find($id);
            $user_id = $id;
            //  $uploads = upload::find($user_id);
            $uploads = DB::select('select * from uploads where user_id='.$id);
            return view('admin/uploads',[
                  'uploads' => $uploads,
                  'users' => $user
            ]);}



    public function uploadfiles(Request $request , $id){
                   $this->validate($request,[
                  'file' => 'required|mimes:pdf,xlx,csv,jpeg|max:2048',
        ]);

        $user = User::find($id);
         if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
//           storeAs('upload', $filename);
//           Storage::put( $filename, '');
            $file->move('storage',$filename );


            Upload::create([
                'user_id' => $user->id,
                'path'=>$filename,
            ]);
           return redirect('/admin/'.$user->id.'/uploads')->with('success' , 'File Uploaded');
       }
       else{
           return redirect('/admin/'.$user->id.'/uploads')->with('message','Select file to upload');
       }
    }
    public function deletefiles($id,$uid){
        $file = Upload::find($id);
        $file->delete();
        return redirect('/admin/'.$uid.'/uploads');
    }
    public function downloadfiles($id){
        $file = Upload::find($id);
        $path = $file->path;
        $filepath = public_path('/storage/').$path;
        return Response::download($filepath);
    }

    public function assigntask(){
   $user = User::All();
        $posts = Post::all();
        $post=DB::select("select * from posts where user_id  is null");

        return  view('/admin/assigntask',[

            'posts'=>$post,
            'users' => $user


        ]);

    }
    public function assignedTask(Request $request, $id)
    {
        $name = $request->user;
        $users = User::where('name',$name)->get();
        foreach ($users as $user)
        {
          $user_id = $user->id;
        }
        $post  = Post::find($id);
        $post->user_id  = $user_id;
        $post->save();
        return redirect('/admin/');
    }


    public function Search(Request $request)
    {

        $name = $request->input;

        $user = DB::table('users')->where('name', 'LIKE', '%' . $name . '%')->get();
//         $found = User::where('name' , 'LIKE' .'%'. $name. '%' )->get();
        return view('/admin/indexs', [

            'users' => $user


        ]);

    }

    public function message(){
        return view('admin.mail');
        }








}
