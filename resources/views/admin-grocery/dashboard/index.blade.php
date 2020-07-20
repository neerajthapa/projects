@extends('admin-grocery.layout.auth')
@section('title', 'Dashboard' ) 
<link rel="stylesheet" href="{{ URL::asset('admin/assets/css/app.css')}}">
<style>
   @media(min-width:1200px){
   .card{height:300px;overflow-y:auto} 
   }
   @media (min-width: 992px){
   .col-md-3.top-data {
   width: 20%;
   }}
   @media(min-width:2200px){
   .top-value{display:none;}
   .bottom-value{display:block;}	
   }
   @media(max-width:2199px) {
   .top-value{display:block;}
   .bottom-value{display:none;}	
   }
   @media(min-width:766px) and (max-width:1199px){
   .card{height:330px;overflow-y:auto} 
   } 
   hc-chart {
   padding-top:5px;
   width: 100%; 
   display: block;
   } 
</style>
@section('content')
@section('header')
@include('admin-grocery.includes.header')
@show

<?php// $currency_symbol = @\App\Setting::where( 'key_title' , 'currency_symbol' )->first(['key_value'])->key_value; ?>
<div ng-app="mainApp" style="margin-top:61px;z-index:99999999">
<div id="wrapper">
   <div id="layout-static">
      <!---------- Static Sidebar Starts------->			
      @section('sidebar')
      @include('admin-grocery.includes.sidebar')
      @show
      <!---------- Static Sidebar Ends------->
      <div class="static-content-wrapper">
         <section id="main-header">
            <div class="container-fluid">
               <div class="row">
                  
				  
				  
                       <?php          $auth_user_type = Auth::user()->user_type;   
                                      $auth_user_id =   Auth::id();  
                        ?> 
                    
				  
			 
                  <div class="col-sm-12">
                     <div class="text-right">
					 <br> 
                     </div>
                     <div class="tab-content" >
                     
                        <div ng-controller="dashboardController" ng-cloak>
                           <div class="container-fluid" id="dashboard">
   	  		  
					   </div>
						   
			  </div>
                      
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
</div>


 <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('2e2be9c9dcbc4a3be1d0', {
      cluster: 'ap2',
      forceTLS: true
    });

    var channel = pusher.subscribe('location');
    channel.bind('SendLocation', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
<script type="text/javascript" src="{{ URL::asset('admin/angular-controllers-grocery/dashboard.js')}}"></script> 
<!----assets for pdf download--------->
<!------>
@endsection