@extends('web-food.layout.web')
@section('title', 'Items' )  
<link rel="stylesheet" href=" {{URL::asset('web-food/assets/css/style1.css')}}">
 <style>
         .spinner {
         margin: 100px auto 0;
         width: 70px;
         text-align: center;
         }
         .spinner > div {
         width: 18px;
         height: 18px;
         background-color: #333;
         border-radius: 100%;
         display: inline-block;
         -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
         animation: sk-bouncedelay 1.4s infinite ease-in-out both;
         }
         .spinner .bounce1 {
         -webkit-animation-delay: -0.32s;
         animation-delay: -0.32s;
         }
         .spinner .bounce2 {
         -webkit-animation-delay: -0.16s;
         animation-delay: -0.16s;
         }
         @-webkit-keyframes sk-bouncedelay {
         0%, 80%, 100% { -webkit-transform: scale(0) }
         40% { -webkit-transform: scale(1.0) }
         }
         @keyframes sk-bouncedelay {
         0%, 80%, 100% { 
         -webkit-transform: scale(0);
         transform: scale(0);
         } 40% { 
         -webkit-transform: scale(1.0);
         transform: scale(1.0);
         }
         }
         .foodbakery-button-loader {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: #f97456;
         text-align: center;
         border-radius: 3px;
         background-color: #c33332 !important;
         }
         .foodbakery-button-loader .spinner {
         width: 25px;
         height: 25px;
         position: absolute;
         display: inline-block;
         top: 0;
         bottom: 0;
         left: 0;
         right: 0;
         margin: auto;
         }
         .foodbakery-button-loader .double-bounce1, .foodbakery-button-loader .double-bounce2 {
         width: 100%;
         height: 100%;
         border-radius: 50%;
         background-color: #fff;
         opacity: 0.6;
         position: absolute;
         top: 0;
         left: 0;
         -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
         animation: sk-bounce 2.0s infinite ease-in-out;
         }
         .foodbakery-button-loader .double-bounce2 {
         -webkit-animation-delay: -1.0s;
         animation-delay: -1.0s;
         }
      </style>
@section('content')


@section('header')
@include('web-food.includes.header')
@show
  
<!---------------------------------------BANNER SECTION STARTS HERE-------------------------------------------->
            <section id="banner" style="background: url('{{URL::asset('web-food/assets/images/food-back-small.jpg')}}')no-repeat center;">
               <div class="container"> 
                  <div class="row" >
                      <div class="col-sm-12"  ng-controller="profileController" >
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
       
	             <section id="view-product" >
         <div class="container">
            <div class="row">
		 
							  
               <div class="col-lg-2 col-sm-12" ng-controller="myCtrl">
                  <div class="categories">
                     <div class="heading">
                        <h6> <i class=" fa fa-cog"></i> Categories</h6>
                     </div>
                     <ul class="list-unstyled">
                        <li class="active" ng-repeat="cat in categories">
                           <a href="#@{{cat.category_title}}">@{{cat.category_title}}</a>
						    <ul class="list-unstyled">
                               <li class=" " ng-repeat="subcat in cat.sub_categories">
                                <a href="#@{{subcat.category_title}}">@{{subcat.category_title}}</a>
								<ul class="list-unstyled">
                                   <li class=" " ng-repeat="subcat1 in subcat.sub_categories">
                                     <a href="#@{{subcat1.category_title}}">@{{subcat1.category_title}}</a>
						           </li>
                                </ul>
						      </li>
                            </ul>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-7 col-sm-12">
                  <ul class="nav nav-tabs">
                     <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#menu">
                        <i class="fa fa-cutlery"></i> Menu
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reviews">
                        <i class="fa fa-comments"></i> Reviews
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#info">
                        <i class="fa fa-info-circle"></i> Info
                        </a>
                     </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div class="tab-pane active  " id="menu">
                        <div class="form-group has-search">
                           <!-- <span class="fa fa-search form-control-feedback"></span> -->
                           <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <ul class="list-unstyled list-view"  ng-repeat="cat in categories">
                           <h5 class="category-name" id="@{{cat.category_title}}">@{{cat.category_title}}</h5>
                           <p>Choose your cut: Triangular, square, fingers or Un cut on any size pizza</p>
                           <li ng-repeat ="list in cat.items">
                              <div class="row view-row">
                                 <div class="col-lg-2 col-sm-2 col-xs-2">
                                    <div class="img-holder">
                                       <figure>
                                          <img ng-show="list.item_photo" src="{{URL::asset('images/items')}}/@{{list.item_photo}}">  
										  <img ng-show="!list.item_photo"src="{{URL::asset('admin/assets/images/img-placeholder.png')}}">  
                                       </figure>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="text-holder">
                                       <div class="post-title">
                                          <h5>
                                             @{{list.item_title}}
                                          </h5>
                                          <p>Lorem ipsum dollar sit together</p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-sm-4 col-xs-4 list-option">
                                    <div class="row">
                                       <div class="col-lg-6 col-sm-6 col-xs-6">
                                          <span> <?php echo env('CURRENCY_SYMBOL');?>@{{list.item_price}} </span>
                                       </div>
                                       <div class="col-lg-6 col-sm-6 col-xs-6">
                                          <a href="javascript:void(0)" ng-click="myFunc(list)" ng-style="color" >
                                          <i class="fa fa-plus ">
                                          </i>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                     <div class="tab-pane  " id="reviews">
                        <h3>(35) Reviews</h3>
                        <div class="row">
                           <div class="col-lg-3 col-sm-3">
                              <div class="border-right text-center">
                                 <span>3.5</span><span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <p>Order Packaging</p>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3">
                              <div class="border-right text-center">
                                 <span>3.5</span><span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <p>Order Packaging</p>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3">
                              <div class="border-right text-center">
                                 <span>3.5</span><span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <p>Order Packaging</p>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3">
                              <div class="text-center">
                                 <span>3.5</span><span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star"></span>
                                 <span class="fa fa-star"></span>
                                 <p>Order Packaging</p>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="reviews-list">
                                 <div class="card">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="row">
                                             <div class="col-lg-6 col-sm-6">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span><span> Lorem Ipsum</span>
                                             </div>
                                             <div class="col-lg-6 col-sm-6">
                                                <div class="review-date">
                                                   24 June 2018
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="review-text">
                                                   <p>In general the food is good, but several times Chicken is not well done for burgers, previously was one of the best burgers .. now i always receive the chicken not well done or its really disgusting Im extremely upset</p>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="row">
                                             <div class="col-lg-6 col-sm-6">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span><span> Lorem Ipsum</span>
                                             </div>
                                             <div class="col-lg-6 col-sm-6">
                                                <div class="review-date">
                                                   24 June 2018
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="review-text">
                                                   <p>In general the food is good, but several times Chicken is not well done for burgers, previously was one of the best burgers .. now i always receive the chicken not well done or its really disgusting Im extremely upset</p>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="row">
                                             <div class="col-lg-6 col-sm-6">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span><span> Lorem Ipsum</span>
                                             </div>
                                             <div class="col-lg-6 col-sm-6">
                                                <div class="review-date">
                                                   24 June 2018
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="review-text">
                                                   <p>In general the food is good, but several times Chicken is not well done for burgers, previously was one of the best burgers .. now i always receive the chicken not well done or its really disgusting Im extremely upset</p>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="row">
                                             <div class="col-lg-6 col-sm-6">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span><span> Lorem Ipsum</span>
                                             </div>
                                             <div class="col-lg-6 col-sm-6">
                                                <div class="review-date">
                                                   24 June 2018
                                                </div>
                                             </div>
                                             <div class="col-lg-12">
                                                <div class="review-text">
                                                   <p>In general the food is good, but several times Chicken is not well done for burgers, previously was one of the best burgers .. now i always receive the chicken not well done or its really disgusting Im extremely upset</p>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane container" id="info">
                        <h3> Restaurant Name</h3>
                        <div class="row">
                           <div class="col-lg-12 col-sm-2">
                              <div class="table-responsive">
                                 <table class="table table-condensed">
                                    <tr>
                                       <td>Minimum Order Amount</td>
                                       <td> AED 0.00</td>
                                    </tr>
                                    <tr>
                                       <td>Working Hours (Today)</td>
                                       <td>10:00AM - 1:00AM</td>
                                    </tr>
                                    <tr>
                                       <td>Delivery Time</td>
                                       <td>45 mins</td>
                                    </tr>
                                    <tr>
                                       <td>Pre-order</td>
                                       <td>No</td>
                                    </tr>
                                    <tr>
                                       <td>Payment</td>
                                       <td><i class="fa fa-cc-visa"></i></td>
                                    </tr>
                                    <tr>
                                       <td>Rating</td>
                                       <td><span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star"></span>
                                          <span class="fa fa-star"></span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>Cuisines</td>
                                       <td>Cafe, Burgers</td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-12">
                  <div class="order-sort-results">
                     <h5> <i class="fa fa-cart"></i> Your Order</h5>
                     <hr>
                     <p class="pre-order"> This restaurant allows Pre Orders.</p>
                     <div class="card" ng-show ="IsVisible">
                        <span>If you have a discount code, you will be able to input it at the payments stage.</span>
                     </div>
                     <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                           <div class="radio"> 
                              <label class="radio-inline">
                              <input type="radio" name="choose-option" value="Pick Up Fee" ng-model="value"> Pick Up 
                              </label>
                           </div>
                        </li>
                        <li class="list-inline-item">
                           <div class="radio"> 
                              <label class="radio-inline">
                              <input type="radio" name="choose-option" value="Delivery Fee" ng-model="value"> Delivery 
                              </label>
                           </div>
                        </li>
                     </ul>
                     <hr>
                     <div class="order-list">
                        <table class="table">
                           <tr ng-repeat = "value in products track by $index">
                              <td style="font-size:11px">@{{value.item_title}}</td>
                              <td  style="font-size:11px">$ @{{value.item_price}}</td>
                              <td  style="font-size:11px"><i class="fa fa-close" ng-click="myFunc1()"></i></td>
                           </tr>
                        </table>
                        <table class="table" class="subtotal" ng-show="Istotal" style="margin-top:60px;border-top:2px solid #ccc">
                           <tr>
                              <td>Sub Total :</td>
                              <td>$ @{{getTotal()}}</td>
                           </tr>
                           <tr >
                              <td>@{{value}} :</td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>VAT :</td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>Total+ : @{{getTotal()}}</td>
                              <td></td>
                           </tr>
                        </table>
                     </div>
                     <hr>
                     <ul class="list-unstyled list-inline">
                        <i class="fa fa-money"></i>
                        <li class="list-inline-item">
                           <div class="radio"> 
                              <label class="radio-inline">
                              <input type="radio" name="choose-option"> Cash
                              </label>
                           </div>
                        </li>
                        <i class="fa fa-cc-visa"></i>
                        <li class="list-inline-item">
                           <div class="radio"> 
                              <label class="radio-inline">
                              <input type="radio" name="choose-option"> Card
                              </label>
                           </div>
                        </li>
                     </ul>
                     <div class="confirm-button">
                        <button class="btn btn-confirm btn-block" ng-click="myPayment()"><a href="order-detail.html">Confirm Your Order</a></button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
                     <!--------------------------Angular App Starts ------------------------------------
                     <div   ng-controller="orderController as main" ng-cloak> 
							 	 
                        <div class="container-fluid ">
                           <div class="row order-content" >
						  
                              <div class="col-sm-3 col-lg-2" >
                                 <div class="form-group"  >
                                    <div class="input-group">
                                       <input type="text" class="form-control"   ng-model="search" placeholder="Search by item" >
                                       <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    </div>
                                 </div>
                                 <nav role="navigation" class="sidebar-body" >
                                    <h4 class="sidebar-title">Categories</h4>
									 
                                    <ul class=" ">
                                       <li ng-repeat="categories in main.addOrder" class="active " >
                                          <a  class="main" href="#@{{categories.category_title}}"> <span>@{{categories.category_title}}</span> </a>
                                          <ul class="acc-menu">
                                             <li ng-repeat="subCategories in categories.sub_categories ">
                                                <a  class="sub" href="#@{{subCategories.category_title}}"><span>@{{subCategories.category_title}}</span></a>
                                                <ul class="">
                                                   <li ng-repeat="subCategories in subCategories.sub_categories " >
                                                      <a class="subsub" href="#@{{subCategories.category_title}}"><span>@{{subCategories.category_title}}</span></a>
                                                      <ul class="acc-menu">
                                                         <li ng-repeat="subCategories in subCategories.sub"><a href="#@{{subCategories.category_title}}"><span>@{{subCategories.category_title}}</span></a></li>
                                                      </ul>
                                                   </li>
                                                </ul>
                                             </li>
                                          </ul>
                                       </li>
                                    </ul>
                                 </nav>
                              </div> 

                              <div class="col-sm-5  col-lg-7 text-right" >
                                 <div class="tab-content">
                                    <div class="panel-group product-view" id="accordion">
                                       <div ng-repeat="categories in main.addOrder | filter:search" id ="@{{categories.category_title}}" class="tab-pane fade in active">
                                          <div ng-show="categories.items != '' ">
                                             <div class="panel ">
                                                <div class="panel-heading">
                                                   <h4 class="panel-title text-left">
                                                      @{{categories.category_title}} <span>(@{{categories.items.length}} items)</span> <a data-toggle="collapse" data-parent="#accordion" href="#1@{{categories.category_title}}">  <i class="fa fa-angle-down"></i></a>
                                                   </h4>
                                                </div>
                                                <div id="1@{{categories.category_title}}" class="panel-collapse collapse in">
                                                   <table class="table items-detail">
                                                      <tbody>
                                                         <tr ng-repeat="item in categories.items | filter:search"  >
                                                            <td class="item-image ">
															      <img src="admin/images/item-placeholder.png" ng-show="item.item_photo == null">
															      <img src="{{URL::asset('/products')}}/@{{item.item_photo}}" ng-show="item.item_photo != null">
															   </td>
                                                            <td class="item-title"> @{{item.item_title}} </td>
                                                            <td class="item-price"><span ng-show='item.item_price > 0'><?php echo env('CURRENCY_SYMBOL');?>@{{item.item_price}} </span>
                                                            <span ng-show='item.item_price == 0'>Price on Selection</span>															</td>
                                                            <td class="item-createdTime  "><button class="btn-addCart" ng-click="main.addToCart(item)"><i class="fa fa-plus"></i></button></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                          <div ng-repeat="subCategories in categories.sub_categories" id ="@{{subCategories.category_title}}" class="tab-pane fade in active">
                                             <div ng-show="subCategories.items != ''" >
                                                <div class="panel ">
                                                   <div class="panel-heading">
                                                      <h4 class="panel-title text-left">
                                                         @{{subCategories.category_title}} <span>(@{{subCategories.items.length}} items)</span> <a data-toggle="collapse" data-parent="#accordion" href="#2@{{subCategories.category_title}}"> <i class="fa fa-angle-down"></i></a>
                                                      </h4>
                                                   </div>
                                                   <div id="2@{{subCategories.category_title}}" class="panel-collapse collapse in">
                                                      <table  class="table items-detail">
                                                         <tbody>
                                                            <tr ng-repeat="item in subCategories.items | filter:search ">
                                                               <td class="item-image ">
															      <img src="admin/images/item-placeholder.png" ng-show="item.item_photo == null">
															      <img src="{{URL::asset('/products')}}/@{{item.item_photo}}" ng-show="item.item_photo != null">
															   </td>
                                                               <td class="item-title"> @{{item.item_title}} </td>
                                                               <td class="item-price"><span ng-show='item.item_price > 0'><?php echo env('CURRENCY_SYMBOL');?>@{{item.item_price}} </span>
                                                            <span ng-show='item.item_price == 0'>Price on Selection</span>  </td>
                                                               <td class="item-createdTime text-right"><button class="btn-addCart" ng-click="main.addToCart(item)" ng-disable="item.showAddToCart && !item.addedToCart"><i class="fa fa-plus"></i></button></td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </div>
                                             <div ng-repeat="subCategories in subCategories.sub_categories" id ="@{{subCategories.category_title}}" class="tab-pane fade in active">
                                                <div ng-show="subCategories.items != ''">
                                                   <div class="panel ">
                                                      <div class="panel-heading">
                                                         <h4 class="panel-title text-left">
                                                            @{{subCategories.category_title}} <span>(@{{subCategories.items.length}} items)</span><a data-toggle="collapse" data-parent="#accordion" href="#3@{{subCategories.category_title}}"> <i class="fa fa-angle-down"></i></a>
                                                         </h4>
                                                      </div>
                                                      <div id="3@{{subCategories.category_title}}" class="panel-collapse collapse in">
                                                         <table  class="table items-detail">
                                                            <tbody>
                                                               <tr ng-repeat="item in subCategories.items | filter:search">
                                                                  <td class="item-image ">
															        <img src="admin/images/item-placeholder.png" ng-show="item.item_photo == null">
															        <img src="{{URL::asset('/products')}}/@{{item.item_photo}}" ng-show="item.item_photo != null">
															      </td>
                                                                  <td class="item-title"> @{{item.item_title}} </td>
                                                                  <td class="item-price"><span ng-show='item.item_price > 0'><?php echo env('CURRENCY_SYMBOL');?>@{{item.item_price}} </span>
                                                            <span ng-show='item.item_price == 0'>Price on Selection</span>  </td>
                                                                  <td class="item-createdTime text-right"><button class="btn-addCart" ng-click="main.addToCart(item)"><i class="fa fa-plus"></i></button></td>
                                                               </tr>
                                                            </tbody>
                                                         </table>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div ng-repeat="subCategories in subCategories.sub" id ="@{{subCategories.category_title}}" class="tab-pane fade in active">
                                                   <div ng-show="subCategories.items != ''">
                                                      <div class="panel ">
                                                         <div class="panel-heading">
                                                            <h4 class="panel-title text-left">
                                                               @{{subCategories.category_title}} <span>(@{{subCategories.items.length}} items)</span><a data-toggle="collapse"  data-parent="#accordion" href="#4@{{subCategories.category_title}}"> <i class="fa fa-angle-down"></i></a></span> 
                                                            </h4>
                                                         </div>
                                                         <div id="4@{{subCategories.category_title}}" class="panel-collapse collapse in">
                                                            <table  class="table items-detail">
                                                               <tbody>
                                                                  <tr ng-repeat="item in subCategories.items | filter:search ">
                                                                     <td class="item-image ">
															          <img src="admin/images/item-placeholder.png" ng-show="item.item_photo == null">
															          <img src="{{URL::asset('/products')}}/@{{item.item_photo}}" ng-show="item.item_photo != null">
															         </td>
                                                                     <td class="item-title"> @{{item.item_title}}  </td>
                                                                     <td class="item-price"><span ng-show='item.item_price > 0'><?php echo env('CURRENCY_SYMBOL');?>@{{item.item_price}} </span>
                                                            <span ng-show='item.item_price == 0'>Price on Selection</span>  </td>
                                                                     <td class="item-createdTime text-right"><button class="btn-addCart" ng-click="main.addToCart(item)"><i class="fa fa-plus"></i></button></td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
							  </div> 
				
                        </div>
                     </div>
                  
                              
                              <!--------------------------Angular App Ends ------------------------------------>
                           

<!------>
       
@section('footer')
@include('web-food.includes.footer')
@show
<!------>

<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/order-items.js')}}"></script> 
 <script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/place_order.js')}}"></script> 

@endsection