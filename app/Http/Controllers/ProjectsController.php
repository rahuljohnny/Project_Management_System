<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $projects = Project::all();
        return view('projects.index',['companies'=>$companies, 'projects'=> $projects]);
    }

    public function create()
    {
        $companies = Company::all();
        return view('projects.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[ //It validates if title and body is set properly
            'name' => 'required',
            'description' => 'required',
            'company_id' => 'required'
            //'user_id' => auth()->id()

        ]);

        if(Auth::check()) {
            $post = new Project;
            $post->name = request('name');
            $post->description = request('description');
            $post->user_id = auth()->id();

            $post->company_id = request('company_id');

            $tempProjectID = Company::where('name', request('company_id'))->get();
            $projectID = $tempProjectID[0]->id;
            $post->company_id = $projectID;


            //dd($post->company_id);
            $company = $post->save();

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $project = Project::find($id);

        $comp = Company::find($project->company_id);
        return view('projects.show',['project'=>$project,'comp'=>$comp]);
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
        return view('projects.edit',['project' => $project , 'comp' => $comp , 'companies' => $companies]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */


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

}
