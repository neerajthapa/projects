<!DOCTYPE html>
<html>
          <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>{{env('APP_NAME')}} </title>

   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.8/angular.js"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700" />
	 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"  >
	 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('web-food/assets/css/style.css')}}">	
	<link rel="stylesheet" href="https://npmcdn.com/angular-toastr/dist/angular-toastr.css" />
<style>
 toastr.options = {
  toastClass: 'alert',
  iconClasses: {
      error: 'alert-error',
      wait: 'alert-info',
      success: 'alert-success',
      warning: 'alert-warning'
  }
} 
</style>
	<!-- Angular Material Library -->
  <link rel="stylesheet" href="{{ URL::asset('web-food/assets/css/angular-material.min.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>
	
	   
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <script src="https://npmcdn.com/angular-toastr/dist/angular-toastr.tpls.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script>

  	<script> var APP_URL = '<?php echo env("APP_URL", "");?>';  </script>
	<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/mainController.js')}}"></script> 
	
  
   </head>
    <body ng-app="mainApp" >         
        @yield('content')        
       
    </body>

</html>