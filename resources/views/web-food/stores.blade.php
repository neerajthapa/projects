@extends('web-food.layout.web')
@section('title', 'My Orders' )  
 
@section('content')


@section('header')
@include('web-food.includes.header')
@show
 
  <?php $currency_symbol = @\App\Setting::where( 'key_title' , 'currency_symbol' )->first(['key_value'])->key_value;  ?>
        <!---------------------------------------BANNER SECTION STARTS HERE-------------------------------------------->
            <section id="banner" style="background: url('{{URL::asset('web-food/assets/images/food-back-small.jpg')}}')no-repeat center;">
               <div class="container"> 
                  <div class="row" >
                      <div class="col-sm-12" >    
                      </div>
                 </div>
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
 
        <!---------------------------------------WORKS SECTION STARTS HERE-------------------------------------------->
            <section id="stores" >
               <div class="container" ng-controller="storesController" ng-cloak>
                  <div class="row"> 
                     <div class="col-sm-3  ">   
                         <div class="panel panel-left">
						 <div class="panel-body">
						 <h4 class="header">Cuisines</h4><br>
						  <ul >
						    <li> 
							   <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1">  American   </md-checkbox>
							</li>
							 <li> 
							   <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1">  American   </md-checkbox>
							</li>
							<li> 
							   <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1">  American   </md-checkbox>
							</li>
							<li> 
							   <md-checkbox ng-model="data.cb1" aria-label="Checkbox 1">  American   </md-checkbox>
							</li>
						  <ul>
						 </div>
						 </div>
                     </div> 
					 
					 
					 <div class="col-sm-6 " >   
                         <div class="panel panel-center-list">
						 <div class="panel-body">
						 
						   <div class="row">
							 <div class="col-sm-3 col-md-4 col-lg-3">
							   <img src="{{URL::asset('web-food/assets/images/restaurant.png')}}" class="img-responsive center-block">
							 </div>
							  <div class="col-lg-9 col-sm-9 col-md-8">
							  <div style="display:flex">
							     <h4 class="header">AZU MEALS<br>
								 <small>Chinese, Arabian, American</small></h4>
								 <md-button  class="btn md-raised bg-color md-submit md-button md-ink-ripple">View Menu</md-button>
								 </div>
								  <table class="table " class="table table-striped" id="exportthis" >
                                         
                                             <tbody >
                                                <tr   >  
                                                    <td class="text-left">Delivery Time  <p>40 mins<p></td>
													 <td class="text-center">Min Delivery <p><?php echo @$currency_symbol;?>45.60</p></td>
													 <td  class="text-right"> Delivery Cost <p>34.50</p></td>
													  </tr   >   
                                             </tbody>
                                          </table> 	 
										</div>
								  </div> 
						 </div>
						  </div>
						  
						  <div class="panel panel-center-list">
						 <div class="panel-body">
						 
						   <div class="row">
							 <div class="col-sm-3 col-md-4 col-lg-3">
							   <img src="{{URL::asset('web-food/assets/images/restaurant.png')}}" class="img-responsive center-block">
							 </div>
							  <div class="col-lg-9 col-sm-9 col-md-8">
							  <div style="display:flex">
							     <h4 class="header">AZU MEALS<br>
								 <small>Chinese, Arabian, American</small></h4>
								 <md-button  class="btn md-raised bg-color md-submit md-button md-ink-ripple">View Menu</md-button>
								 </div>
								  <table class="table " class="table table-striped" id="exportthis" >
                                         
                                             <tbody >
                                                <tr   >  
                                                    <td class="text-left">Delivery Time  <p>40 mins<p></td>
													 <td class="text-center">Min Delivery <p><?php echo @$currency_symbol;?>45.60</p></td>
													 <td  class="text-right"> Delivery Cost <p>34.50</p></td>
													  </tr   >   
                                             </tbody>
                                          </table> 	 
										</div>
								  </div> 
						 </div>
						  </div>
						  
						  <div class="panel panel-center-list">
						 <div class="panel-body">
						 
						   <div class="row">
							 <div class="col-sm-3 col-md-4 col-lg-3">
							   <img src="{{URL::asset('web-food/assets/images/restaurant.png')}}" class="img-responsive center-block">
							 </div>
							  <div class="col-lg-9 col-sm-9 col-md-8">
							  <div style="display:flex">
							     <h4 class="header">AZU MEALS<br>
								 <small>Chinese, Arabian, American</small></h4>
								 <md-button  class="btn md-raised bg-color md-submit md-button md-ink-ripple">View Menu</md-button>
								 </div>
								  <table class="table " class="table table-striped" id="exportthis" >
                                         
                                             <tbody >
                                                <tr   >  
                                                    <td class="text-left">Delivery Time  <p>40 mins<p></td>
													 <td class="text-center">Min Delivery <p><?php echo @$currency_symbol;?>45.60</p></td>
													 <td  class="text-right"> Delivery Cost <p>34.50</p></td>
													  </tr   >   
                                             </tbody>
                                          </table> 	 
										</div>
								  </div> 
						 </div>
						  </div>
						  </div>
					 
					 
					  <div class="col-sm-3 ">   
                         <div class="panel panel-right">
						   <div class="panel-body">
						    <h4 class="header">Sort By</h4> 
						       <table  class="table">
								<tr>
								  <td> <i class="fa fa-sort"></i></td>
								  <td > <a href="#">Alphabetical</a></td>
								</tr>
								<tr>
								  <td> <i class="fa fa-heart"></i></td>
								  <td> <a href="#">Ratings</a></td>
								</tr>
								<tr>
								  <td> <i class="fa fa-uer"></i></td>
								  <td><a href="#">Minimum Order Value</a></td>
								</tr>
							  </table>
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

<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/stores.js')}}"></script> 


	
@endsection