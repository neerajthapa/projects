<!Doctype html>
<html>
   
   <head>
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>@yield('title')</title>
	    
			<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700" />
	        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
			
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"  >
			 <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/style.css')}}">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css" />
            <link rel="stylesheet" href="http://mbenford.github.io/ngTagsInput/css/ng-tags-input.min.css" /> 
            <link href="{{ URL::asset('admin/assets/datepicker/angular-datepicker.css')}}" rel="stylesheet" type="text/css" />
			 <link href="{{ URL::asset('admin/assets/datepicker/material-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
		
	        <link href="{{ URL::asset('admin/assets/css/styles-blessed24f47.css?z=1442568872107')}}" type="text/css" rel="stylesheet">
	        <link href="{{ URL::asset('admin/assets/css/main-style.css')}}" type="text/css" rel="stylesheet">
	   
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<link rel="stylesheet" href="https://npmcdn.com/angular-toastr/dist/angular-toastr.css" />
      
<style>
 toastr.options = {
  toastClass: 'alert',
  iconClasses: {
      error: 'alert-error',
      wait: 'alert-info',
      success: 'alert-info',
      warning: 'alert-warning',
      status: 'alert-info'
  }
} 

/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 12em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  text-align:center;
}

.loading p{color:#9e9e9e;font-family:'Open Sans';padding-top:10px;font-size:17px;}
/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: transparent;
}
</style>
		<meta name="csrf-token" content="{{ csrf_token() }}">
			
			  <link href="{{ URL::asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
			    <link href="{{ URL::asset('admin/assets/css/custom-styles.css')}}" rel="stylesheet" type="text/css" />
     <!--       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
			<!-----script files here------------> 
			
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
		
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.8/angular.js"></script>
	 <!--  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>-->
	   
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.min.js"></script>	
	  
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular-ui/0.4.0/angular-ui.min.js"></script>
	    
    <!--<script src="http://cdn.jsdelivr.net/g/jquery.ui.core.min.js+jquery.ui.widget.min.js+jquery.ui.mouse.min.js+angularjs@1.2"></script>-->
 
    
	
	  <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/angular-material.min.css')}}">
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	  
<script src="https://npmcdn.com/angular-toastr/dist/angular-toastr.tpls.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script>

  
  <script src="http://marceljuenemann.github.io/angular-drag-and-drop-lists/angular-drag-and-drop-lists.js"></script>
  <script src="http://marceljuenemann.github.io/angular-drag-and-drop-lists/demo/framework/vendor/prism.js"></script>
  
  <!-- Angular Material Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>
  
  
  <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCo0S5dcqwj11plZQyOn7Sx6VJPHQPVZko'></script>
  <script src="https://robsite.net/static/markermove/markerAnimate.js"></script>

 <script src="https://googlemaps.github.io/js-marker-clusterer/src/markerclusterer.js"></script>

<script src="https://robsite.net/static/markermove/jquery_easing.js"></script>
 
   <script src="{{ URL::asset('admin/assets/map/locationpicker.jquery.min.js')}}"></script>
   <script src="{{ URL::asset('admin/assets/map/angularLocationpicker.jquery.js')}}"></script>
   
  
	   
	    <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
			<script src="http://code.highcharts.com/stock/highstock.js"></script>
    <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script> 
		<script src="{{ URL::asset('admin/assets/datepicker/angular-datepicker.js')}}"></script> 
	  <script src="https://code.angularjs.org/1.2.28/angular-resource.min.js"></script>
	
    <script src="http://mbenford.github.io/ngTagsInput/js/ng-tags-input.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
		
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js"></script>


<script type="text/javascript" src="{{ URL::asset('admin/assets/datepicker/angular-material-datetimepicker.js')}}"></script>

		 <script src="//js.pusher.com/3.0/pusher.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/pusher-angular@latest/lib/pusher-angular.min.js"></script>
		<script> var APP_URL = '<?php echo env("APP_URL", "");?>';  </script>
        <script>
           window.Laravel = <?php echo json_encode([
               'csrfToken' => csrf_token(),
           ]); ?>
        </script>
		
		
		<style>
		  .autocomplete-custom-template li {
   border-bottom: 1px solid #efefef;
   height: auto!important;
   padding: 7px 12px; 
   white-space: normal;
   }
   .autocomplete-custom-template li a{text-decoration:none;}
   .autocomplete-custom-template li:last-child {
   border-bottom-width: 0;
   }
   .autocomplete-custom-template .item-title{color:#000; font-size:15px;font-weight:500;padding-left:12px !important;padding-right:12px !important;padding-top:6px!important;padding-bottom:4px!important;}
    .autocomplete-custom-template .item-metadata{color:#989898; font-size:14px;padding-left:12px !important;padding-right:12px !important;padding-top:0px;padding-bottom:5px;}
	.autocomplete-custom-template .item-image{display:inline-block}
		 .autocomplete-custom-template .item-title,
   .autocomplete-custom-template .item-metadata {
   display: block;
   line-height: 1.5;
   }
		 </style>
<script type="text/javascript" src="{{ URL::asset('admin/angular-controllers-grocery/realtimeSearch.js')}}"></script> 
 
   </head>
   <body  >
 
  
       @yield('content')
   </body>
   
   <script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
  
  
  <script>
function printData(tableToExport) { 
     var prtContent = document.getElementById("tableToExport").innerHTML;

    //Get the HTML of whole page
      var oldPage = document.body.innerHTML;

     //Reset the pages HTML with divs HTML only
     document.body.innerHTML =   "<html><head><title></title></head><body>" +   prtContent + "</body>";
 
     //Print Page
     window.print();

    //Restore orignal HTML
    document.body.innerHTML = oldPage; 
 }
</script>

  	  <script>
function myFunction() {
    window.print();
}
</script>
  <!----assets for pdf download--------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> 
	  <script type="text/javascript" src="{{ URL::asset('admin/assets/js/select.js')}}"></script> 
      
		<script src="{{ URL::asset('admin/assets/js/enquire.min.js')}}"></script> 									<!-- Enquire for Responsiveness -->
		<script src="{{ URL::asset('admin/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js')}}"></script> <!-- nano scroller --> 
		<script src="{{ URL::asset('admin/assets/js/application.js')}}"></script> 
	  
</html>



