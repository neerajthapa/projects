<footer>
  <section>
	 <div class="container ">
		<div class="row">
		  <div class="col-sm-12" ng-controller="newsletterController">
		  <h3 class="foot-title text-center text-uppercase">Subscribe to our newsletter</h3>
		  <form class="form-inline text-center">
			<div class="form-group">
			  <input type="email" class="form-control" id="newsletter-email" name="newsletter-email" placeholder="Enter your Email Address...">
			</div> 
			<md-button  ng-click="submitNewsletter()" class="btn md-raised bg-color md-submit md-button md-ink-ripple">sign up</md-button>
		  </form>
		  </div>
		  
		</div>
	 </div>
   </section>
   
   <section>
	 <div class="container">
		<div class="row">
		  <div class="col-sm-3">
		    <div class="widget">
		      <ul>
			    <li><a href="">About Us</a></li>
				<li><a href="">Terms & Conditions</a></li>
				<li><a href="">Privacy Policy</a></li>
				<li><a href="{{URL::to('faq')}}">FAQ</a></li>
			  </ul>
			</div>
		  </div>
		  
		  <div class="col-sm-3">
		    <div class="widget">
		      <ul>
			    <li><a href="">Contact Us</a></li>
				<li>info@foodapp.com</li>
				<li>+1 123 4567890</li> 
			  </ul>
			</div>
		  </div>
		   <div class="col-sm-3">
		   </div>
		  <div class="col-sm-3">
		    <div class="widget">
		      <ul>
			    <li><a href="">Follow Us</a></li>
				<ul class="list-inline"> 
				   <li><a href="#"><i class="fab fa-facebook"></i></a></li>
				   <li><a href="#"><i class="fab fa-twitter"></i></a></li>
				   <li><a href="#"><i class="fab fa-google"></i></a></li>
				</ul>
			  </ul>
			</div>
		  </div> 
		</div>
	 </div>
   </section>
   
   
   <section>
      <div class="container">
		<div class="row">
		  <div class="col-sm-12  ">
		     <p class="text-center text-uppercase">2018 food delivery. All rights reserved. powered by <a href="https://www.goteso.com" target="_blank">Goteso</a></p>
		  </div> 
		</div>
	 </div>
   </section>
</footer>