<?php

namespace App\Http\Controllers;
use App\Company;
use App\Project;
use App\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        /*
         * News::orderBy('created_at', 'desc')->take(10)->get();
         */
        return view('front.index',compact('projects'));
    }
}
