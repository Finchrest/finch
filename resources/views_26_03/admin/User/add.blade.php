<form  action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST" >
<input type="hidden" name="id" value="">
    <div class="modal-header">
               <h4 class="modal-title">Add {{ $module }}</h4>
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
                        <input type="text" name="name" class="form-control" placeholder="Enter User name" value="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Phone<sup class="text-danger">*</sup></label>
                        <input type="text" name="phone" class="form-control allowno" placeholder="Enter Phone" value="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Email<sup class="text-danger">*</sup></label>
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" value="">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Password<sup class="text-danger">*</sup></label>
                        <input type="text" name="password" class="form-control" placeholder="Enter Password" value="">
                     </div>
                  </div>
                 
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Is New<sup class="text-danger">*</sup></label>
                        <select name="is_new" class="form-control">
                           <option value="0">New</option>
                           <option value="1">Old</option>
						</select>
                     </div>
                  </div>
				  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Status<sup class="text-danger">*</sup></label>
                        <select name="status" class="form-control">
                           <option value="1" selected>Active</option>
                           <option value="0">Inactive</option>
						      </select>
                     </div>
                  </div>
               </div>
			   
          
            
		 </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
               <button type="submit" class="btn btn-success">Save <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
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

