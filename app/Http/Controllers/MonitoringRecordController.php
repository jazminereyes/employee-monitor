<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonitoringRecord;
use App\User;
use App\Company;
use ViewController;

class MonitoringRecordController extends Controller
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
        $created_at = date('Y-m-d G:i:s');
        $expiration = date('Y-m-d G:i:s', strtotime('+5 days'));

              
        $request->validate([
            'image_type' => 'required',
            'photo' => ['required', 'image']
        ]);

        $imageUrl = $request->file('photo')->store('monitoring_uploads', ['disk' => 'public']);

        $theRecord = new MonitoringRecord;
        $theRecord->user_id = auth()->user()->id;
        $theRecord->image_type = $request->image_type;
        $theRecord->photo_url = $imageUrl;
        $theRecord->date_time_taken = $created_at;
        $theRecord->expiration = $expiration;
        $theRecord->save();
        return response()->json($theRecord, 201);
        
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
        //
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
