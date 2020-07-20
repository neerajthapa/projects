 
 <div class="static-sidebar-wrapper sidebar-default">
   <div class="static-sidebar">
      <div class="sidebar">
        <div class="widget stay-on-collapse" id="widget-sidebar">
            <nav role="navigation" class="widget-body">
               <ul class="acc-menu"> 
               
               <?php @$auth_user_type = @Auth::user()->user_type;   
                     @$auth_user_id =   @Auth::id();
                     App::setLocale('settings');  
                     if($auth_user_id =='' || $auth_user_id == null)
                     {
                           Auth::logout();
                           echo '<script>document.getElementById("logout").click();</script>';
                     }

                     if($auth_user_type == '4')
                     {
                     	$auth_store_id = @\App\Store::where('manager_id',$auth_user_id)->first(['store_id'])->store_id;
                     }
                     else
                     {
                     	$auth_store_id = '';
                     }
                ?>
                  <input type="hidden" id="auth_user_type" value="<?php echo $auth_user_type;?>">
                  <input type="hidden" id="auth_user_id" value="<?php echo $auth_user_id;?>">
                  <input type="hidden" id="auth_store_id" value="<?php echo $auth_store_id;?>">
                  <input type="hidden" id="auth_app_type" value="grocery">

   
				    <li><a href="{{ URL::to('/v1/dashboard_data-grocery') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard  </span></a></li>
 	          
        		 
					
				 

               </ul>
            </nav>
         </div>
      </div>
   </div>
</div>