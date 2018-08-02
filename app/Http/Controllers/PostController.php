<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
class PostController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Gave the permissions that can a person do which is guest
        //$this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for all
        //$posts=Post::all();
        //Using DataBase
        //$posts=DB::select('SELECT *FROM posts');
        //for get individual
        //return Post::where('title', 'post three')->get();
        //to get only one 
       // $posts = Post::orderby('title', 'asc')->take(1)->get();
       //for paginantion **just go to index and under the foreach put {{$posts->links()}}**
       //$posts = Post::orderby('title', 'asc')->paginate(1);
       
       $posts = Post::orderby('id', 'asc')->get();
        return view ('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate our request to storein our database
        $this->validate($request, [
             'title' => 'required',
             'body'=>'required',
             'coverimage'=>'image|nullable|max:1999'
    ]);
            //Handle File Uploading
            if($request->hasFile('coverimage')){
                //Get File Name with extension
                    $filenameWithExt = $request->file('coverimage')->getClientOriginalName();
                    //get just filname
                    $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
                    //just get extension
                    $extension = $request->file('coverimage')->getClientOriginalExtension();
                    //Get filename
                    $fileNameToStore=$filename.'_'.time().'.'.$extension;
                    //uplaod file
                    $path = $request->file('coverimage')->storeAs('public/coverimage,',$fileNameToStore);
            }else{
                    $fileNameToStore='noimage.jpg';
            }
           //create new post
                    $post = new Post;
                   //For input title
                    $post->title = $request->input('title');
                   //For input Post Body
                    $post->body = $request->input('body');
                   //For User Authentication
                    $post->user_id = auth()->user()->id;
                   //For store a file
                    $post->coverimage = $fileNameToStore;
                   //fFor Save the Post
                    $post->save();
           //Redirect To The Required Page
           return redirect('/post')->with('success','post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show the Full escription Of a Post
                $post= Post::find($id);
                return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
                $post=Post::find($id);
                //Check For Correct User
                if(auth()->user()->user_role!=='admin'){
                    return redirect('post')->with('error','Unathorized Page');
                } 
                //return us the view of post
                return view('posts.edit')->with('post',$post);
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
        //For Validation of Our Post
        $this->validate($request, [
            'title' => 'required',
            'body'=>'required'
   ]);
     //Handle File Uploading
     if($request->hasFile('coverimage')){
        //Get File Name with extension
                $filenameWithExt = $request->file('coverimage')->getClientOriginalName();
                //get just filname
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
                //just get extension
                $extension = $request->file('coverimage')->getClientOriginalExtension();
                //Get filename
                $fileNameToStore=$filename.'_'.time().'.'.$extension;
                //uplaod file
                $path = $request->file('coverimage')->storeAs('public/coverimage,',$fileNameToStore);
    }
          //get post
                $post=Post::find($id);
                //For input title
                $post->title=$request->input('title');
               //For input Post Body
                $post->body=$request->input('body');
              //For check the File Request
              if($request->hasFile('coverimage')){
                  $post->coverimage=$fileNameToStore;
          }
          //For save
          $post->save(); 
          return redirect('/post')->with('success','post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        //Check that Post is Uploaded By the Viewr Or not ,viewr can only check the post but can not change
        if(auth()->user()->id !==$post->user_id){
            return redirect('post')->with('error', 'Unauthorized page');
        }
        if($post->coverimage != 'noimage.jpg'){
            Storage::delete('public/coverimage,/'.$post->coverimage);
        }
        //for delete
        $post->delete();
        //redirect us on post page/blog page
        return redirect('/post')->with('success','Post Deleted Successfuly');
    }

    public function only_admin_can_view(){

        echo "admin function";
        if(user){
            
        }
    }
    public function only_user_can_view(){

        echo "user function";
        if(admin){
           
        }
    }
}
