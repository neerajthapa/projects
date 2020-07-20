   <header>
   <nav class="navbar navbar-inverse  ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home"></a>
          
        </div>
        <div id="navbar" class="navbar-collapse collapse">

          <div class="navbar-form navbar-right"> 
            <md-button type="button"  class="btn md-raised bg-color md-submit md-button md-ink-ripple">Account</md-button>
			
			
				<div class="dropdown">
			  <md-button class="btn md-raised bg-color md-submit md-button md-ink-ripple dropdown-toggle" type="button" data-toggle="dropdown">Hi, Yugal
			  <span class="caret"></span></md-button>
			  <ul class="dropdown-menu">
				<li><a href="{{URL::to('my-orders')}}"><i class="fa fa-list"></i>My Orders</a></li>
				<li><a href="{{URL::to('addresses')}}"><i class="fa fa-map-marker-alt"></i>Manage Addresses</a></li>
				<li><a href="{{URL::to('reviews')}}"><i class="fa fa-list"></i>My Reviews</a></li>
				<li><a href="{{URL::to('favourites')}}"><i class="fa fa-star"></i>Favourites</a></li>
				<li><a href="{{URL::to('account')}}"><i class="fa fa-wrench"></i>Account Settings</a></li>
				<li><a href="#"><i class="fa fa-sign-out-alt"></i>Signout</a></li>
			  </ul>
			</div>
				
          </div>
          
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	
	</header>
	
	 
