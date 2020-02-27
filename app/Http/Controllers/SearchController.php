<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request, $scope = null, $word = null, $order = null){

       if ($request->isMethod('post') && $request->input('search') != null){

            $word = $request->input('search');
            $order = $request->input('order');
            $scope = $request->input('scope');

            return redirect('search/'.$scope.'/'.$word.'/'.$order);
        }

       if ($request->isMethod('get')){
           if ($scope != null && $word != null){

               if ($scope == 'video'){
                   $view = $this->videos($word, $order);
               }elseif ($scope == 'user'){
                   $view = $this->users($word, $order);
               }else{
                   $view = redirect('/');
               }

               return $view;
           }
       }

       return redirect('/');




    }

    public function videos ($word, $order){

        if ($order == 1){
            $videos = Video::where('title','LIKE', '%'.$word.'%')->orderBy('created_at','ASC')->paginate(4);
        }elseif ($order == 2){
            $videos = Video::where('title','LIKE', '%'.$word.'%')->orderBy('created_at','DESC')->paginate(4);
        }elseif ($order == 3){
            $videos = Video::where('title','LIKE', '%'.$word.'%')->orderBy('title','ASC')->paginate(4);
        }else{
            $videos = Video::where('title','LIKE', '%'.$word.'%')->paginate(4);
        }



        return view('home', compact('videos', 'word','order'));


    }

    public function users ($word, $order){

        if ($order == 1){
            $users = User::where('name','LIKE', '%'.$word.'%')->orWhere('surname','LIKE', '%'.$word.'%')->orderBy('created_at','ASC')->paginate(4);
        }elseif ($order == 2){
            $users = User::where('name','LIKE', '%'.$word.'%')->orWhere('surname','LIKE', '%'.$word.'%')->orderBy('created_at','DESC')->paginate(4);
        }elseif ($order == 3){
            $users = User::where('name','LIKE', '%'.$word.'%')->orWhere('surname','LIKE', '%'.$word.'%')->orderBy('name','ASC')->paginate(4);
        }else{
            $users = User::where('name','LIKE', '%'.$word.'%')->orWhere('surname','LIKE', '%'.$word.'%')->paginate(4);
        }


        return view('users', compact('users', 'word','order'));


    }

}
