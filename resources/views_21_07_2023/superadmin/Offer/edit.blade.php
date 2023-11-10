<form  action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST">
<input type="hidden" name="id" value="{{ $info->id }}">
    <div class="modal-header">
               <h4 class="modal-title">Update {{ $module }}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
       <div class="modal-body py-3">
       
            @csrf
			
			<div class="row">
                  <div class="col-md-12">
                     <div class="form-group ">
                        <label>Name<sup class="text-danger">*</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Malt name" value="{{ $info->name }}">
                     </div>
                  </div>
				  <div class="col-md-12 paid">
					  <div class="form-group select2_base">
						 <label class="d-block">Select Location<sup class="text-danger">*</sup></label>
						 <select class="form-control select_location select_2" name="location[]" multiple>
							<option value="" >Select</option>
							<?php foreach($locations as $location) { 
								$loc = explode(',',$info->locations);
							?>
								  <option <?php if(in_array($location->id,$loc)==$location->id){ echo 'selected'; } ?> value="{{ $location->id }}">{{ $location->name }}</option>
							<?php } ?>
						 </select>
					  </div>
				   </div>    

                   <div class="col-md-6">
                <div class="form-group mb-0">
                  <label>Offer Image <small>(jpg, png, jpeg)</small><sup class="text-danger">*</sup></label>
                        <div class="input-group ">
                           <div class="col-md-6">
                              <div class="custom-file">
                              <input type="hidden" name="image_path" value="upload/offers/">   
                              <input type="hidden" name="image_name" value="image"> 
                              <input type="file" class="custom-file" name="image" onchange="upload_image($(form),'{{ $route->upload }}','image','file_id')" accept=".jpg,.jpeg,.png">
                              <input type="hidden" name="file_id" id="file_id" value="{{ $info->file_id }}">
                              <i class="image_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
                           </div>
                           </div>
                           <div class="col-md-12">
                              <?php if($info->FileId){ ?>
                               <img src="{{  asset($info->FileId->file) }}" id="image_prev" class="img-thumbnail " alt="" width="100" height="100" >
                              <?php }else{ ?> 
                                 <img src="" id="image_prev" class="img-thumbnail " alt="" width="100" height="100" style="display:none">
                              <?php } ?>   
                           </div>
                        </div>
                        
                     </div>
                  </div>
                 
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Status<sup class="text-danger">*</sup></label>
                        <select name="status" class="form-control">
                           <option value="1" {{ $info->status == 1 ? "selected" : "" }} >Active</option>
                           <option value="0" {{ $info->status == 0 ? "selected" : "" }}>Inactive</option>
						      </select>
                     </div>
                  </div>
               </div>
			   
          
            
		 </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
               <button type="submit" class="btn btn-success">Update <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
            </div>
         
        </form>


<script>

	$(document).ready(function() {
	
	  $(".allowno").keypress(function (e) {
		 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		  event.preventDefault();
		}
	  }); 
	   $('.allowno').on('paste',function (e){
		if (e.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
		  e.preventDefault();
		}
	  });
	  
	  $(".select_2").select2();
	  
  });
  
 function form_submit(e)
	{
	$(e).find('.st_loader').show();
	$.ajax({  
	  url :$(e).attr('action'),  
	  method:"POST",  
	  dataType:"json",  
	  data:$(e).serialize(),
	   success: function(data){ 
            if(data.success==1){
              toastr.success(data.message,'Success');
              $(e).find('.st_loader').hide();
              $(e)[0].reset();
				  $('#modal-default').modal('hide');
				  $('#modal-default .modal-content').html('');
				  dataTable.draw(false);
				
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
            $(e).find('.st_loader').hide();
          } 
	}); 
	}
	
</script> 

