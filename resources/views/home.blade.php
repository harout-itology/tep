@extends('layouts.app')

@section('head')
@endsection

@section('content')
    <div class="container">
        <div class="row  ">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h2> Map</h2>

                        {{$response}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
@endsection
