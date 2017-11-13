<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index',['companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view("companies.create",compact('users'));
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
            //'user_id' => auth()->id()

        ]);

        if(Auth::check()) {
            $post = new Company;
            $post->name = request('name');
            $post->description = request('description');
            $post->user_id = auth()->id();

            $company = $post->save();

            //$company = Company::create([$request->all()]);
            //$company = Company::create($request->all());


            if ($post) {
                session()->flash(
                    'message', 'Post is published!!'
                );
                return redirect()->route('companies.show', ['company' => $post->id])
                ->with('success', 'Created Company');
            }

        }

        return back()->withInput()->with('errors','Error !!! Company could not be created!!');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comp = Company::find($id);
        return view('companies.show',['comp'=>$comp]);
        //dd($comp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comp = Company::find($id);
        return view('companies.edit',['comp'=>$comp]);
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
        $companyUpdate = Company::where('id', $id)->update([
            "name"=>$request->name,
            "description"=>$request->description
        ]);

        if($companyUpdate){
            return redirect()->route('companies.show',['company'=>$id])
                ->with('success','Company Updated successfully!!!');
	    }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companyToDelete = Company::find($id);
        if($companyToDelete->delete())
        {
            return redirect()->route("companies.index")
                ->with('success','Company deleted successfully!!');
        }
        return back()->withInput()->with('Error','Company could not be deleted!!');
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
