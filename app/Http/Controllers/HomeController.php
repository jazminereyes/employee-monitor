<?php

namespace App\Http\Controllers;
use App\User;
use App\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $company = Company::find(auth()->user()->company_id)->get();
        $frequency = ($company[0]->frequency == "random")?0:1;
        $interval = 0;
        switch($company[0]->interval){
            case "second": $interval = 0; break;
            case "minute": $interval = 1; break;
            case "hour": $interval = 2; break;
        }
        $duration = $company[0]->duration;
        return view('employee.dashboard',compact("frequency","interval","duration"));
    }

    public function admin()
    {
        $users = User::where([
            ['id', "<>", Auth::user()->id],
            ['company_id', Auth::user()->company_id],
        ])
        ->orderBy('name', 'desc')
        ->get();
        return view('admin.dashboard', compact('users'));
    }

    public function manager()
    {
        $users = User::where([
            ['company_id', Auth::user()->company_id],
            ['user_type', "<>", "admin"],
        ])
        ->orderBy('name', 'desc')
        ->get();
        
        $company = Company::find(auth()->user()->company_id)->get();
        $frequency = ($company[0]->frequency == "random")?0:1;
        $interval = 0;
        switch($company[0]->interval){
            case "second": $interval = 0; break;
            case "minute": $interval = 1; break;
            case "hour": $interval = 2; break;
        }
        $duration = $company[0]->duration;
        return view('manager.dashboard', compact('users',"frequency","interval","duration"));
    }

    public function profile(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }
        $user->save();
        return back()->with('success', 'Profile successfully updated!');
    }

    public function setting(Request $request)
    {
        $request->validate([
            'frequency'=>'required',
            'interval'=>'required',
            'duration'=>'required'
        ]);

        $company = Company::find(auth()->user()->company_id);
        $company->frequency = $request->frequency;
        $company->interval = $request->interval;
        $company->duration = $request->duration;
        $company->save();
        return back()->with('success', 'Monitoring Settings successfully updated!');
    }
}
