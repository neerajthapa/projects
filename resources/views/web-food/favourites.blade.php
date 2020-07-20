@extends('web-food.layout.web')
@section('title', 'My Orders' )  
 
@section('content')


@section('header')
@include('web-food.includes.header')
@show
 
  
        <!---------------------------------------BANNER SECTION STARTS HERE-------------------------------------------->
            <section id="banner" style="background: url('{{URL::asset('web-food/assets/images/food-back-small.jpg')}}')no-repeat center;">
               <div class="container"> 
                  <div class="row" >
                      <div class="col-sm-12"   ng-controller="profileController">
                           <md-list layout-padding class="profile-data" >
							<md-list-item class="md-3-line"   ng-repeat="users in profileData.data"  >
								<img  ng-src="{{URL::asset('images/users')}}/@{{users.photo}}" class="md-avatar" >
								<div class="md-list-item-text">
								  <h2 >@{{users.first_name}} @{{users.last_name}}</h2>
								  <h4>
									@{{users.email}}
								  </h4>
								</div>
							</md-list-item>
						  </md-list>    
                      </div>
                 </div>
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
 
        <!---------------------------------------WORKS SECTION STARTS HERE-------------------------------------------->
            <section id="orders" >
               <div class="container">
                  <div class="row"> 
                     <div class="col-sm-4 text-center">   
                         <div class="panel left">
						 <div class="panel-body">
						   <table  class="table">
						    <tr>
							  <td> <i class="fa fa-"></i></td>
							  <td > <a href="{{URL::to('my-orders')}}">My Orders</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-map-marker-alt"></i></td>
							  <td> <a href="{{URL::to('addresses')}}">Manage Addresses</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-"></i></td>
							  <td><a href="{{URL::to('reviews')}}"> My Reviews</a></td>
							</tr>
							<tr class="active">
							  <td> <i class="fa fa-star"></i></td>
							  <td><a href="{{URL::to('favourites')}}"> Favourites</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-wrench"></i></td>
							  <td><a href="{{URL::to('account')}}"> Account Settings</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-sign-out-alt"></i></td>
							  <td>Signout</td>
							</tr>
						   </table>
						 </div>
						 </div>
                     </div> 
					 
					 
					 <div class="col-sm-8 text-center" ng-controller="favouriteController" ng-cloak>   
                         <div class="panel">
						 <div class="panel-body">
						     <div id="tableToExport" class="products-table table-responsive"  >
                                          <table class="table" class="table table-striped" id="exportthis" >
                                             <thead>
                                                <tr>  
                                                   <th>STORE</th>
                                                   <th>ADDRESS</th> 
                                                   <th>TIME</th>
                                                  <th>ACTIONS</th>
                                                </tr>
                                             </thead>
                                             <tbody >
                                                <tr  ng-repeat="values in favourite.data  ">  
                                                   <td>@{{values.store_details[0].store_title}}  </td> 
                                                   <td> @{{values.order_status}}</td>
                                                   <td>@{{values.created_at_formatted}}</td>
                                                    <td class="actions"> 
													  <a class="btn btn-xs edit-product" href="#" ><i class="fa fa-trash"></i></a> 
                                                   </td> 
                                                </tr>
                                             </tbody>
                                          </table>
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

<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/favourites.js')}}"></script> 
@endsection