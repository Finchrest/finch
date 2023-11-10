@extends('admin.layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
			
            <div class="row">
                <div class="col-md-4">
				 <form id="profile_setting" role="form" action="" enctype="multipart/form-data" method="post" onsubmit="update_data(this);return false;">
                            @csrf
                    <div class="card card-primary">
                      
                            <div class="card-body">
								<div class="form-group">
                                    <label for="exampleInputFile">Profile Image <small>(jpg, png, jpeg)</small></label>
                                    <div class="input-group">
                                        <?php if($file){?>
                                            <img class="profile_image img-thumbnail " src="{{ $file }}" alt=""  width="70" height="70">
                                        <?php }else{ ?>
											<img  class="profile_image img-thumbnail " src="{{ asset('administrator/images/nouser0.jpg') }}"  alt="" width="70" height="70">
										<?php } ?>
                                    </div>
                                    <div class="input-group mt-2">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="dp" id="exampleInputFile" onchange="upload_photo()">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                           <input type="hidden" name="file_id" id="file_id" value="{{ $admin->dp }}">
                                        </div>
                                    </div>                                    
                                </div>
								
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control"
                                           placeholder="Enter email" value="{{ $admin->email }}" readonly>
                                </div>
								
								
                               
                               
                                <div class="form-group">
                                    <label for="exampleInputName1">Name<sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="exampleInputName1"
                                           name="name" value="{{ $admin->name?? old('name') }}" placeholder="Name">
                                   
                                </div>
                               
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                            </div>
                        
                    </div>
					</form>
                </div>
				<div class="col-md-4">
				 <form id="password_setting" role="form" action="" enctype="multipart/form-data" method="post" onsubmit="update_password_data(this);return false;">
                            @csrf
					<div class="card card-primary">
                      
                            <div class="card-body">
								
                                <div class="form-group">
                                    <label for="exampleInputName1">Old Password<sup class="text-danger">*</sup></label>
                                    <input type="password" class="form-control" name="old_password" value="" placeholder="Old Password">
                                   
                                </div>
                               <div class="form-group">
                                    <label for="exampleInputName1">New Password<sup class="text-danger">*</sup></label>
                                    <input type="password" class="form-control" name="new_password" value="" placeholder="New Password">
                                   
                                </div>
								<div class="form-group">
                                    <label for="exampleInputName1">Confirm Password<sup class="text-danger">*</sup></label>
                                    <input type="password" class="form-control" name="confirm_password" value="" placeholder="Confirm Password">
                                   
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Password<i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                            </div>
                        
                    </div>
					</form>
				</div>
				
            </div>
			
            <!-- /.row -->
            <!-- Main row -->
            
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('page-js-script')
<script>
  
 function upload_photo()
	{
		
		$.ajax({
		  type: "POST",
		  url :"{{ route('admin.settings.pupload') }}", 
		  headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
		  contentType: false,       
		  cache: false,             
		  processData:false,
		  dataType: "json",
		  data: new FormData ($("#profile_setting")[0]), 
		  success: function(res)
		  { 
			$(".custom-file-input").val('');
			if(res.status == 0){
			  toastr.error(res.msg,'Error');
			  $(".custom-file-input").val('');
			}else{
			  $('.profile_image').attr('src',res.file_path);
			  $('#file_id').val(res.file_id);  
			}
			
		  }
		});
	}
	
 function update_data(e)
	{ 
	$('#profile_setting .st_loader').show();
	$.ajax({  
	  url :"{{ route('admin.settings.profile_update') }}", 
		headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },  
	  method:"POST",  
	  dataType:"json",  
	  data:$("#profile_setting").serialize(),
	   success: function(data){ 
            if(data.success==1){
              toastr.success(data.message,'Success');
              $(e).find('.st_loader').hide();
             
				
            }else if(data.success==0){
              toastr.error(data.message,'Error');
              $(e).find('.st_loader').hide();
            }
          },
          error: function(data){ 
            if(typeof data.responseJSON.status !== 'undefined'){
              toastr.error(data.responseJSON.error,'Error');
            }else{
              $.each(data.responseJSON.errors, function( key, value ) {
                  toastr.error(value,'Error');
              });
            }
            $('#profile_setting .st_loader').hide();
          } 
	}); 
	}
	
	
	
	function update_password_data(e)
	{  
	$('#password_setting .st_loader').show();
	$.ajax({  
	  url :"{{ route('admin.settings.password_update') }}", 
		headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },  
	  method:"POST",  
	  dataType:"json",  
	  data:$("#password_setting").serialize(),
	   success: function(data){ 
            if(data.success==1){
              toastr.success(data.message,'Success');
              $(e).find('.st_loader').hide();
             $(e)[0].reset();
			}else if(data.success==2){
				toastr.error(data.message,'Error');
              $(e).find('.st_loader').hide();
            }else if(data.success==0){
              toastr.error(data.message,'Error');
              $(e).find('.st_loader').hide();
            }
          },
          error: function(data){ 
            if(typeof data.responseJSON.status !== 'undefined'){
              toastr.error(data.responseJSON.error,'Error');
            }else{
              $.each(data.responseJSON.errors, function( key, value ) {
                  toastr.error(value,'Error');
              });
            }
            $('#password_setting .st_loader').hide();
          } 
	}); 
	}
    </script>
@endsection
