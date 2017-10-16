@extends('layouts.app')

@section('head')
    <style>
        body{
            background-image: none;
        }    
    </style>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" >
@endsection

@section('content')
    <div class="container" style="width: 100%">
        <div class="row  ">
		
            <div class="col-md-10 main-bar">						
                <div id="main" class="panel panel-default">
                    <div class="panel-body">											
						@if( session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
						<form class="search navbar navbar-default" method='get' action=''>											
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
							<i class="btn btn-primary menu-open fa fa-arrow-left" aria-hidden="true" style='display:none'></i>
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
										<th>State</th>
                                        <th>Height</th>
                                        <th>Infication</th>
                                        <th>Owner</th>
                                    </tr>
                                    </thead>                                    
                                    <tbody>
                                    @foreach($towers as $item)
                                    <tr>
                                        <td><a title=' Click to Edit ' href="{{url('tower/'.$item->id.'/edit')}}" >{{$item->towerid}}</a></td>
                                        <td>{{$item->sitename}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->city}}</td>
                                        <td>{{$item->country}}</td>
										<td>{{$item->state}}</td>
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
			
			<div class="col-md-2 menu-close-bar">	
			    <div class="panel-group" id="accordion">						
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
							  <i class="btn menu-close fa fa-times pull-right" aria-hidden="true" style='margin-top:-5px'></i>
							  <b>Filters List</b>
							</h4>
					    </div>
					</div>						
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
													<input class='city_filter' id="city_{{$item}}" checked type="checkbox" value="{{$item}}" >
													<label for="city_{{$item}}">{{$item}}</label>
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
												<input class='country_filter'  checked id="country_{{$key}}" type="checkbox" value="{{$key}}" >
												<label for="country_{{$key}}">{{$item}}</label>
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
												<input class='state_filter'  checked id="state_{{$key}}" type="checkbox" value="{{$key}}" >
												<label for="state_{{$key}}">{{$item}}</label>
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
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Infication</a>
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
													<input class='infication_filter'  checked id="infication_{{$item}}" type="checkbox" value="{{$item}}" >
													<label for="infication_{{$item}}">{{$item}}</label>
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
													<input class='owner_filter' checked id="owner_{{$item}}" type="checkbox" value="{{$item}}" >
													<label for="owner_{{$item}}">{{$item}}</label>
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
	<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$google_api}}&callback=initMap"></script>
    <script>
		// close the right
		$('.menu-close').on('click', function () {
			$('.menu-open').show();
			$('.menu-close-bar').hide();
			$('.main-bar').removeClass('col-md-10').addClass('col-md-12');
			table.fnDraw();
        });
		// open the right	
		$('.menu-open').on('click', function () {
			$('.menu-open').hide();
			$('.menu-close-bar').show();
			$('.main-bar').removeClass('col-md-12').addClass('col-md-10');
			table.fnDraw();
        });	
		// data table        
        var table = $('#example').dataTable( {		
            dom: '<"top"lB>rt<"bottom"ip>',
            "scrollX": true,
            buttons: [ 'colvis', 'csv', 'pdf', 'print' ]               
        });		
        $('.dt-button').addClass('btn btn-default').removeClass('dt-button'); 	
		// filter city
		$('.city_filter').on('click', function () {
			var values = [];
			$('.city_filter').each(function() {
				if($(this).is(':checked'))
					values.push('^'+$(this).val()+'$');
			});
			var choosedString = values.join("|");
			table.fnFilter(choosedString,3,true,false);			
        });
		// filter country
		$('.country_filter').on('click', function () {
			var values = [];
			$('.country_filter').each(function() {
				if($(this).is(':checked'))
					values.push('^'+$(this).val()+'$');
			});
			var choosedString = values.join("|");
			table.fnFilter(choosedString,4,true,false);			
        });
		// filter state
		$('.state_filter').on('click', function () {
			var values = [];
			$('.state_filter').each(function() {
				if($(this).is(':checked'))
					values.push('^'+$(this).val()+'$');
			});
			var choosedString = values.join("|");
			table.fnFilter(choosedString,5,true,false);			
        });
		// filter infication
		$('.infication_filter').on('click', function () {
			var values = [];
			$('.infication_filter').each(function() {
				if($(this).is(':checked'))
					values.push('^'+$(this).val()+'$');
			});
			var choosedString = values.join("|");
			table.fnFilter(choosedString,7,true,false);			
        });
		// filter owner
		$('.owner_filter').on('click', function () {
			var values = [];
			$('.owner_filter').each(function() {
				if($(this).is(':checked'))
					values.push('^'+$(this).val()+'$');
			});
			var choosedString = values.join("|");
			table.fnFilter(choosedString,8,true,false);			
        });
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
		// tabs on change google map activation
        $('.nav-tabs').on('shown.bs.tab', function () {
            google.maps.event.trigger(map, 'resize');
            map.setCenter(new google.maps.LatLng(37.0903563,-95.7829316));
			table.fnDraw();
        });
		// home menu activation
		$('.home').addClass('active');
	
	</script>
@endsection
