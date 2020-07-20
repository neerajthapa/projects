<?php 
 
$auth_user_type = @\Auth::user()->user_type;   
$auth_user_id =   @\Auth::id();
$auth_app_type = @\Auth::user()->app_type;  
//App::setLocale('settings');   
 
if($auth_user_type == '1' || $auth_user_type == 1 )
{
     $user_type_title = 'SUPER ADMIN';
}

if($auth_user_type == '3' || $auth_user_type == 3 )
{
   $user_type_title = 'RESTAURANT';
}

if($auth_user_type == '4' || $auth_user_type == 4 )
{
   $user_type_title = 'STORE MANAGER';
}


if($auth_app_type == 'grocery'  )
{
     $app_type = env('APP_NAME_GROCERY');
}
if($auth_app_type == 'mechanic'   )
{
   $app_type = env('APP_NAME_MECHANIC');
}
if($auth_app_type == 'laundry'  )
{
   $app_type = env('APP_NAME_LAUNDRY');
}

if($auth_app_type == 'delivery'  )
{
   $app_type = env('APP_NAME_DELIVERY');
}

 // $business_logo = @\App\Setting::where( 'key_title' , 'business_logo' )->first(['key_value'])->key_value;
?>
 
 
<header id="topnav" class="navbar navbar-dark navbar-fixed-top clearfix" role="banner" style="z-index:10;">
   

   <span id="trigger-sidebar" class="toolbar-trigger" >
      <div class="navbar-header" style="height: 100%;" >
         <a class="navbar-brand" href="#" style="height: 50px;" >
         <img src="<?php echo env('APP_URL')."/images/logo/".@$business_logo;?>" class="img-responsive" style="width:auto;height:35px;"></a>
      </div>
      <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar"><span class="icon-bg"><i class="fa fa-fw fa-bars"></i></span></a>
   </span>

      
 

   <ul class="nav navbar-nav toolbar pull-right">
 
                       <li>  <p style="color:white;margin-top:10%" class="hidden-xs"> <?php if($user_type_title != '') { ?> <?php echo $app_type;?> : <span style="color:green;font-weight:bold"><?php echo $user_type_title; }?></span></p></li>
 
      <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Add" role="button" aria-expanded="false">
         <span><i class="fa fa-plus-circle"></i></span>
         </a>
         <ul class="dropdown-menu entities" role="menu">
 
            <li style="display:none"> 
               <div class=" border" id="main"  >
                  <div class=" title">
                     <h5>SELECT APP TYPE</h5>
                  </div>
            
                     <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-6 col-sm-6">
                               <a href="{{ URL::to('/admin/dashboard-grocery') }}">
                                 <img src="{{ URL::to('admin/assets/images/product.png')}}" class="img-responsive center-block">
                                 <p class="text-center ">GROCERY</p>
                              </a>
                          </div>
                            <div class="col-lg-6 col-sm-6">
 
                              <a href="{{ URL::to('/admin/dashboard-laundry')}}">
 
                                <a href="{{ URL::to('/admin/dashboard-laundry')}}">
 
                                 <img src="{{ URL::to('admin/assets/images/categories.png')}}" class="img-responsive center-block">
                                 <p class="text-center">LAUNDRY</p>
                              </a>
                           </div>
                    </div>

 

               </div>
            </li>
         </ul>
      </li>
      <li class="dropdown">
         <a href="#" class="dropdown-toggle name" data-toggle="dropdown" title="Sign Out" role="button" aria-expanded="false">
            <span class="user-name"><i class="fas fa-sign-out-alt"></i></span><!--<span class="caret head"></span>-->
         </a>
         <ul class="dropdown-menu entities" role="menu">
            <li>
               <a id="logout" href="{{ url('/logouts') }}" >
               Logout
               </a>
               <form id="logout-form" action="{{ url('/logouts') }}" method="GET" style="display: none;">
               </form>
            </li>
         </ul>
      </li>
     
  
   </ul>
</header>