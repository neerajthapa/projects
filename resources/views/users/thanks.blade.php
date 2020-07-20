@extends('layout.front')
@section('content')


 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>
        	 @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
               @endif
        	</h3>
        
      </div>
    </div>
@stop