<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tower;
use Validator;
use Config;

class TowerController extends Controller
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
