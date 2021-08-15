<?php

namespace App\Http\Controllers;

use App\Assigned;
use Illuminate\Http\Request;

class AssignedController extends Controller
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
        dd($request->all());
        $assigned = Assigned::create($request->all());

        if(!$assigned){
            Toastr::error('Field to Assigned! please try again!!!');
            return redirect()->route('tasks.index');
            return back();
        }else {
            Toastr::success('User Assigned Successfully!!!');
            return redirect()->route('tasks.index');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assigned  $assigned
     * @return \Illuminate\Http\Response
     */
    public function show(Assigned $assigned)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assigned  $assigned
     * @return \Illuminate\Http\Response
     */
    public function edit(Assigned $assigned)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assigned  $assigned
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assigned $assigned)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assigned  $assigned
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assigned $assigned)
    {
        //
    }
}
