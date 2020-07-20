@extends('web-food.layout.web')
@section('title', 'Home' )  
 
@section('content')


@section('header')
@include('web-food.includes.header')
@show
 
 
 
        <!---------------------------------------BANNER SECTION STARTS HERE-------------------------------------------->
            <section id="main-banner" style="background: url('{{URL::asset('web-food/assets/images/food-back.jpg')}}')no-repeat center;">
               <div class="container-fluid"> 
                  <div class="row" >
                      <div class="col-sm-12"  >
                                     
                          <div class="row">
						    <div class="col-sm-12 text-center">
							 <ul class="food-type list-inline">
							 <li class="delivery">
							  <img src="{{URL::asset('web-food/assets/images/food-delivery.png')}}" class="img-responsive center-block;">
							  <p class="text-uppercase text-center">Food Delivery</p>
							 </li>
							  <li class="catering">
							  <img src="{{URL::asset('web-food/assets/images/catering.png')}}" class="img-responsive center-block;">
							   <p class="text-uppercase text-center">Catering</p>
							  </li>
							</ul>
						  </div>
						  
						  <div class="col-sm-12">
						  <div class="row">
						    <form class="form-inline text-center">
								<div class="form-group">
								  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address...">
								</div> 
								<div class="form-group">
								  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email Address...">
								</div> 
								<md-button   class="btn md-raised bg-color md-submit md-button md-ink-ripple">search</md-button>
							  </form>
							 </div>
						  </div>
                     </div>
                 </div>
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
 
        <!---------------------------------------WORKS SECTION STARTS HERE-------------------------------------------->
            <section id="works" >
               <div class="container">
                  <div class="row"> 
                     <div class="col-sm-12 text-center">   
                         <h2 class="header">How it Works</h2>
						 <p class="sub-header text-capitalize">Order Food in 3 easy steps. easy online payments</p>
                     </div> 
                  </div>
                  <div class="row works-content" >
                      <div class="col-sm-4"  >
					     <img src="{{URL::asset('web-food/assets/images/restaurant.png')}}" class="img-responsive center-block">
                         <div>
						    <h4 class="text-center">Choose a Restaurant</h4>
						 </div>     
                     </div>
					 <div class="col-sm-4"  >
					     <img src="{{URL::asset('web-food/assets/images/tasty-dish.png')}}" class="img-responsive center-block">
                         <div>
						    <h4 class="text-center">Choose a Tasty Dish</h4>
						 </div>     
                     </div>
					 <div class="col-sm-4"  >
					     <img src="{{URL::asset('web-food/assets/images/pickup-delivery.png')}}" class="img-responsive center-block">
                         <div>
						    <h4 class="text-center">Pick Up or Delivery</h4>
						 </div>     
                     </div>
                 </div>
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
		
		
		   <!---------------------------------------MOBILE APP SECTION STARTS HERE-------------------------------------------->
            <section id="mobile-app" >
               <div class="container">
                  <div class="row"> 
                     <div class="col-sm-7 text-center"> 
					   <img src="{{URL::asset('web-food/assets/images/mobile-app.png')}}" class="img-responsive center-block" style="width:60%;">
                      </div>
					  <div class="col-sm-5 right" > 
					     <h3 class="header">Download our App Now!</h3>
						 <p>Find it on Appstore and Playstore</p><br>
						 <ul class="list-inline">
						 <li> <a href=""><img src="{{URL::asset('web-food/assets/images/app_store.png')}}" class="img-responsive center-block"></a></li>
						 <li> <a href=""><img src="{{URL::asset('web-food/assets/images/google_play.png')}}" class="img-responsive center-block"></a></li>
						 </ul>
                      </div>
                 </div>
               </div>
            </section>
		<!---------------------------------------MOBILE APP SECTION ENDS HERE-------------------------------------------->					  
      
@section('footer')
@include('web-food.includes.footer')
@show
<!------>
@endsection