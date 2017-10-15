<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tower;
use Validator;
use Config;

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
		$mtaname = Tower::groupBy('mtaname')->pluck('mtaname')->toArray();
		$btaname = Tower::groupBy('btaname')->pluck('btaname')->toArray();
		$country = Config::get('services.countires');
		$state = Config::get('services.states');
		$city = Tower::groupBy('city')->pluck('city')->toArray();
		$infication = Tower::groupBy('infication')->pluck('infication')->toArray();

		$request->towerowner ? $r_towerowner = [$request->towerowner] : $r_towerowner = $towerowner;
		$request->mtaname ? $r_mtaname = [$request->mtaname] : $r_mtaname = $mtaname;
		$request->btaname ? $r_btaname = [$request->btaname] : $r_btaname = $btaname;
		$request->country ? $r_country = [$request->country] : $r_country = array_keys($country);
		$request->state ? $r_state = [$request->state] : $r_state = array_keys($state);
		$request->city ? $r_city = $request->city : $r_city ='%' ;
		$request->address ? $r_address = $request->address : $r_address ='%' ;
		$request->fccnumber ? $r_fccnumber = $request->fccnumber : $r_fccnumber ='%' ;
		$request->sitename ? $r_sitename = $request->sitename : $r_sitename ='%' ;
		$request->infication ? $r_infication = $request->infication : $r_infication ='%' ;
	
		$towers = Tower::
			whereIn('towerowner',$r_towerowner)->
			whereIn('mtaname',$r_mtaname)->
			whereIn('btaname',$r_btaname)->
			whereIn('country',$r_country)->
			whereIn('state',$r_state)->
			where('city','like','%'.$r_city.'%')->
			where('address','like','%'.$r_address.'%')->
			where('fccnumber','like','%'.$r_fccnumber.'%')->
			where('sitename','like','%'.$r_sitename.'%')->
		get();		
	
		$request->form ? $form=$request->form : $form=1;

        return view('home',[
							'towers'=>$towers,'form'=>$form,
							'towerowner'=>$towerowner,'r_towerowner'=>$request->towerowner,
							'mtaname'=>$mtaname,'r_mtaname'=>$request->mtaname,
							'btaname'=>$btaname,'r_btaname'=>$request->btaname,
							'country'=>$country,'r_country'=>$request->country,
							'state'=>$state,'r_state'=>$request->state,
							'city'=>$city,'r_city'=>$r_city,
							'r_address'=>$r_address,
							'r_fccnumber'=>$r_fccnumber,
							'r_sitename'=>$r_sitename,
							'infication'=>$infication,'r_infication'=>$r_infication,
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
