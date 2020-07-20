@extends('layout.front')
@section('content')
 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h3>Registration as a guest user</h3>
        
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
            <!-- left column -->
            <div class="col-md-12">

              <!-- general form elements -->
              <div class="box box-primary">

                
              {{ Form::open(array('url' => 'guest-student','class'=>'form-horizontal')) }}
                
                  <div class="box-body">
                    <div class="form-group">
                      <label for="first_name" class="col-md-3 control-label">First Name</label>
                       <div class="col-md-6">  
                      <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name">
                      <div class="error-message">{{ $errors->first('first_name') }}</div>
                    </div></div>

                    <div class="form-group">
                      <label for="last_name" class="col-md-3 control-label">Last Name</label>
                      <div class="col-md-6">  
                      <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name">
                      <div class="error-message">{{ $errors->first('last_name') }}</div>
                    </div>
                    </div>


                    <div class="form-group">
                      <label for="email" class="col-md-3 control-label">Email</label>
                      <div class="col-md-6">  
                      <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
                      <div class="error-message">{{ $errors->first('email') }}</div>
                    </div>
                  </div>

                    <div class="form-group">
                      <label for="country_id" class="col-md-3 control-label">Select Country</label>
                      <div class="col-md-6">  
                      <select name="country_id" id="country_id" class="form-control" class="col-md-3 control-label">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $key => $value) {
                        ?>
                        <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                        <?php
                        }?>
                      </select>
                      <div class="error-message">{{ $errors->first('country_id') }}</div>
                    </div>
                  </div>

                     <div class="form-group">
                      <label for="password" class="col-md-3 control-label">Password</label>
                      <div class="col-md-6">  
                      <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                      <div class="error-message">{{ $errors->first('password') }}</div>
                    </div>
                  </div>

                    <div class="form-group">
                      <label for="password_confirmation" class="col-md-3 control-label">Confirm Password</label>
                      <div class="col-md-6">  
                      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter Confirm Password">
                      					<span id="result"></span>

                      <div class="error-message">{{ $errors->first('password_confirmation') }}</div>
                    </div>
                    </div>
                  </div><!-- /.box-body -->

                   <div class="box-footer">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  </div>
                {{ Form::close() }}
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
      <hr>

      <footer>
        <p>&copy; 2016 Endive Software</p>
      </footer>
    </div> <!-- /container -->
@stop