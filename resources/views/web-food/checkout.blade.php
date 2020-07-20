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
         <div class="col-sm-8 col-md-9" >
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
         <!---------------------------RIGHT SECTION STARTS HERE------------------------>
         <hr>
         <div class="col-sm-4 col-md-3" >
            <div ng-controller="checkoutController as cart" >
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
                        <button class="btn btn-confirm btn-block" ng-click="myPayment()"><a href="order-detail.html">Proceed</a></button>
                     </div>
                  </div>
               </div>
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
<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/place_order.js')}}"></script> 
@endsection