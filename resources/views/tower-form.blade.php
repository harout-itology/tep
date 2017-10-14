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
                        @if( session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
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
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
@endsection
