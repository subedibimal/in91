<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\SubCity;
use Illuminate\Http\Request;

class SubCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCities = SubCity::latest()->with(['city'])->get();
        $cities = City::paginate(15);
        // $countries = Country::where('status', 1)->with(['cities'])->get();
         return view('backend.setup_configurations.sub-city.index', compact('subCities','cities'));
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
       $this->validate($request,[
        'name' => 'required',
        'city_id' => 'required',

       ]);
       $information = new SubCity;
       $information->city_id = $request->city_id;
       $information->name = $request->name;
       $information->cost = $request->cost;
       $information->save();
       return back()->with('msg', 'Information Saved');
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
         $sub_city  = SubCity::findOrFail($id);
         $cities = City::all();
         return view('backend.setup_configurations.sub-city.edit', compact('cities','sub_city'));
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
        $sub_city = SubCity::findOrFail($id);
        $sub_city->name = $request->name;
        $sub_city->city_id = $request->city_id;
        $sub_city->cost = $request->cost;
        $sub_city->save();

        flash(translate('Sub City has been updated successfully'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_city = SubCity::findOrFail($id);
        SubCity::destroy($id);

        flash(translate('Sub City has been deleted successfully'))->success();
        return redirect()->route('sub-city.index');
    }
}
