@extends('layouts.app')

@section('head')

    <style>
        body{
            background-image: none;
        }
        .dataTables_length{
            margin:0 18%;
        }
        #map {
            height: 450px;
            width: 100%;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" >

@endsection

@section('content')
    <div class="container" style="width: 100%">
        <div class="row  ">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;  List View</a></li>
                            <li><a data-toggle="tab" href="#menu2"><i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; Map View</a></li>
                        </ul><br>

                        <div class="tab-content">
                            <div id="menu1" class="tab-pane fade in active">

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
                                    <tfoot>
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
                                    </tfoot>
                                    <tbody>
                                    @foreach($towers as $item)
                                    <tr>
                                        <td>{{$item->towerid}}</td>
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
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: '<"top"Bfl>rt<"bottom"ip>',
                "scrollX": true,
                buttons: [ 'colvis', 'csv', 'pdf', 'print' ],
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select class="form-control" ><option value="">All</option></select>').appendTo( $(column.footer()).empty() ).on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search( val ? '^'+val+'$' : '', true, false ).draw();
                         } );
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
            $('.dt-button').addClass('btn btn-default').removeClass('dt-button');
        } );
    </script>

    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 3,
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
            map.setCenter(new google.maps.LatLng(32.12164, -17.84661));
        });
    </script>

@endsection
