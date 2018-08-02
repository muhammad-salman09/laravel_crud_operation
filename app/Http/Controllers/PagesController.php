<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title='welcome to laravel';
      //  return view('pages.index', compact('title'));
      return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title='About';
       // return view ('pages.about' ,compact('title'));
       return view('pages.about_us')->with('title',$title);
    }

    public function services(){
       $data=array (
           'title' =>'Services',
           'services'=> ['web design','programing','SEO']
           
       );
       // return view('pages.services', compact('title'));
       return view('pages.services')->with($data);
    }
}
