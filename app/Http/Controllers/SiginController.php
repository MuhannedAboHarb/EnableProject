<?php

namespace App\Http\Controllers;

use App\Models\Sigin;
use Illuminate\Http\Request;

class SiginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Sigin::all();
        return response()->view('cms.sigines.index' , ['sigines' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sigin $sigin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sigin $sigin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sigin $sigin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sigin $sigin)
    {
        //
    }
}
