<div class="main ">
   <md-autocomplete ng-disabled="isDisabled" md-no-cache="noCache" md-selected-item="selectedItem" md-search-text-change="searchTextChange(searchText)" md-search-text="searchText" md-selected-item-change="selectedItemChange(item, field)" md-items="item in querySearch(searchText)" md-item-text="item.type" md-min-length="0" placeholder="Search Items , users & orders" md-menu-class="autocomplete-custom-template"  >
      <md-item-template> 
		  <span  style="display:inline-block;width:100%" ng-show="item.type == 'items'"  >
            <span   class="text-uppercase head">@{{item.type}} (@{{item.data.length}})</span>
            <span class="main-head" ng-repeat="value in item.data">
               <a href="<?php echo env("APP_URL", "");?>/v1/item/@{{value.item_id}}" style="line-height:0px;"  >
                  <span class="item-title" >
                     <span > <img src="{{URL::asset('admin/assets/images/item-placeholder.png')}}" style="height:40px;width:40px;">		</span>										  
                     <p> @{{value.item_title}}  <br>
                        <span class="subtitle"><?php echo env("CURRENCY_SYMBOL", "");?>@{{value.item_price}}</span>
                     </p>
                  </span>
                  <span class="item-metadata"  >
                  </span>
            </span>
            </a> 
         </span>
         <span  style="display:inline-block;width:100%" ng-show="item.type == 'users'"  >
            <span   class="text-uppercase head">@{{item.type}}</span>
            <span class="main-head" ng-repeat="value in item.data">
               <a href="<?php echo env("APP_URL", "");?>/v1/customer-profile/@{{value.user_id}}" style="line-height:0px;"  >
                  <span class="item-title" >
                     <span > <img src="{{URL::asset('admin/assets/images/boy.png')}}" style="height:40px;width:40px;">		</span>										  
                     <p> @{{value.first_name}} @{{value.last_name}}  <br>
                        <span class="subtitle">@{{value.email}}</span>
                     </p>
                  </span>
                  <span class="item-metadata"  >
                  </span>
            </span>
            </a> 
         </span>
         <span style="display:inline-block;width:100%" ng-show="item.type == 'orders'">
         <span   class="text-uppercase head">@{{item.type}}</span>
         <span class="main-head" ng-repeat="value in item.data" style="padding:4px;"> 
         <a href="<?php echo env("APP_URL", "");?>/v1/order-detail/@{{item.order_id}}" style="line-height:0px;"> 
          <span class="item-title" >
              <span ># @{{value.order_id}} 	</span>	
              <p>@{{value.status_details[0]['title']  }} <br>
         <span class="subtitle">  @{{value.total}}</span>
         </p> 
          </span>
         <span class="item-metadata">   
         </span>
        </span>
        </a>
        </span>
      </md-item-template>
   </md-autocomplete>
</div>