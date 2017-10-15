@extends('layouts.app')

@section('head')
    <style>
        body{
            background-image: none;
        }    
    </style>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" >
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" >
		<link rel="stylesheet" href="https://www.cssscript.com/demo/pretty-checkbox-radio-inputs-with-bootstrap-and-awesome-bootstrap-checkbox-css/build.css" >
	</style>
@endsection

@section('content')
    <div class="container" style="width: 100%">
        <div class="row  ">
            <div class="col-md-10">
						
                <div id="main" class="panel panel-default">
                    <div class="panel-body">													
					
											
						@if( session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif			

						<div class="dropdown serach-type">						
                            
							<a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown" role="button" aria-expanded="false">
                               <i class="fa fa-list-alt "></i>
							</a>						
                            <ul class="dropdown-menu  pull-right menu-right " role="menu">   
								<li>
									<div class="radio radio-primary radio-inline">
										<input type="radio" id="inlineRadio1" value="option1" name="type" {{ $form ==1  ? 'checked' : ''  }}   >
										<label for="inlineRadio1"> Latitude/Longitude </label>
									</div>
								</li>
                                <li class="divider"></li>
								<li>
									<div class="radio radio-primary radio-inline">
										<input type="radio" id="inlineRadio2" value="option1" name="type" {{ $form ==2 ? 'checked' : ''  }} >
										<label for="inlineRadio2"> MTA/BTA </label>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="radio radio-primary radio-inline">
										<input type="radio" id="inlineRadio3" value="option1" name="type" {{ $form ==3 ? 'checked' : ''  }}  >
										<label for="inlineRadio3"> Address/Location </label>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="radio radio-primary radio-inline">
										<input type="radio" id="inlineRadio4" value="option1" name="type" {{ $form ==4 ? 'checked' : ''  }}  >
										<label for="inlineRadio4"> Site Name,Number or ASR Number </label>
									</div>
								</li>								
                            </ul>
                        </div>		
						
						<form id="form1" class="search navbar navbar-default " @if($form!=1) style='display:none' @endif method='get' action=''>
							<input type="hidden" name="form" value ="1" >						
							<input class="" type='text' placeholder='Latitude' name='' >
							<input class="" type='text' placeholder='Longitude' name='' >							
							<input class="" type='text' placeholder='Radius Mi' name='' >
							<select class="" name='towerowner'>
								<option value=''>All Owners</option>
								@foreach($towerowner as $item)
									<option {{$r_towerowner==$item ? 'selected' : '' }} value='{{$item}}'>{{$item}}</option>
								@endforeach
							</select>
							<button class="" type='submit'>Search</button>
						</form>
						<form id="form2" class="search navbar navbar-default " @if($form!=2) style='display:none' @endif method='get' action=''>	
							<input type="hidden" name="form" value ="2" >							    
							<select class="" name='mtaname'>
								<option value=''>MTA Name</option>
								@foreach($mtaname as $item)
									<option {{$r_mtaname==$item ? 'selected' : '' }} value='{{$item}}'>{{$item}}</option>
								@endforeach
							</select>
							<select class="" name='btaname'>
								<option value=''>BTA Name</option>
								@foreach($btaname as $item)
									<option {{$r_btaname==$item ? 'selected' : '' }} value='{{$item}}'>{{$item}}</option>
								@endforeach
							</select>
							<select class="" name='towerowner'>
								<option value=''>All Owners</option>
								@foreach($towerowner as $item)
									<option {{$r_towerowner==$item ? 'selected' : '' }} value='{{$item}}'>{{$item}}</option>
								@endforeach
							</select>
							<button class="" type='submit'>Search</button>
						</form>					
						<form id="form3" class="search navbar navbar-default " @if($form!=3) style='display:none' @endif method='get' action=''>						    
							<input type="hidden" name="form" value ="3" >
							<input class="" type='text' placeholder='Street Address' name='address' value="{{ $r_address=='%' ? '' : $r_address  }}" >
							<input class="" type='text' placeholder='City' name='city' value="{{ $r_city=='%' ? '' : $r_city  }}" >
							<select class="" name='state'>
								<option value=''>State</option>
								@foreach($state as $key => $item)
									<option {{$r_state==$key ? 'selected' : '' }} value='{{$key}}'>{{$item}}</option>								
								@endforeach	
							</select>
							<select class="" name='country'>
								<option value=''>Country</option>
								@foreach($country as $key => $item)
									<option {{$r_country==$key ? 'selected' : '' }} value='{{$key}}'>{{$item}}</option>								
								@endforeach								
							</select>
							<input class="" type='text' placeholder='Radius Mi' name='' >
							<select class="" name='towerowner'>
								<option value=''>All Owners</option>
								@foreach($towerowner as $item)
									<option {{$r_towerowner==$item ? 'selected' : '' }} value='{{$item}}'>{{$item}}</option>
								@endforeach
							</select>
							<button class="" type='submit'>Search</button>
						</form>					
						<form id="form4" class="search navbar navbar-default " @if($form!=4) style='display:none' @endif method='get' action=''>
						<input type="hidden" name="form" value ="4" >						
							<input class="" type='text' placeholder='Site Name' name='sitename' value="{{ $r_sitename=='%' ? '' : $r_sitename  }}"  >
							<input class="" type='text' placeholder='Site Number' name='' >							
							<input class="" type='text' placeholder='FCC Number' name='fccnumber' value="{{ $r_fccnumber=='%' ? '' : $r_fccnumber  }}" >
							<select class="" name='towerowner'>
								<option value=''>All Owners</option>
								@foreach($towerowner as $item)
									<option {{$r_towerowner==$item ? 'selected' : '' }} value='{{$item}}'>{{$item}}</option>
								@endforeach
							</select>
							<button class="" type='submit'>Search</button>
						</form>

						<ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;  List View</a></li>
                            <li><a data-toggle="tab" href="#menu2"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Map View</a></li>
                        </ul><br>

                        <div class="tab-content">
                            <div id="menu1" class="tab-pane fade in active ">

                                <table id="example" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Tower ID</th>
                                        <th>Site Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Height</th>
                                        <th>Infication</th>
                                        <th>Owner</th>
                                    </tr>
                                    </thead>                                    
                                    <tbody>
                                    @foreach($towers as $item)
                                    <tr>
                                        <td><a href="{{url('tower/'.$item->id.'/edit')}}" >{{$item->towerid}}</a></td>
                                        <td>{{$item->sitename}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->city}}</td>
                                        <td>{{$item->country}}</td>
                                        <td>{{$item->height}}</td>
                                        <td>{{$item->infication}}</td>
                                        <td>{{$item->towerowner}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div id="map"></div>
                            </div>
                        </div>
						
                    
					
						
					</div>
                </div>
            
			</div>
			<div class="col-md-2">
	
  <div class="panel-group" id="accordion">
  
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">City</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
        <div class="panel-body">
			<form id='f-city' method='get' action=''>	
				<ul class="list-group list-unstyled">   
					<li >
						@foreach($city as $item)
							@if($item)
								<div class="checkbox checkbox-primary">
									<input class='filter' {{$r_city == $item ? "checked" : "" }} name="country" id="{{$item}}" type="checkbox" value="{{$item}}" >
									<label for="{{$item}}">{{$item}}</label>
								</div>
							@endif
						@endforeach
					</li>                                							
				</ul>
			</form>
		</div>
      </div>
    </div>
	
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Country</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
			<form id='f-country' method='get' action=''>	
				<ul class="list-group list-unstyled">   
					<li >
						@foreach($country as $key => $item)
							<div class="checkbox checkbox-primary">
								<input class='filter' {{$r_country == $key ? "checked" : "" }} name="country" id="{{$key}}" type="checkbox" value="{{$key}}" >
								<label for="{{$key}}">{{$item}}</label>
							</div>
						@endforeach
					</li>                                							
				</ul>
			</form>
		</div>
      </div>
    </div>
    
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">State</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
		<form id='f-state' method='get' action=''>	
				<ul class="list-group list-unstyled">   
					<li >
						@foreach($state as $key => $item)
							<div class="checkbox checkbox-primary">
								<input class='filter' {{$r_state == $key ? "checked" : "" }} name="country" id="{{$key}}" type="checkbox" value="{{$key}}" >
								<label for="{{$key}}">{{$item}}</label>
							</div>
						@endforeach
					</li>                                							
				</ul>
			</form>
		</div>
      </div>
    </div>
	
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Ification</a>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
			<form id='f_infication' method='get' action=''>	
				<ul class="list-group list-unstyled">   
					<li >
						@foreach($infication as $item)
							@if($item)
								<div class="checkbox checkbox-primary">
									<input class='filter' {{$r_infication == $item ? "checked" : "" }} name="country" id="{{$item}}" type="checkbox" value="{{$item}}" >
									<label for="{{$item}}">{{$item}}</label>
								</div>
							@endif
						@endforeach
					</li>                                							
				</ul>
			</form>
		</div>
      </div>
    </div>
	
	<div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Tower Owner</a>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">
			<form id='f_towerowner' method='get' action=''>	
				<ul class="list-group list-unstyled">   
					<li >
						@foreach($towerowner as $item)
							@if($item)
								<div class="checkbox checkbox-primary">
									<input class='filter' {{$r_towerowner == $item ? "checked" : "" }} name="country" id="{{$item}}" type="checkbox" value="{{$item}}" >
									<label for="{{$item}}">{{$item}}</label>
								</div>
							@endif
						@endforeach
					</li>                                							
				</ul>
			</form>
		</div>
      </div>
    </div>
							
  </div> 

					
			</div>			
        </div>
    </div>
@endsection

@section('foot')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
    <script>
		// data table
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: '<"top"lB>rt<"bottom"ip>',
                "scrollX": true,
                buttons: [ 'colvis', 'csv', 'pdf', 'print' ]               
            } );
            $('.dt-button').addClass('btn btn-default').removeClass('dt-button');
			
        } );
		// google map
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
                mapTypeId: 'terrain'
            });
            // Create a <script> tag and set the USGS URL as the source.
            var script = document.createElement('script');
            // This example uses a local copy of the GeoJSON stored at  // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
            script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
            document.getElementsByTagName('head')[0].appendChild(script);
        }
        // Loop through the results array and place a marker for each // set of coordinates.
        window.eqfeed_callback = function(results) {
           @foreach($towers as $item)
                var latLng = new google.maps.LatLng({{$item->latitude}},{{$item->longitude}});
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });
           @endforeach
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFW6ifz4HBeEU1-ZDHUgSd8eC_Krq8eB4&callback=initMap"></script>
    <script>
        $('.nav-tabs').on('shown.bs.tab', function () {
            google.maps.event.trigger(map, 'resize');
            map.setCenter(new google.maps.LatLng(37.0903563,-95.7829316));
        });
		$('.home').addClass('active');
		
		$('#inlineRadio1').on('click', function () {
            $('.search').hide();
			$('#form1').show();
        });
		$('#inlineRadio2').on('click', function () {
            $('.search').hide();
			$('#form2').show();
        });
		$('#inlineRadio3').on('click', function () {
            $('.search').hide();
			$('#form3').show();
        });
		$('#inlineRadio4').on('click', function () {
            $('.search').hide();
			$('#form4').show();
        });	
</script>

		
</script>
@endsection
