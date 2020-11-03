<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use DB;
use ViewController;

class CompanyController extends Controller
{
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
    public function create()
    {
        $company = Company::find(auth()->user()->company_id);
        return view('admin.company', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {		
		$company = new Company;
		$company->name = $request->company_name;
		$company->address = $request->address;
		$company->save();
		$companyID = $company->id;
		$user = new User;
		$user->name = $request->admin_name;
		$user->email = $request->admin_email;
		$user->password = $request->admin_pass;
		$user->company_id = $companyID;
		if ($name=$request->input('admin_name')){
		   $user->user_type = ('admin');
		}
		$user->save();
		$user = new User;
		$user->name = $request->mng_name;
		$user->email = $request->mng_email;
		$user->password = $request->mng_pass;
		$user->company_id = $companyID;
		if ($name=$request->input('mng_name')){
		   $user->user_type = ('manager');
		}
		$user->save();	
		return redirect()->to('/success');
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
        //
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
        $request->validate([
            'name'=>'required',
        ]);

        $company = Company::find($id);
        $company->name = $request->get('name');
        $company->address = $request->get('address');
        $company->save();
        return back()->with('success', 'Company details successfully updated!');
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
}
