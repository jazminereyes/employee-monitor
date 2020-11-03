<?php

namespace App\Http\Controllers;
use App\User;
use App\MonitoringRecord;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Company;
use ViewController;
use Redirect,Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$users = User::where('user_type' , 'employee')->get();
		return view('admin.dashboard', compact('users'));
		//return redirect()->to('admin/home');
		//compact('users');
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

		$request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
			'break_time'=>'required'
        ]);

        $newEmployee = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'break_time_start' => $request->get('break_time'),
            'company_id' => auth()->user()->company_id
			]);
			if ($name=$request->input('name')){
		    $newEmployee->user_type = ('employee');
			}
        
        $newEmployee->save();
        return redirect()->route('admin.home')->with('success', 'New user saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where("id", $id)->get();
        $records = DB::table('monitoring_records')
                     ->select(DB::raw('count(*) as record_count, user_id, DATE_FORMAT(created_at, "%Y-%m-%d") as datetaken'))
                     ->where("user_id",$id)
                     ->groupBy(['datetaken','user_id'])
                     ->get();
        return view('monitor-dates', compact("user","records"));
    }

    public function edit($id)
    {	
		//$newEmployees = User::find($id);
       // return view('admin', compact('newEmployees')); 
		//echo $newEmployees->id;
    }

    public function update(Request $request, $id)
    {

       $request->validate([
            'name'=>'required',
            'email'=>'required',
			'password'=>'required',
			'break_time'=>'required'
        ]);
		
		$newEmployees = User::find($id);
        $newEmployees->name =  $request->get('name');
        $newEmployees->email = $request->get('email');
		$newEmployees->password = $request->get('password');
		$newEmployees->break_time_start = $request->get('break_time');
        $newEmployees->save();
		
		$newEmployees->save();
        return redirect('users')->with('success', 'user updated!');
    }
	

    public function destroy($id)
    {
		$olduser = User::find($id);
        $olduser->delete();

        return back()->with('success', 'User is now deleted!');

    }


    public function show_record($id, $year, $month, $day)
    {
        $user = User::where("id", $id)->get();
        
        $camerarecords = DB::table('monitoring_records')
                    ->where([["created_at","LIKE", "%" . $year . "-" . $month . "-" . $day  . "%"],["image_type","=","camera"],["user_id","=",$id]])
                     ->get();
        $screenrecords = DB::table('monitoring_records')
                    ->where([["created_at","LIKE", "%" . $year . "-" . $month . "-" . $day  . "%"],["image_type","=","screen"],["user_id","=",$id]])
                    ->get();
        return view('monitor-record', compact("user","screenrecords","camerarecords", "year", "month", "day"));
    }
	
	
}
