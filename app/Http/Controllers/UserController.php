<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Mailgun\Mailgun;
use Mailgun\HttpClient\HttpClientConfigurator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('savelinks');

        $this->middleware(function ($request, $next) { $request->session()->put('scope', 'user'); return $next($request); });


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);
        $videos = $user->videos;
        $comments = $user->comments;
        $ownComments = $user->commentsUser;

        return view('user', compact('user', 'videos', 'comments', 'ownComments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user->id == Auth::user()->id){
            return view('auth.register', compact('user'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $getUser = User::find($id);

        $upImage = $request->file('image');
        $filenameI = time().$upImage->getClientOriginalName();
        Storage::disk('images') -> put($filenameI, file_get_contents($upImage -> getRealPath()));
        Storage::disk('images') -> delete($getUser->image);

        $getUser->update(array('name' => $name, 'surname' => $surname, 'email' => $email, 'password' => $password, 'image' => $filenameI));
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
        //
    }

    public function getAvatar($id)
    {
        $user = User::find($id);
        $name = $user->image;
        $fileContents = Storage::disk('images')->get($name);
        $response = Response::make($fileContents, 200);
        return $response;
    }

    public function sendNotificationAll(Request $request){

        $password = $request->input('password');

        if (Auth::user()->role == 1){
            $users = User::All();

            foreach ($users as $user){

                $username = $user->name;
                $mail = $user->email;

                //With API Library
                //https://documentation.mailgun.com/en/latest/libraries.html#php
                //nyholm/psr7 -> comunicacion HTTP
                $mg = Mailgun::create('659cd97fcae8213d953dfe4470deeca7-0a4b0c40-6205ef70'); // US
                //$mg = Mailgun::create('key-example', 'https://api.eu.mailgun.net'); // EU

                $mg->messages()->send('sandboxc41b1474a32d43aaa7d67f37bcfedbca.mailgun.org', [
                    'from'    => 'rentarorex@gmail.com',
                    'to'      => $mail,
                    'subject' => 'Hello '.$username,
                    'text'    => 'The API will be out of order the next week.'
                ]);



                Mail::to($mail)->send(new \App\Mail\Notification($username));


            }

            $check = 1;
        }else{
            $check = 2;
        }


        return view('sendNotification')->with(['check' => $check]);
    }
}
