
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<form  action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST" >
<input type="hidden" name="passport_id" value="{{ $passport_id }}">
    <div class="modal-header">
               <h4 class="modal-title">Add {{ $module }}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
       <div class="modal-body py-3">
       
            @csrf
			
			   <div class="row">
                  <div class="col-12">
                     <div class="form-group ">
                        <label>Products<sup class="text-danger">*</sup></label>
                        <select name="products[]" class="form-control select2" multiple>
                           @foreach($products as $product)
                           <option value="{{ $product->id }}">{{ $product->title }}</option>
                           @endforeach
						      </select>
                     </div>
                  </div>
                  <div class="col-12">
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
    $('.select2').select2();
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

