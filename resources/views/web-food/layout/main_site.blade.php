<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}} @yield('title')</title>   
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ URL::asset('backend/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('backend/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ URL::asset('backend/dist/css/skins/_all-skins.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
    
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL::asset('backend/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
 
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ URL::asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
 
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ URL::asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('backend/custom.css') }}">

     <!-- jQuery 2.1.4 -->
    <script src="{{ URL::asset('backend/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ URL::asset('backend/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ URL::asset('backend/bootstrap/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('backend/dist/js/app.min.js') }}"></script>
   
    <!-- DataTables -->
 
    <script src="{{ URL::asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script> 

    <!--chart js -->
 
    <script src="{{ URL::asset('backend/plugins/fastclick/fastclick.min.js') }}"></script>
    
 
</head>
<body>
@yield('content')    
</body>
</html>