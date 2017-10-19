@extends('layouts.app')

@section('head')
@endsection

@section('content')

    <div class="container login">
        <div class="row vertical-offset">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6 text-center">
                            <div class="row">
                                <div class="col-md-12">
									<br><img src="{{url('/public/img/logo.png')}}"  width="100"/><br><br>
									<a href="{{url('/')}}">Back to Home</a>
								</div>                                
                            </div>
                        </div>
						<div class="col-md-6 text-center">
                            <div class="row">
                                <div class="col-md-12"><img src="{{url('/public/img/404.png')}}"  width="250"/></div>                                
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('foot')
@endsection
