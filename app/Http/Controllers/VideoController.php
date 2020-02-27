<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
{

    public function __construct()
    {
        $this->middleware('savelinks');

        $this->middleware(function ($request, $next) { $request->session()->put('scope', 'video'); return $next($request); });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($search = null, $type = null)
    {

        $videos = Video::paginate(4);
        return view('home', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newVideo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = new Video;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->user_id = Auth::user()->id;

        $upVideo = $request->file('video');
        $filenameV = time().$upVideo->getClientOriginalName();
        Storage::disk('videos') -> put($filenameV, file_get_contents($upVideo -> getRealPath()));

        $upImage = $request->file('thumbnail');
        $filenameI = 'a/'.time().$upImage->getClientOriginalName();
        Storage::disk('images') -> put($filenameI, file_get_contents($upImage -> getRealPath()));

        $video->video_path = $filenameV;
        $video->image = $filenameI;

        $video->save();

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $video = Video::find($id);
        $comments = $video->comments;

        return view('video', compact('video','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        if ($video->user_id == Auth::user()->id){
            return view('newVideo', compact('video'));
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
        $title = $request->input('title');
        $description = $request->input('description');
        $getVideo = Video::find($id);

        $upVideo = $request->file('video');
        $filenameV = time().$upVideo->getClientOriginalName();
        Storage::disk('videos') -> put($filenameV, file_get_contents($upVideo -> getRealPath()));
        Storage::disk('videos') -> delete($getVideo->video_path);

        $upImage = $request->file('thumbnail');
        $filenameI = time().$upImage->getClientOriginalName();
        Storage::disk('images') -> put($filenameI, file_get_contents($upImage -> getRealPath()));
        Storage::disk('images') -> delete($getVideo->image);

        $getVideo->update(array('title' => $title, 'description' => $description, 'video_path' => $filenameV, 'image' => $filenameI));
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getVideo = Video::find($id);
        Storage::disk('images') -> delete($getVideo->image);
        Storage::disk('videos') -> delete($getVideo->video_path);
        $getVideo->delete();

        return redirect('dashboard');
    }

    public function getVideo($id)
    {
        $video = Video::find($id);
        $name = $video->video_path;
        $fileContents = Storage::disk('videos')->get($name);

        return $fileContents;
    }

    public function getThumb($id)
    {
        $video = Video::find($id);
        $name = $video->image;
        $fileContents = Storage::disk('images')->get($name);

        return $fileContents;
    }


}
