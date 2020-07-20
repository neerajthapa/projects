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
            <section id="login" >
               <div class="container">
                  <div class="row"> 
                     <div class="col-sm-12 text-center">   
                         <div class="panel">
						 <div class="panel-body">
						   <div class="row">
						     <div class="col-sm-7 left">
							   <h3 class="header  text-center">Create an account</h3>
							   <br>
							   <form>
							   <div class="row">
							       <div class="form-group col-sm-6">
								   <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
								 </div>
								   <div class="form-group col-sm-6">
								   <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
								 </div>
								 </div>
							     <div class="form-group">
								   <input type="email" class="form-control" id="email" name="email" placeholder="Email">
								 </div>
								 <div class="form-group">
								   <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
								 </div> 
								 <div class="form-group">
								   <input type="password" class="form-control" id="password" name="password" placeholder="Password">
								 </div> 
							  
							   <md-button type="button"  class="btn md-raised bg-color md-submit md-button md-ink-ripple">signup</md-button>
							   </form>
							 </div>
							 <div class="col-sm-5 right">
							 <br><br>
							  <h3 class="header  text-center">Already User?</h3>
							  <p>Login to your account </p>
							  <br>
							   <a href="{{URL::to('/web-login')}}"><md-button type="button"  class="btn md-raised bg-color md-submit md-button md-ink-ripple">login</md-button></a>
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
@endsection