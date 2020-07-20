@extends('web-food.layout.web')
@section('title', 'FAQ' )  
 
@section('content')


@section('header')
@include('web-food.includes.header')
@show
  
 
        <!---------------------------------------BANNER SECTION STARTS HERE-------------------------------------------->
            <section id="banner" style="background: url('{{URL::asset('web-food/assets/images/food-back-small.jpg')}}')no-repeat center;">
               <div class="container"> 
                  <div class="row" >
                      <div class="col-sm-12"  >
                             
                      </div>
                 </div>
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
 
        <!---------------------------------------WORKS SECTION STARTS HERE-------------------------------------------->
            <section id="faq" ng-controller="faqController">
               <div class="container">
			   <div class="row">  
                     <div class="col-sm-12  ">  
					   <h2 class="header">FAQs</h2><br>
					 </div>
				</div>
                  <div class="row">  
                     <div class="col-sm-12  ">   
                         <div class="panel left">
						 <div class="panel-body">
						    <div class="" ng-repeat="data in faqData.data.data">
							<h4>Q@{{$index+1}}: @{{data.question}}</h4>
							<p>Ans. @{{data.answer}}</p>
							<hr>
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

<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/faq.js')}}"></script> 
@endsection