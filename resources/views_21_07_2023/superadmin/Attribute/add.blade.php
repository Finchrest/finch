<form  action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST" >
<input type="hidden" name="id" value="">
    <div class="modal-header">
               <h4 class="modal-title">Add {{ $module }}</h4>
               <button type="button" class="close" onclick="close_modal()">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
       <div class="modal-body py-3">
       
            @csrf
			
			 <div class="row">
               
               <div class="col-md-12">
                  <div class="form-group">
                     <label>Name<sup class="text-danger">*</sup></label>
                     <input type="text" class="form-control " name="name" placeholder="Enter Attribute Name" value="">
                  </div>
               </div> 
               <div class="col-md-12">
                 <div class="form-group">
                     <label>Attribute Option</label>
                     <button id="addRow" type="button" class="btn btn-info float-right addRowBtn"><i class="la la-plus"></i> Add</button>
                </div>
                </div>
                <div class="col-md-12">
                 <div class="form-group">
                     <input type="text" name="attribute_option[]" class="form-control m-input mb-3" placeholder="Attribute Option" autocomplete="off">
                    <div id="newRow"></div>
                  </div>
                </div>
				
               <div class="col-md-12">
                     <div class="form-group ">
                        <label>Status</label>
                        <select name="status" class="form-control">
                        <option value="1" >Active</option>
                        <option value="0" >Inactive</option>
                        </select>
                     </div>
                  </div>
				  
            </div>

            
            
            
		 </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" onclick="close_modal()">Cancel</button>
               <button type="submit" class="btn btn-success">Save <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
            </div>
         
        </form>


<script>

 $(document).ready(function() {

    $("#addRow").click(function () {
        var html = '';
        html += '<div class="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="attribute_option[]" class="form-control m-input" placeholder="Attribute Option" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button type="button" class="removeRow btn btn-danger">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '.removeRow', function () {
        $(this).closest('.inputFormRow').remove();
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

