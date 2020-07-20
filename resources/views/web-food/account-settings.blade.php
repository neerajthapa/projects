@extends('web-food.layout.web')
@section('title', 'Account Settings' )  
 
@section('content')


@section('header')
@include('web-food.includes.header')
@show
  
  
        <!---------------------------------------BANNER SECTION STARTS HERE-------------------------------------------->
            <section id="banner" style="background: url('{{URL::asset('web-food/assets/images/food-back-small.jpg')}}')no-repeat center;">
               <div class="container"> 
                  <div class="row" >
                      <div class="col-sm-12"  ng-controller="profileController" >
                           <md-list layout-padding class="profile-data" >
							<md-list-item class="md-3-line"   ng-repeat="users in profileData.data"  >
								<img  ng-src="{{URL::asset('images/users')}}/@{{users.photo}}" class="md-avatar" >
								<div class="md-list-item-text">
								  <h2 >@{{users.first_name}} @{{users.last_name}}</h2>
								  <h4>
									@{{users.email}}
								  </h4>
								</div>
							</md-list-item>
						  </md-list>    
                      </div>
                 </div>
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
       
	   <input type="file" id="file" style="display: none "/> 
        <!---------------------------------------WORKS SECTION STARTS HERE-------------------------------------------->
            <section id="orders" >
               <div class="container">
                  <div class="row"> 
                     <div class="col-sm-4 text-center">   
                         <div class="panel left">
						 <div class="panel-body">
						   <table  class="table">
						    <tr>
							  <td> <i class="fa fa-"></i></td>
							  <td > <a href="{{URL::to('my-orders')}}">My Orders</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-map-marker-alt"></i></td>
							  <td> <a href="{{URL::to('addresses')}}">Manage Addresses</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-"></i></td>
							  <td><a href="{{URL::to('reviews')}}"> My Reviews</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-star"></i></td>
							  <td><a href="{{URL::to('favourites')}}"> Favourites</a></td>
							</tr>
							<tr class="active">
							  <td> <i class="fa fa-wrench"></i></td>
							  <td><a href="{{URL::to('account')}}"> Account Settings</a></td>
							</tr>
							<tr>
							  <td> <i class="fa fa-sign-out-alt"></i></td>
							  <td>Signout</td>
							</tr>
						   </table>
						 </div>
						 </div>
                     </div> 
					 
					 
					 <div id="account" class="col-sm-8 text-center" ng-controller="accountController" ng-cloak>   
                         <div class="panel">
						 <div class="panel-body">
						         <div class="row"  ng-repeat="users in editUser">
                                                   <div class="col-md-5 col-sm-8">
												   <div ng-repeat="data in users.fields"  ng-show="data.type == 'file'">
												   
												    <div class="img-upload" style="width:250px;min-height:200px;"  >
                                                       <div class="form-group" >
													   
													  
												   
												   
                                                      <input type=" " ng-model="data.value" value="@{{data.value}}" id="item_photo" style="display:  none;"/>
                                                     
													    <div style="text-align: center;position: relative" id="image">
													   <img  style="padding:0;border:1px solid #f5f5f5"  class="img-responsive center-block" id="preview_image1"  ng-hide="data.value" src="{{URL::asset('/admin/assets/images/img-placeholder.png')}}"/>
														   <img    class="img-responsive center-block" id="preview_image" ng-hide="!data.value"  src="{{URL::asset('images/users')}}/@{{data.value}}" style="padding:0px ;background:#f5f5f5;border:1px solid #f5f5f5;width:100%"/>
													  <i id="loading1" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;left: 40%;top: 40%;display: none"></i>
												   </div>
                                                      
                                                      </p>
                                                   </div>
                                                         </div> 
														 
														  <div class="text-right" style="font-size: ;width:250px;" >
													  <a href="javascript:changeProfile()" title="edit" style="text-decoration: none;background:#e2e2e2;padding:8px; position: absolute;  bottom: 50px;  margin-left: -28px;">
													  <i class="fa fa-edit"></i> 
													  </a>&nbsp;&nbsp;
													  <!-- <a href="javascript:removeFile()" title="delete" style="color: red;text-decoration: none;background:#e2e2e2;padding:8px; position:absolute;bottom: 50px;right:20px ">
													  <i class="fa fa-trash-o"></i>
													  </a>  -->
												   </div>
												   </div>
														 </div>
														  <div class="col-md-7 col-sm-12">
														    <div class="form-group" ng-repeat="data in users.fields" ng-show="data.type == 'hidden'">
                                                      <label for="@{{data.identifier}}"> </label>
                                                      <input type="@{{data.type}}" ng-model="data.value" class="form-control"   id="@{{data.identifier}}"  placeholder="Enter @{{data.title}}" >
                                                   </div>
												   
												   <md-input-container  class="md-block text-left" ng-repeat="data in users.fields" ng-show="data.type == 'text' || data.type == 'string'" >
                                                         <label>@{{data.title}}</label>
                                                         <input type="@{{data.type}}" id="@{{data.identifier}}" name="@{{data.identifier}}"  ng-model="data.value" value="" />
                                                      </md-input-container>
													  
													  
													   <md-input-container  class="md-block text-left" ng-repeat="data in users.fields" ng-show="data.type == 'email' "  >
                                                         <label>@{{data.title}}</label>
                                                         <input type="@{{data.type}}" id="@{{data.identifier}}" name="@{{data.identifier}}"  ng-model="data.value" value="" />
                                                      </md-input-container>
													  
													  
													  <md-input-container  class="md-block text-left" ng-repeat="data in users.fields" ng-show="data.type == 'password' "  >
                                                         <label>@{{data.title}}</label>
                                                         <input type="@{{data.type}}" id="@{{data.identifier}}" name="@{{data.identifier}}"  ng-model="data.value" value="" />
                                                      </md-input-container>
                                                      
												     
													 
                                                      <div class="form-group" ng-repeat="data in users.fields" ng-show="data.type == 'tag'">
                                                         <label for="@{{data.identifier}}">@{{data.title}}</label> 
                                                         <tags-input ng-model="data.value" add-from-autocomplete-only="true" allow-leftover-text="false" display-property="label" key-property="id" text="text" ng-blur="text=''">
                                                            <auto-complete min-length="1" highlight-matched-text="true" source="searchData($query,data)"></auto-complete>
                                                         </tags-input>
                                                      </div>
                                                      <div class="form-group" ng-repeat="data in users.fields" ng-show="data.symbol">
                                                         <label for="@{{data.identifier}}">@@{{data.title}}</label>
                                                         <div class="input-group">
                                                            <span class="input-group-addon">@@{{data.symbol}}</span>
                                                            <input type="@{{data.type}}" class="form-control"   ng-model="data.value" id="@{{data.identifier}}" placeholder="Enter @{{data.title}}" >
                                                         </div>
                                                      </div>
                                                      <!----- For Checkbox Type Input Field----------->
                                                      <div class="form-group" ng-repeat="data in users.fields" ng-show="data.type == 'checkbox'">
                                                         <label for="@{{data.identifier}}">@{{data.title}} </label> <br>
                                                         <div class="checkbox" ng-repeat="options in data.field_options">
                                                            <label><input type="@{{data.type}}"  ng-model="data.value[options.value]" id="@{{options.value}}"  >@{{options.title}}</label>
                                                         </div>
                                                         <label class="checkbox-inline" ng-repeat="options in data.field_options">
                                                         <input type="@{{data.type}}" ng-model="data.value" value="@{{options.value}}" >@{{options.title}}
                                                         </label>
                                                      </div>
                                                      <!----- For Select Box Type Input Field----------->
                                                      <div class="form-group" ng-repeat="data in users.fields" ng-show="data.type == 'Selectbox'">
                                                         <label for="@@{{data.identifier}}">@@{{data.title}}</label> <br> 
                                                         <select ng-model="data.value" class="form-control"  ng-required="data.required_or_not">
                                                            <option value="" selected>Select User Type</option>
                                                            <option  ng-repeat="options in data.field_options" value="@{{options.value}} ">@{{options.title}}</option>
                                                         </select>
                                                      </div>
                                                      <div class="form-group" ng-repeat="data in users.fields" ng-show="data.message">
                                                         <label for="@{{data.identifier}}">@{{data.title}}</label>
                                                         <input type="@{{data.type}}" ng-model="data.value" class="form-control"   id="@{{data.identifier}}"  placeholder="Enter @{{data.title}}"  >
                                                      </div>
                                                      <div class="form-group" ng-repeat="data in users.fields" ng-show="data.type == 'datePicker'" placeholder="Enter @{{data.title}}">
                                                         <label for="@{{data.identifier}}">@{{data.title}}</label>
                                                         <datepicker
                                                            date-format="yyyy-MM-dd"  
                                                            button-prev='<i class="fa fa-arrow-circle-left"></i>'
                                                            button-next='<i class="fa fa-arrow-circle-right"></i>'>
                                                            <input ng-model="data.value" type="text" class="form-control font-fontawesome font-light radius3" placeholder="Enter @{{data.title}}" />
                                                         </datepicker>
                                                      </div>
                                                      <div class="form-group" ng-repeat="data in users.fields" ng-show="data.type == 'timePicker'">
                                                         <label for="@{{data.identifier}}">@{{data.title}}</label>
                                                         <div class="input-group clockpicker" 
                                                            clock-picker 
                                                            data-autoclose="true"   > 
                                                            <input ng-model="ctrl.time" data-format="hh:mm:ss" type="text" class="form-control" placeholder="Enter @{{data.title}}">
                                                            <span class="input-group-addon">
                                                            <span class="fa fa-clock-o"></span>
                                                            </span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                            
											 <div class="row">
                                          <div class="col-lg-12 col-sm-12  text-right">
                                             <md-button   ng-click="updateUser()" class="btn md-raised bg-color md-submit md-button md-ink-ripple">Update</md-button>
                                          </div>
										   </div>
						 </div>
						 </div>
                     </div> 
                  </div> 
               </div>
            </section>
		<!---------------------------------------WORKS SECTION ENDS HERE-------------------------------------------->
		
		 
		  				  
      
@section('footer')
@include('web-food.includes.footer')
@show
<!------>

<script type="text/javascript" src="{{ URL::asset('web-food/angular-controllers/account.js')}}"></script> 
<script src="https://use.fontawesome.com/2c7a93b259.js"></script>
<script>
   function changeProfile() {
       $('#file').click();
   }
   $('#file').change(function () {
       if ($(this).val() != '') {
           upload(this);
   
       }
   });
    function upload(img) {
        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        form_data.append('_token', '{{csrf_token()}}');
        $('#loading1').css('display', 'block');
        $.ajax({
            url: "{{url('image-upload-users')}}",
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.fail) {
                    $('#preview_image').attr('src', '{{asset('images/users/noimage.jpg')}}');
                    alert(data.errors['file']);
                }
                else {
                    var data = data.filename; 
                 $('#item_photo').val(data).trigger("change");
   
   //$("#photo").dispatchEvent(new Event("input", { bubbles: true }));
    
   
               
               //document.getElementById('photo').value=data;
                    $('#preview_image').attr('src', '{{asset('images/users')}}/' + data);
					$('#preview_image1').attr('src', '{{asset('images/users')}}/' + data);
                }
                $('#loading1').css('display', 'none');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
                $('#preview_image').attr('src', '{{asset('images/users/noimage.jpg')}}');
            }
        });
    }
   
   
   
   
   function removeFile() {
       if ($('#item_photo').val() != '')
		   alert("{{url('ajax-remove-image-users')}}/" + $('#item_photo').val());
           if (confirm('Are you sure want to remove profile picture?')) {
               $('#loading1').css('display', 'block');
               var form_data = new FormData();
               form_data.append('_method', 'DELETE');
               form_data.append('_token', '{{csrf_token()}}');
               $.ajax({
                   url: "{{url('ajax-remove-image-users')}}/" + $('#item_photo').val(),
                   data: '',
                   type: 'DELETE',
                   contentType: false,
                   processData: false,
                   success: function (data) {
					   alert('s');
                       $('#preview_image').attr('src', '{{asset('assets/images/placeholder.jpg')}}');
                       $('#item_photo').val('');
                       $('#loading1').css('display', 'none');
                   },
                   error: function (xhr, status, error) {
                       alert(xhr.responseText);
                   }
               });
           }
   }
   
   
   
   
</script>
@endsection