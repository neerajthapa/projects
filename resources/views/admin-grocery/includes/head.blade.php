<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>@yield('title')</title>
   <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700" />
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/style.css')}}">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css" />
   <link rel="stylesheet" href="http://mbenford.github.io/ngTagsInput/css/ng-tags-input.min.css" />
   <link href="{{ URL::asset('admin/assets/datepicker/angular-datepicker.css')}}" rel="stylesheet" type="text/css" />
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
      success: 'alert-success',
      warning: 'alert-warning'
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
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.8/angular.js"></script>
   <link href="{{ URL::asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> 
   
   <!-----script files here------------> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
   
   <!--  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>-->
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.min.js"></script>	
   <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/angular-ui/0.4.0/angular-ui.min.js"></script>
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
   <script src="https://npmcdn.com/angular-toastr/dist/angular-toastr.tpls.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-animate.min.js"></script> 
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-aria.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-messages.min.js"></script>
  
  <!-- Angular Material Library -->
   <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.8/angular-material.min.js"></script>
   <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCo0S5dcqwj11plZQyOn7Sx6VJPHQPVZko'></script>
   <script src="{{ URL::asset('admin/assets/map/locationpicker.jquery.min.js')}}"></script>
   <script src="{{ URL::asset('admin/assets/map/angularLocationpicker.jquery.js')}}"></script>
   <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
   <script src="http://code.highcharts.com/stock/highstock.js"></script>
   <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script> 
   <script src="{{ URL::asset('admin/assets/datepicker/angular-datepicker.js')}}"></script>
   <script src="http://mbenford.github.io/ngTagsInput/js/ng-tags-input.min.js"></script> 
   <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js"></script>
   
   
   <script type="text/javascript" src="{{ URL::asset('admin/angular-controllers-grocery/realtimeSearch.js')}}"></script> 
</head>