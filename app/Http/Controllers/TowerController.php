<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tower;
use Validator;
use Config;
use DB;

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
		$towerowner = Tower::groupBy('towerowner')->pluck('towerowner')->toArray();		
		$country = Tower::groupBy('country')->pluck('country')->toArray();	
		$state = Tower::groupBy('state')->pluck('state')->toArray();
		$city = Tower::groupBy('city')->pluck('city')->toArray();
		$infication = Tower::groupBy('infication')->pluck('infication')->toArray();

		if(isset($request->towerowner)){
			if($request->towerowner[0]=='all')
				$r_towerowner = $towerowner;
			else
				$r_towerowner = $request->towerowner;
		}
		else
			$r_towerowner = $towerowner;

		if(isset($request->city)){
			$r_city = $request->city;
		}
		else
			$r_city = $city;
		if(isset($request->country)){
			$r_country = $request->country;
		}
		else
			$r_country = $country;
		if(isset($request->state)){
			$r_state = $request->state;
		}
		else
			$r_state = $state;
		if(isset($request->infication)){
			$r_infication = $request->infication;
		}
		else
			$r_infication = $infication;

		$type= explode('_',$request->type)[0];

		$request->latitude ? $latitude = $request->latitude : $latitude =   41.949101 ;
		$request->longitude ? $longitude = $request->longitude :  $longitude = -101.148345;
		$request->radius ? $distance = $request->radius : $distance =  10000  ;

		$towers = Tower::
			whereIn('towerowner',$r_towerowner)->
			whereIn('city',$r_city)->
			whereIn('country',$r_country)->
			whereIn('state',$r_state)->
			whereIn('infication',$r_infication)->
			where(function($q) use ($latitude, $longitude, $distance) {
				$q->filterByLocationAndDistance($latitude, $longitude, $distance);
			})->
		paginate(10);

        return view('home',[
							'towers'=>$towers,'type'=>$type,
							'towerowner'=>$towerowner,'r_towerowner'=>$request->towerowner,
							'country'=>$country,'r_country'=>$request->country,
							'state'=>$state,'r_state'=>$request->state,
							'city'=>$city,'r_city'=>$request->city,
							'infication'=>$infication,'r_infication'=>$request->infication,
							'google_api'=>Config::get('google.setDeveloperKey'),
			                'r_radius'=>$distance, 'r_latitude'=>$latitude,'r_longitude'=>$longitude
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
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'towerid'  => 'string|max:255|unique:towers',                        
        ])->validate();
		
		$tower = new Tower();
		$tower->towerid = $request->towerid ;
		$tower->sitename = $request->sitename ;
		$tower->address = $request->address ;
		$tower->country = $request->country ;
		$tower->state = $request->state ;
		$tower->city = $request->city ;
		$tower->zipcode = $request->zipcode ;
		$tower->latitude = $request->latitude ;
		$tower->longitude = $request->longitude ;
		$tower->height = $request->height ;
		$tower->structuretype = $request->structuretype ;
		$tower->infication = $request->infication ;
		$tower->firstname = $request->firstname ;
		$tower->lastname = $request->lastname ;
		$tower->phone = $request->phone ;
		$tower->email = $request->email ;
		$tower->region = $request->region ;
		$tower->towerowner = $request->towerowner ;
		$tower->towerownershort = $request->towerownershort ;
		$tower->btanumber = $request->btanumber ;
		$tower->btaname = $request->btaname ;
		$tower->mtanumber = $request->mtanumber ;
		$tower->mtaname = $request->mtaname ;
		$tower->newsite = $request->newsite ;
		$tower->fccnumber = $request->fccnumber ;
		$tower->stimsiteid = $request->stimsiteid ;
		$tower->save();
		
		return redirect('home')->with('message','Tower details Successfully added');
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
        $tower = Tower::find($id);
		$countires = Config::get('services.countires');
		$states = Config::get('services.states');
		
		if(!$tower)
			return abort(404);
		
		return view('tower-form',['tower'=>$tower,'countires'=>$countires,'states'=>$states]);
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
        Validator::make($request->all(), [
            'towerid'  => 'string|max:255|unique:towers,towerid,'.$id.',id',                        
        ])->validate();
		
		$tower = Tower::find($id);
		$tower->towerid = $request->towerid ;
		$tower->sitename = $request->sitename ;
		$tower->address = $request->address ;
		$tower->country = $request->country ;
		$tower->state = $request->state ;
		$tower->city = $request->city ;
		$tower->zipcode = $request->zipcode ;
		$tower->latitude = $request->latitude ;
		$tower->longitude = $request->longitude ;
		$tower->height = $request->height ;
		$tower->structuretype = $request->structuretype ;
		$tower->infication = $request->infication ;
		$tower->firstname = $request->firstname ;
		$tower->lastname = $request->lastname ;
		$tower->phone = $request->phone ;
		$tower->email = $request->email ;
		$tower->region = $request->region ;
		$tower->towerowner = $request->towerowner ;
		$tower->towerownershort = $request->towerownershort ;
		$tower->btanumber = $request->btanumber ;
		$tower->btaname = $request->btaname ;
		$tower->mtanumber = $request->mtanumber ;
		$tower->mtaname = $request->mtaname ;
		$tower->newsite = $request->newsite ;
		$tower->fccnumber = $request->fccnumber ;
		$tower->stimsiteid = $request->stimsiteid ;
		$tower->save();
		
		return redirect('home')->with('message','Tower details Successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tower = Tower::find($id);		
		$tower->delete();
		
		return redirect('home')->with('message','Tower Successfully deleted');
		
		
    }
}
