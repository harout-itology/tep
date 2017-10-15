@extends('layouts.app')

@section('head')

<style>
        body{
            background-image: none;
        }
</style>
	
@endsection

@section('content')
    <div class="container" style="width: 100%">
        <div class="row  ">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <h2> Tower Details</h2>
                        <form class="form-horizontal" method="POST" action="{{ @$tower->towerid ? url('/tower/'.$tower->id) : url('/tower') }}">
                            {{ csrf_field() }}
							@if(@$tower->towerid)
								{{ method_field('PUT') }}
							@endif

                            <div class="form-group{{ $errors->has('towerid') ? ' has-error' : '' }}">
                                <label for="towerid" class="col-md-2 control-label">Tower ID *</label>
                                <div class="col-md-10">
                                    <input id="towerid" type="text" class="form-control" name="towerid" value="{{ old('towerid') ? old('towerid')  :  @$tower->towerid }}" required autofocus>
                                    @if ($errors->has('towerid'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('towerid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="sitename" class="col-md-2 control-label">Site Name</label>
                                <div class="col-md-10">
                                    <input id="sitename" type="text" class="form-control" name="sitename" value="{{ old('sitename') ? old('sitename')  :  @$tower->sitename }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="address" class="col-md-2 control-label">Address</label>
                                <div class="col-md-10">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') ? old('address')  :  @$tower->address }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="country" class="col-md-2 control-label">Country</label>
                                <div class="col-md-10">
								<select id="country" class="form-control"  name="country" >
									<option value=''>Select</option>
									@foreach($countires as $key => $value)
										<option  @if(old('country') == $key) {{'selected'}} @elseif(@$tower->country == $key) {{'selected'}} @endif value='{{$key}}'>{{$value}}</option>
									@endforeach
								</select>
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="state" class="col-md-2 control-label">State</label>
                                <div class="col-md-10">
								<select id="state" class="form-control"  name="state" >
									<option value=''>Select</option>
									@foreach($states as $key => $value)
										<option  @if(old('state') == $key) {{'selected'}} @elseif(@$tower->state == $key) {{'selected'}} @endif value='{{$key}}'>{{$value}}</option>
									@endforeach
								</select>
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="city" class="col-md-2 control-label">City</label>
                                <div class="col-md-10">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city') ? old('city')  :  @$tower->city }}" >                                    
                                </div>
                            </div>
							<div class="form-group">
                                <label for="zipcode" class="col-md-2 control-label">Zip Code</label>
                                <div class="col-md-10">
                                    <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode') ? old('zipcode')  :  @$tower->zipcode }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="latitude" class="col-md-2 control-label">Latitude</label>
                                <div class="col-md-10">
                                    <input id="latitude" type="text" class="form-control" name="latitude" value="{{ old('latitude') ? old('latitude')  :  @$tower->latitude }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="longitude" class="col-md-2 control-label">Longitude</label>
                                <div class="col-md-10">
                                    <input id="longitude" type="text" class="form-control" name="longitude" value="{{ old('longitude') ? old('longitude')  :  @$tower->longitude }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="height" class="col-md-2 control-label">Height</label>
                                <div class="col-md-10">
                                    <input id="height" type="text" class="form-control" name="height" value="{{ old('height') ? old('height')  :  @$tower->height }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="structuretype" class="col-md-2 control-label">Structure Type</label>
                                <div class="col-md-10">
                                    <input id="structuretype" type="text" class="form-control" name="structuretype" value="{{ old('structuretype') ? old('structuretype')  :  @$tower->structuretype }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="infication" class="col-md-2 control-label">Infication</label>
                                <div class="col-md-10">
                                    <input id="infication" type="text" class="form-control" name="infication" value="{{ old('infication') ? old('infication')  :  @$tower->infication }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="firstname" class="col-md-2 control-label">Firstname</label>
                                <div class="col-md-10">
                                    <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') ? old('firstname')  :  @$tower->firstname }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="lastname" class="col-md-2 control-label">Lastname</label>
                                <div class="col-md-10">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') ? old('lastname')  :  @$tower->lastname }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="phone" class="col-md-2 control-label">Phone</label>
                                <div class="col-md-10">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') ? old('phone')  :  @$tower->phone }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="email" class="col-md-2 control-label">Email</label>
                                <div class="col-md-10">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') ? old('email')  :  @$tower->email }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="region" class="col-md-2 control-label">Region</label>
                                <div class="col-md-10">
                                    <input id="region" type="text" class="form-control" name="region" value="{{ old('region') ? old('region')  :  @$tower->region }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="towerowner" class="col-md-2 control-label">Tower Owner</label>
                                <div class="col-md-10">
                                    <input id="towerowner" type="text" class="form-control" name="towerowner" value="{{ old('towerowner') ? old('towerowner') : @$tower->towerowner }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="towerownershort" class="col-md-2 control-label">Tower Owner Short</label>
                                <div class="col-md-10">
                                    <input id="towerownershort" type="text" class="form-control" name="towerownershort" value="{{ old('towerownershort') ? old('towerownershort') : @$tower->towerownershort }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="btanumber" class="col-md-2 control-label">BTA Number</label>
                                <div class="col-md-10">
                                    <input id="btanumber" type="text" class="form-control" name="btanumber" value="{{ old('btanumber') ? old('btanumber') : @$tower->btanumber }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="btaname" class="col-md-2 control-label">BTA Name</label>
                                <div class="col-md-10">
                                    <input id="btaname" type="text" class="form-control" name="btaname" value="{{ old('btaname') ? old('btaname') : @$tower->btaname }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="mtanumber" class="col-md-2 control-label">MTA Number</label>
                                <div class="col-md-10">
                                    <input id="mtanumber" type="text" class="form-control" name="mtanumber" value="{{ old('mtanumber') ? old('mtanumber') : @$tower->mtanumber }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="mtaname" class="col-md-2 control-label">MTA Name</label>
                                <div class="col-md-10">
                                    <input id="mtaname" type="text" class="form-control" name="mtaname" value="{{ old('mtaname') ? old('mtaname') : @$tower->mtaname }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="newsite" class="col-md-2 control-label">New Site</label>
                                <div class="col-md-10">
                                    <input id="newsite" type="text" class="form-control" name="newsite" value="{{ old('newsite') ? old('newsite') : @$tower->newsite }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="fccnumber" class="col-md-2 control-label">FCC Number</label>
                                <div class="col-md-10">
                                    <input id="fccnumber" type="text" class="form-control" name="fccnumber" value="{{ old('fccnumber') ? old('fccnumber') : @$tower->fccnumber }}" >                                    
                                </div>
                            </div>							
							<div class="form-group">
                                <label for="stimsiteid" class="col-md-2 control-label">STIM Site ID</label>
                                <div class="col-md-10">
                                    <input id="stimsiteid" type="text" class="form-control" name="stimsiteid" value="{{ old('stimsiteid') ? old('stimsiteid') : @$tower->stimsiteid }}" >                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
								<div class="col-md-2">
                                    @if(@$tower->towerid)<button type="button" onClick="tower_delete()"  class="btn btn-danger pull-right">Delete Tower</a>@endif
                                </div>
                            </div>						
							
							<div class="pull-right"> <a href="{{ url('login') }}"  >  << Back </a>   &nbsp;  &nbsp; </div>

                        </form>
						
						@if(@$tower->towerid)
						<form id="towerdelete" action="{{ url('/tower/'.$tower->id) }}" method="POST"  style="display:none" >
                                    {{ csrf_field() }}
									{{ method_field('Delete') }}								
                        </form>
						@endif
							
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
	<script>
		function tower_delete(){ 
			var tower = confirm('Want to delete?');			
			if(tower){			
                $( "#towerdelete" ).submit();
			}			
		}		
	</script>
@endsection
