<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = City::all();
        return response()->view('cms.cities.index' , ['cities' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3|max:45'
        ] , [
            'name.required'=>'Enter city name!',
            'name.min'=> 'Please enter at least 3 characters'
        ]);
        //$request->all
        $city=new City();
        // $city->name=$request->get('name');
        // $city->name=$request->name;
        $city->name=$request->input('name');
        $isSaved = $city->save();
        session()->flash('alert-type', $isSaved ? " success" :" danger");
        session()->flash('message', $isSaved ? "Created Successfully" :"Created failed!");
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\City $request
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
        dd('We are Here');
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
        return response()->view('cms.cities.edit',['city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        // 
        $request->validate([
            'name' => 'required|string|min:3|max:45'
        ]);

        $city->name = $request->input('name');
        $isUpdated = $city->save();
        session()->flash('message', $isUpdated ? "Updated Successfully" :"Updated failed!");
        session()->flash('alert-type', $isUpdated ? " success" :" danger");
        return redirect()->route('cities.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
