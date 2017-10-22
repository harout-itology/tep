@extends('layouts.app')

@section('head')
    <style>
        body{
            background-image: none;
        }  		
    </style>
	<link rel="stylesheet" href="{{url('public/jquery/dataTables.min.css')}}" >
	<link rel="stylesheet" href="{{url('public/jquery/buttons.dataTables.min.css')}}" >
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
						<form class="search navbar navbar-default mobile" method='get' action='' onsubmit="return my_submit()">											
							<input class="" type='text' placeholder='Latitude' name='latitude' value="{{$r_latitude==41.949101 ? '' : $r_latitude }}" >
							<input class="" type='text' placeholder='Longitude' name='longitude' value="{{$r_longitude==-101.148345 ? '' : $r_longitude }}" >
							<input class="" type='text' placeholder='Radius Mi' name='radius' value="{{$r_radius==10000 ? '' : $r_radius}}" >
							<select class="" name='towerowner[]'  >
								<option value='all'>All Owners</option>
								@foreach($towerowner as $item)
									<option {{$r_towerowner[0]==$item ? 'selected' : '' }} value='{{$item}}'>{{$item}}</option>
								@endforeach
							</select>
							<button class="submit" type='submit'>Search</button>
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
                                        <th>Map</th>
										<th>Tower ID</th>
                                        <th>Site Name</th>                                       
                                        <th>City</th>
                                        <th>Country</th>
										<th>State</th>
                                        <th>Height</th>
                                        <th>Structure Class Ification</th>
                                        <th>Owner</th>
                                    </tr>
                                    </thead>                                    
                                    <tbody>
                                    @foreach($towers as $item)
                                    <tr>
										<td><i title=' Show Map ' data-id="{{$item->towerid}}" data-co1="{{$item->latitude}}" data-co2="{{$item->longitude}}"  class="btn fa fa-map-marker open-model" aria-hidden="true"  ></i> </td>
										<td><a title=' Click to Edit ' href="{{url('tower/'.$item->id.'/edit')}}" >{{$item->towerid}}</a></td>
                                        <td>{{$item->sitename}}</td>                                       
                                        <td>{{$item->city}}</td>
                                        <td>{{$item->country}}</td>
										<td>{{$item->state}}</td>
                                        <td>{{$item->height}}</td>
                                        <td>{{$item->structureclassification}}</td>
                                        <td>{{$item->towerowner}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
								<div class='col-md-6' style='padding:10px 0'>Showing   {{$towers->total()}} Entries
								</div>
								<div class='col-md-6' ><div class='pull-right' >{{ $towers->appends(request()->input())->links() }}</div></div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div id="map"></div>
                            </div>
                        </div>						
					</div>
                </div>            
			</div>
			
			<div class="col-md-2 menu-close-bar mobile">
				<form  method='get' action='' id="form_filter">
				<input type='hidden' name='type' id='type' >
				<div class="panel-group pre-scrollable" id="accordion" style='min-height:500px'>
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
					  <div id="collapse1" class="panel-collapse collapse {{ $type=='city' || $type=='' ? 'in' : '' }}    ">
						<div class="panel-body">
								<ul class="list-group list-unstyled">   
									<li >
										@foreach($city as $item)
											@if($item)
												<div class="checkbox checkbox-primary">
													<input class='filter' id="city_{{$item}}" name="city[]" {{ isset($r_city) ? in_array($item,$r_city) ? 'checked' : '' : 'checked' }} type="checkbox" value="{{$item}}" >
													<label for="city_{{$item}}">{{$item}}</label>
												</div>
											@endif
										@endforeach
									</li>                                							
								</ul>
						</div>
					  </div>
					</div>					
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Country</a>
						</h4>
					  </div>
					  <div id="collapse2" class="panel-collapse collapse {{ $type=='country' ? 'in' : '' }}">
						<div class="panel-body">
								<ul class="list-group list-unstyled">   
									<li >
										@foreach($country as $item)
											<div class="checkbox checkbox-primary">
												<input class='filter'  id="country_{{$item}}" name="country[]" {{ isset($r_country) ? in_array($item,$r_country) ? 'checked' : '' : 'checked' }}  type="checkbox" value="{{$item}}" >
												<label for="country_{{$item}}">{{$item}}</label>
											</div>
										@endforeach
									</li>                                							
								</ul>
						</div>
					  </div>
					</div>					
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">State</a>
						</h4>
					  </div>
					  <div id="collapse3" class="panel-collapse collapse {{ $type=='state' ? 'in' : '' }}">
						<div class="panel-body">
								<ul class="list-group list-unstyled">   
									<li >
										@foreach($state as $item)
											<div class="checkbox checkbox-primary">
												<input class='filter'  id="state_{{$item}}" name="state[]" {{ isset($r_state) ? in_array($item,$r_state) ? 'checked' : '' : 'checked' }} type="checkbox" value="{{$item}}" >
												<label for="state_{{$item}}">{{$item}}</label>
											</div>
										@endforeach
									</li>                                							
								</ul>
						</div>
					  </div>
					</div>					
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 class="panel-title">
						  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Structure Class Ification</a>
						</h4>
					  </div>
					  <div id="collapse4" class="panel-collapse collapse {{ $type=='infication' ? 'in' : '' }}">
						<div class="panel-body">
								<ul class="list-group list-unstyled">   
									<li >
										@foreach($infication as $item)
											@if($item)
												<div class="checkbox checkbox-primary">
													<input class='filter' id="infication_{{$item}}" name="infication[]" type="checkbox" {{ isset($r_infication) ? in_array($item,$r_infication) ? 'checked' : '' : 'checked' }} value="{{$item}}" >
													<label for="infication_{{$item}}">{{$item}}</label>
												</div>
											@endif
										@endforeach
									</li>                                							
								</ul>
						</div>
					  </div>
					</div>					
				</div>
				</form>
			</div>
			
        </div>
    </div>
	
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"></h4>
		  </div>
		  <div class="modal-body">
			<div id='model-map'></div>
		  </div>		  
		</div>

	  </div>
	</div>


@endsection

@section('foot')
    <script src="{{url('public/jquery/dataTables.min.js')}}"></script>
    <script src="{{url('public/jquery/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('public/jquery/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('public/jquery/buttons.colVis.min.js')}}"></script>
    <script src="{{url('public/jquery/buttons.print.min.js')}}"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key={{$google_api}}&callback=initMap"></script>

    <script>
		//  show loading
		function my_submit(){
			$(".se-pre-con").fadeIn();			
		}
		$('.pagination li').on('click', function () {
			$(".se-pre-con").fadeIn();	
		});
		
		// bootstrap model
		$(function(){
		  $(".open-model").click(function(){      
			 $("#myModal").modal("show");
			 $('.modal-title').html($(this).data('id'));	
			 var x= $(this).data('co1');
			 var y= $(this).data('co2');
			 $('#model-map').html('<iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q='+x+','+y+'&z=5&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>');	
		  });
		});
		// filter click
		$('.filter').on('click', function () {
			$('#type').val($(this).attr('id'));
			$(".se-pre-con").fadeIn();
			$('#form_filter').submit();
		});
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
			 "scrollY":        "290px",
            dom: '<"top"Bf>rt<"bottom">',
            "scrollX": true,
            buttons: [ 'colvis', 'print' ]
        });		
        $('.dt-button').addClass('btn btn-default').removeClass('dt-button');
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
