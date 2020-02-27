<?php

namespace App\Http\Controllers;

use App\Coment;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('savelinks');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser($id_type)
    {

        $id_type_user = $id_type;
        return view('newComment',compact('id_type_user'));
    }

    public function createVideo($id_type)
    {

        $id_type_video = $id_type;
        return view('newComment',compact('id_type_video'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $body = $request->input('body');
        $id_type_video = $request->input('id_type_video');
        $id_type_user = $request->input('id_type_user');

        $user_id = Auth::user()->id;
        $comment = new Coment;
        $comment->body = $body;
        $comment->user_id = $user_id;

        if (isset($id_type_video)){
            $type = Video::find($id_type_video);

        }elseif (isset($id_type_user)){
            $type = User::find($id_type_user);

        }

        $comment = $type -> comments() -> save($comment);



        return redirect('/'); // Will redirect 2 links back

        //return redirect('/');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $comment = Coment::find($id);
        if ($comment->user_id == Auth::user()->id){
            return view('newComment', compact('comment'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $body = $request->input('body');

        Coment::where('id',$id)->update(array('body' => $body));
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coment::find($id)->delete();
        return redirect(session('links')[2]);
    }
}
