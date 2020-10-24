<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tower;
use App\Http\Requests\TowerRequest;
use Illuminate\Support\Facades\Config;


class TowerController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $city = Tower::groupBy('city')->pluck('city')->toArray();
        $country = Tower::groupBy('country')->pluck('country')->toArray();
        $state = Tower::groupBy('state')->pluck('state')->toArray();
        $structureclassification = Tower::groupBy('structureclassification')->pluck('structureclassification')->toArray();
        $towerowner = Tower::groupBy('towerowner')->pluck('towerowner')->toArray();

		$towers = Tower::
            where(function($q) use ($request) {
                if($request->city) $q->whereIn('city',$request->city);
            })
            ->where(function($q) use ($request) {
                if($request->country) $q->whereIn('country',$request->country);
            })
            ->where(function($q) use ($request) {
                if($request->state) $q->whereIn('state',$request->state);
            })
            ->where(function($q) use ($request) {
                if($request->structureclassification) $q->whereIn('structureclassification',$request->structureclassification);
            })
            ->where(function($q) use ($request) {
                if($request->towerowner) $q->where('towerowner',$request->towerowner);
            })
			->where(function($q) use ($request) {
			    if($request->latitude && $request->longitude && $request->radius)  $q->filterByLocationAndDistance($request->latitude, $request->longitude, $request->radius);
			})
		    ->paginate(10);

        return view('home',[
							'towers'=>$towers,
                            'type'=>explode('_',$request->type)[0],
							'towerowner'=>$towerowner,'r_towerowner'=>$request->towerowner,
							'country'=>$country,'r_country'=>$request->country,
							'state'=>$state,'r_state'=>$request->state,
							'city'=>$city,'r_city'=>$request->city,
							'structureclassification'=>$structureclassification,'r_structureclassification'=>$request->structureclassification,
							'google_api'=>Config::get('google.setDeveloperKey'),
			                'r_radius'=>$request->radius, 'r_latitude'=>$request->latitude,'r_longitude'=>$request->longitude
							]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$countires = Config::get('services.countires');
		$states = Config::get('services.states');
		
        return view('tower-form',['countires'=>$countires,'states'=>$states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TowerRequest $request)
    {
        Tower::create($request->all());
		return redirect(route('tower.index'))->with('message','Tower details Successfully added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tower = Tower::findorfail($id);
		$countires = Config::get('services.countires');
		$states = Config::get('services.states');
		return view('tower-form',['tower'=>$tower,'countires'=>$countires,'states'=>$states]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TowerRequest $request, $id)
    {
        Tower::updateOrCreate(['id' =>$id], $request->all());
        return redirect(route('tower.index'))->with('message','Tower details Successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tower::find($id)->delete();
		return redirect(route('tower.index'))->with('message','Tower Successfully deleted');
    }

}
