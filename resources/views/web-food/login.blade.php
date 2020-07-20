@extends('web-food.layout.web')
@section('title', 'Login' )  
 
@section('content')


@section('header')
@include('web-food.includes.header')
@show
 
 
 
        <!---------------------------------------BANNER SECTION STARTS HERE-------------------------------------------->
            <section id="banner" style="background: url('{{URL::asset('web-food/assets/images/food-back-small.jpg')}}')no-repeat center;">
               <div class="container-fluid"> 
                  <div class="row" >
                      <div class="col-sm-12"  >
                                     
                   
                 </div>
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
 
        <!---------------------------------------WORKS SECTION STARTS HERE-------------------------------------------->
            <section id="login" ng-controller="loginController" ng-cloak >
               <div class="container">
                  <div class="row"> 
                     <div class="col-sm-12 text-center">   
                         <div class="panel">
						 <div class="panel-body">
						   <div class="row">
						     <div class="col-sm-7 left">
							   <h3 class="header  text-center">Login to your Account</h3>
							   <br>
							   <form>
							     <div class="form-group">
								   <input type="email" class="form-control" id="user_email" name="email" ng-model="email" placeholder="Email">
								 </div>
								 <div class="form-group">
								   <input type="password" class="form-control" id="user_password" name="password" ng-model="password" placeholder="Password">
								 </div> 
							   <p class="text-right"><a href="#">Forgot Password?</a></p>
							   
							   <md-button type="button" ng-click="login()" class="btn md-raised bg-color md-submit md-button md-ink-ripple">LOGIN</md-button>
							   </form>
							 </div>
							 <div class="col-sm-5 right">
							  <h3 class="header  text-center">New User?</h3>
							  <p>Create an account now</p>
							  <br>
							   <a href="{{URL::to('/web-register')}}"><md-button type="button"  class="btn md-raised bg-color md-submit md-button md-ink-ripple">signup</md-button></a>
							 </div>
						   </div>
						 </div>
						 </div>
                     </div> 
                  </div> 
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
		
		
		  				  
      
@section('footer')
@include('web-food.includes.footer')
@show
<!------>

<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/login.js')}}"></script> 
@endsection