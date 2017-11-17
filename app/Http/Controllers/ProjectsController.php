<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use App\Project;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            //$companies = Company::all();
            $companies = Company::all();
            $projects = Project::where('user_id',Auth::user()->id)->get();
            return view('projects.index',['companies'=>$companies, 'projects'=> $projects]);
        }
        return view('auth.login');

    }

    public function indexAll()
    {
        if(Auth::check()){
            //$companies = Company::all();
            $companies = Company::all();
            $projects = Project::all();
            return view('projects.indexAll',['companies'=>$companies, 'projects'=> $projects]);
        }
        return view('auth.login');

    }

    public function create()
    {
        $companies = Company::all();
        return view('projects.create',compact('companies'));
    }


    public function store(Request $request)
    {
        $this->validate(request(),[ //It validates if title and body is set properly
            'name' => 'required',
            'description' => 'required',
            'company_id' => 'required'
            //'user_id' => auth()->id()

        ]);

        if(Auth::check()) { //Must be logged in
            $post = new Project;
            $post->name = request('name');
            $post->description = request('description');
            $post->user_id = auth()->id();

            $post->company_id = request('company_id');

            $tempProjectID = Company::where('name', request('company_id'))->get();
            $projectID = $tempProjectID[0]->id;
            $post->company_id = $projectID;
            $post->save();

            //$company = Company::create([$request->all()]);
            //$company = Company::create($request->all());



            if ($post) {
                session()->flash(
                    'message', 'Post is published!!'
                );
                return redirect()->route('projects.show', ['project' => $post->id])
                    ->with('success', 'Created Company');
            }

        }
        return back()->withInput()->with('errors','Error !!! Company could not be created!!');
    }

    public function show($id)
    {
        $project = Project::find($id);
        //$comments = Comment::where('commentable_id',);

        /*
        $comments = Comment::where([
            ['commentable_type', '=', 'App\Project'],
            ['commentable_id', '=', $id],
        ])->get();

        */
        //$comments = Comment::all();

        $comments = $project->comments;

     
        $comp = Company::find($project->company_id);
        return view('projects.show',['project' => $project,'comp' => $comp, 'comments' => $comments]);
        //dd($comp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $project = Project::find($id);
        $comp = Company::find($project->company_id);

        $companies = Company::all();
        if(Auth::check()) {
            if($project->user_id == auth()->id())
            return view('projects.edit',['project' => $project , 'comp' => $comp , 'companies' => $companies]);
        }

        return "You cheater :> go away ";

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $projectToUpdate = Project::where('id', $id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "days" => $request->days
        ]);

        if($projectToUpdate){
            return redirect()->route('projects.show',['project'=>$id])
                ->with('success','Project Updated successfully!!!');
        }

        return back()->withInput();
    }


    public function destroy($id)
    {
        $companyToDelete = Project::find($id);
        if($companyToDelete->delete())
        {
            return redirect()->route("projects.index")
                ->with('success','Project deleted successfully!!');
        }
        return back()->withInput()->with('Error','Project could not be deleted!!');
        //To delete
        /*
        $companyDelete = Company::where('id', $id)->delete;

        if($companyDelete){
            return redirect()->route('/')
                ->with('success','Company Deleted!!!');
        }

        return back()->withInput();

        */
    }

    public function addUser(Request $request)
    {
        //dd($request->all());

        $project = Project::find($request->projectID);

        if(Auth::user()->id == $project->user_id){
            //$user = User::where('email','=',$request->email)->get(); //Used to get all the collections
            $user = User::where('email','=',$request->email)->first(); //Used to get single record
            if(!$user)
                return redirect()->route('projects.show',['project'=> $request->projectID])
                    ->with('success', $request->email. ' is not a valid user!!!');

            $projectUser = ProjectUser::where([
                ['project_id','=',$project->id],
                ['user_id','=',$user->id]
            ])->first();

            if($projectUser){

                //dd($projectUser);
                return redirect()->route('projects.show',['project'=> $request->projectID])
                    ->with('success', $request->email. ' is already a member of this project!!!');
            }

            if($user && $project){
                $project->users()->attach($user->id); //project-user many to many

                return redirect()->route('projects.show',['project'=> $request->projectID])
                    ->with('success','User added successfully!!!');
            }
        }

        return redirect()->route('projects.show',['project'=> $request->projectID])
            ->with('error','Error!!! Could not added user!!!');
    }

}
