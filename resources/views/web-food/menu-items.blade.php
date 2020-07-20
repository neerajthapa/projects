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

<?php $currency_symbol = @\App\Setting::where( 'key_title' , 'currency_symbol' )->first(['key_value'])->key_value;  ?>
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
      <div class="row"  ng-controller="orderController as main" ng-cloak>
         <div class="col-sm-3 col-md-3 col-lg-2" >
            <div class="form-group"  >
               <div class="input-group">
                  <input type="text" class="form-control"   ng-model="search" placeholder="Search by item" >
                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
               </div>
            </div>
            <div class="panel">
               <nav role="navigation" class="sidebar-body " >
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
         </div>
         <div class="col-lg-7 col-md-6 col-sm-12">
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
            <div class="tab-content" style="padding-top:0px;background:transparent;">
               <div class="tab-pane active  " id="menu">
                  <div class=" product-view" id="accordion">
                     <div ng-repeat="categories in main.addOrder | filter:search" id ="1@{{categories.category_title}}" class="tab-pane fade in active  ">
                        <div class="panel-group" ng-show="categories.items != '' ">
                           <div class="panel ">
                              <div class="panel-body">
                                 <h4 class="panel-title text-left">
                                    @{{categories.category_title}} <span>(@{{categories.items.length}} items)</span> <a data-toggle="collapse" data-parent="#accordion" href="#1@{{categories.category_title}}">  <i class="fa fa-angle-down"></i></a>
                                 </h4>
                            </div> 
                              <div id="1@{{categories.category_title}}" class=" panel-collapse collapse in">
                                 <div class="row view-row" ng-repeat="item in categories.items | filter:search">
                                    <div class="col-lg-2 col-sm-2 col-xs-2">
                                       <div class="img-holder">
                                          <figure>
                                             <img ng-show="item.item_photo" src="{{URL::asset('images/items')}}/@{{item.item_photo}}" class="img-responsive center-block;">  
                                             <img ng-show="!item.item_photo"src="{{URL::asset('admin/assets/images/img-placeholder.png')}}" class="img-responsive center-block;">  
                                          </figure>
                                       </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-6">
                                       <div class="text-holder">
                                          <div class="post-title">
                                             <h5>
                                                @{{item.item_title}}
                                             </h5>
                                             <p> </p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-xs-4 list-option">
                                       <div class="row">
                                          <div class="col-md-7 col-sm-6 col-xs-6">
                                             <span> <?php echo @$currency_symbol;?>@{{item.item_price}} </span>
                                          </div>
                                          <div class="col-md-5 col-sm-6 col-xs-6">
                                             <a href="javascript:void(0)" ng-click="main.addToCart(item)" ng-style="color" >
                                             <i class="fa fa-plus ">
                                             </i>
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!--<table class="table items-detail">
                                    <tbody>
                                       <tr ng-repeat="item in categories.items | filter:search" class="view-row" >
                                          <td class="img-holder ">
                                    <figure style="height:60px;width:60px;">
                                    <img src="{{URL::asset('/admin/assets/images/img-placeholder.png')}}" ng-show="item.item_photo == ''" class="img-responsive">
                                    <img src="{{URL::asset('/products')}}/@{{item.item_photo}}" ng-show="item.item_photo != ''" class="img-responsive">
                                    </figure>
                                    </td>
                                          <td class="text-holder"> <h5>@{{item.item_title}} </h5></td>
                                          <td class="item-price list-option"><span ng-show='item.item_price > 0'><?php echo env('CURRENCY_SYMBOL');?>@{{item.item_price}} </span>
                                          <span ng-show='item.item_price == 0'>Price on Selection</span>															</td>
                                          <td class="item-createdTime  "><a ng-style="color" class="btn-addCart" ng-click="main.addToCart(item)"><i class="fa fa-plus"></i></a></td>
                                       </tr>
                                    </tbody>
                                    </table>-->
                              </div> 
                           </div>
                        </div>
                        <div ng-repeat="subCategories in categories.sub_categories" id ="2@{{subCategories.category_title}}" class="tab-pane fade in active ">
                           <div class="panel-group" ng-show="subCategories.items != ''" >
                              <div class="panel ">
                                 <div class="panel-heading">
                                    <h4 class="panel-title text-left">
                                       @{{subCategories.category_title}} <span>(@{{subCategories.items.length}} items)</span> <a data-toggle="collapse" data-parent="#accordion" href="#2@{{subCategories.category_title}}"> <i class="fa fa-angle-down"></i></a>
                                    </h4>
                                 </div>
                                 <div id="2@{{subCategories.category_title}}" class="panel-collapse collapse in">
                                    <div class="row view-row" ng-repeat="item in subCategories.items | filter:search">
                                       <div class="col-lg-2 col-sm-2 col-xs-2">
                                          <div class="img-holder">
                                             <figure>
                                                <img ng-show="item.item_photo" src="{{URL::asset('images/items')}}/@{{item.item_photo}}" class="img-responsive center-block;">  
                                                <img ng-show="!item.item_photo"src="{{URL::asset('admin/assets/images/img-placeholder.png')}}" class="img-responsive center-block;">  
                                             </figure>
                                          </div>
                                       </div>
                                       <div class="col-lg-6 col-sm-6 col-xs-6">
                                          <div class="text-holder">
                                             <div class="post-title">
                                                <h5>
                                                   @{{item.item_title}}
                                                </h5>
                                                <p> </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-4 col-sm-4 col-xs-4 list-option">
                                          <div class="row">
                                             <div class="col-md-7 col-sm-6 col-xs-6">
                                                <span> <?php echo @$currency_symbol;?>@{{item.item_price}} </span>
                                             </div>
                                             <div class="col-md-5 col-sm-6 col-xs-6">
                                                <a href="javascript:void(0)" ng-click="main.addToCart(item)" ng-style="color" >
                                                <i class="fa fa-plus ">
                                                </i>
                                                </a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div ng-repeat="subCategories in subCategories.sub_categories" id ="@{{subCategories.category_title}}" class="tab-pane fade in active panel-group">
                              <div ng-show="subCategories.items != ''">
                                 <div class="panel ">
                                    <div class="panel-heading">
                                       <h4 class="panel-title text-left">
                                          @{{subCategories.category_title}} <span>(@{{subCategories.items.length}} items)</span><a data-toggle="collapse" data-parent="#accordion" href="#3@{{subCategories.category_title}}"> <i class="fa fa-angle-down"></i></a>
                                       </h4>
                                    </div>
                                    <div id="3@{{subCategories.category_title}}" class="panel-collapse collapse in">
                                       <div class="row view-row" ng-repeat="item in subCategories.items | filter:search">
                                          <div class="col-lg-2 col-sm-2 col-xs-2">
                                             <div class="img-holder">
                                                <figure>
                                                   <img ng-show="item.item_photo" src="{{URL::asset('images/items')}}/@{{item.item_photo}}" class="img-responsive center-block;">  
                                                   <img ng-show="!item.item_photo"src="{{URL::asset('admin/assets/images/img-placeholder.png')}}" class="img-responsive center-block;">  
                                                </figure>
                                             </div>
                                          </div>
                                          <div class="col-lg-6 col-sm-6 col-xs-6">
                                             <div class="text-holder">
                                                <div class="post-title">
                                                   <h5>
                                                      @{{item.item_title}}
                                                   </h5>
                                                   <p></p>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-4 col-sm-4 col-xs-4 list-option">
                                             <div class="row">
                                                <div class="col-md-7 col-sm-6 col-xs-6">
                                                   <span> <?php echo @$currency_symbol;?>@{{item.item_price}} </span>
                                                </div>
                                                <div class="col-md-5 col-sm-6 col-xs-6">
                                                   <a href="javascript:void(0)" ng-click="main.addToCart(item)" ng-style="color" >
                                                   <i class="fa fa-plus ">
                                                   </i>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div ng-repeat="subCategories in subCategories.sub" id ="@{{subCategories.category_title}}" class="tab-pane fade in active panel-group">
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
                                                      <img src="admin/assets/images/item-placeholder.png" ng-show="item.item_photo == null" class="img-responsive center-block;">
                                                      <img src="{{URL::asset('/products')}}/@{{item.item_photo}}" ng-show="item.item_photo != null" class="img-responsive center-block;">
                                                   </td>
                                                   <td class="item-title"> @{{item.item_title}}  </td>
                                                   <td class="item-price"><span ng-show='item.item_price > 0'><?php echo @$currency_symbol;?>@{{item.item_price}} </span>
                                                      <span ng-show='item.item_price == 0'>Price on Selection</span>  
                                                   </td>
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
               <!----------------------------------------------MENU TAB SECTION ENDS HERE--------------------------------------------->
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
               <!-------------------REVIEW SECTION ENDS HERE---------------------------------------->
               <!-------------------INFO SECTION STARTS HERE---------------------------------------->
               <div class="tab-pane  " id="info">
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
         <!---------------------------RIGHT SECTION STARTS HERE------------------------>
         <hr>
         <div class="col-sm-4 col-md-3" >
            <div ng-controller="cartController as cart" >
               <div class="panel"  >
                  <div class="panel-body order-sort-results">
                     <h5> <i class="fa fa-shopping-cart"></i> <b>Your Order</b></h5>
                     <hr>
                     <p class="text-center" ng-show="cart.cartStorage.items == ''" style="font-size:13px;color:#ccc;">No item in cart</p>
                     <div class="row cart_table" ng-repeat="item in cart.cartStorage.items track by $index" style="padding-bottom:7px; " >
                        <div class="col-sm-12">
                           <h4  style="font-size:12px"><b>@{{item.item_title}}</b>
                              <span ng-show="item.variants != ''"  ><a href="#" data-toggle="tooltip" title="@{{variantsSelectedTitleData}} ">&#9432;</a></span> 
                              <span ng-show="item.variants" ng-repeat="variant in item.variants">@{{variant.title}} </span> 
                           </h4>
                        </div>
                        <div class="col-sm-6 text-center">
                           <p  style="font-size:12px">
                              <button ng-click="cart.increaseItemAmount(item)">
                              +
                              </button>
                              @{{item.quantity}} 
                              <button ng-click="cart.decreaseItemAmount(item)">
                              -
                              </button>
                           </p>
                        </div>
                        <div class="col-sm-2">
                           <p  style="font-size:12px"><?php echo @$currency_symbol;?>@{{item.discounted_price}}</p>
                        </div>
                        <div class="col-sm-2">
                           <button ng-click="cart.removeFromCart(item)"  >
                           <i class="fa fa-minus"></i>
                           </button>
                        </div>
                     </div>
                     <div class="row  "      >
                        <div class="col-sm-12">
                           <hr>
                           <h5><b>Payment summary</b></h5>
                           <p class="text-center" ng-show="cart.cartStorage.items == ''" style="font-size:13px;color:#ccc;">No Payment info</p>
                           <table class="table paymentSummary main-cart" >
                              <tbody ng-repeat="data in main.paymentData.data" >
                                 <tr ng-repeat="values in data.data">
                                    <td class="" style="font-size:14px;text-transform: capitalize">@{{values.title.replace('_', ' ')  }} </td>
                                    <td class="text-right" style="font-size:14px"> <?php echo @$currency_symbol;?>@{{values.value}} </td>
                                 </tr>
                                 <tr style="background:#f5f5f5;">
                                    <td class="" style="font-size:14px;text-transform: capitalize">Total </td>
                                    <td class="text-right" style="font-size:14px"> <?php echo @$currency_symbol;?>@{{data.total}} </td>
                                 </tr>
                              </tbody >
                           </table>
                           <table class="table paymentSummary  cart" >
                              <tbody ng-repeat="data in cart.paymentData.data">
                                 <tr  ng-repeat="values in data.data">
                                    <td class="" style="font-size:14px;text-transform: capitalize">@{{values.title.replace('_', ' ')  }} </td>
                                    <td class="text-right" style="font-size:14px"> <?php echo @$currency_symbol;?>@{{values.value}} </td>
                                 </tr>
                                 <tr style="background:#f5f5f5;">
                                    <td class="" style="font-size:14px;text-transform: capitalize">Total </td>
                                    <td class="text-right" style="font-size:14px"> <?php echo @$currency_symbol;?>@{{data.total}} </td>
                                 </tr>
                              </tbody >
                           </table>
                        </div>
                     </div>
                     <div class="confirm-button">
                        <button class="btn btn-confirm btn-block" ng-click="main.proceed()"><a href=" ">Proceed</a></button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="panel-body">
            </div>
         </div>
      </div>
   </div>
   </div>
   </div>
</section>
<!------>
@section('footer')
@include('web-food.includes.footer')
@show
<!------>
<script type="text/javascript" src='https://rawgithub.com/gsklee/ngStorage/master/ngStorage.js'></script>

<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/place_order.js')}}"></script> 

@endsection