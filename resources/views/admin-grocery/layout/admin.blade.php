<!DOCTYPE html>
<html>
   @include('admin-grocery.includes.head')
   <body>
      @include('admin-grocery.includes.header')
      <div id="wrapper" >
         <div id="layout-static">
            @include('admin-grocery.includes.sidebar')  
            <div class="static-content-wrapper"  >	 
              
			  <div ng-app="mainApp"  > 			
                  @yield('content')  
              </div>				  
            </div>
         </div>
      </div>
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
   <script type="text/javascript" src="{{ URL::asset('admin/assets/js/select.js')}}"></script> 
   <script src="{{ URL::asset('admin/assets/js/enquire.min.js')}}"></script> 									<!-- Enquire for Responsiveness -->
   <script src="{{ URL::asset('admin/assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js')}}"></script> <!-- nano scroller --> 
   <script src="{{ URL::asset('admin/assets/js/application.js')}}"></script> 
</html>