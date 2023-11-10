@extends('admin.layouts.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
			 <form id="profile_setting" role="form" action="" enctype="multipart/form-data" method="post" onsubmit="update_data(this);return false;">
                            @csrf
            <div class="row">
                <div class="col-md-4">
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
                                <button type="submit" class="btn btn-primary">Update <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                            </div>
                        
                    </div>
                </div>
				
				
            </div>
			</form>
            <!-- /.row -->
            <!-- Main row -->
            
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('page-js-script')
<script>
  
 function update_data(e)
	{ 
	$('#profile_setting .st_loader').show();
	$.ajax({  
	  url :"{{ route('admin.settings.password_update') }}", 
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
            $('#profile_setting .st_loader').hide();
          } 
	}); 
	}
    </script>
@endsection
