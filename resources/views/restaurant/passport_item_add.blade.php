<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<form  action="" onsubmit="form_submit(this);return false;" method="POST" >
<input type="hidden" name="id" value="">
    <div class="modal-header">
               <h4 class="modal-title">Add Passport Item</h4>
               <button type="button" class="close" onclick="close_modal()">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
       <div class="modal-body py-3">
       
            @csrf
         
          <div class="row">
               <input type="hidden" name="passport_id" value="{{ $passport_data->passport_id }}">
               <input type="hidden" name="user_id" value="{{ $passport_data->user_id }}">
               <input type="hidden" name="passport_code" value="{{ $passportCode }}">
               <div class="col-12">
                  <div class="form-group ">
                     <label>Products<sup class="text-danger">*</sup></label>
                     <select name="products" class="form-control select2">
                     <option value="">--Select Product--</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label>Quantitly<sup class="text-danger">*</sup></label>
                     <input type="number" class="form-control " name="quantitiy" placeholder="Enter Product Quantity" value="">
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
    $('.select2').select2();
});



 function form_submit(e)
   {
   $(e).find('.st_loader').show();
   $.ajax({  
     url :"{{route ('restaurant.order.save') }}",  
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
          
              $('.productDetail').html('');
              $('.productDetail').append(data.view);
            
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
   
   function setPrice(e,price_id,tax_id){
      var priceVal = $('#'+price_id).val();
      var taxVal = $('#'+tax_id).val();
      var total = priceVal;
      
      if(taxVal != ''){
         var total = parseInt(priceVal) + parseInt((parseInt(priceVal) * parseInt(taxVal)/100));         
      }
      $('#totalPrice').val(total);
   }  
   
   function setSubCategory(e){
      var categoryId = $(e).val();
      $.ajax({  
         url :"{{route ('product.setSubCategory') }}",  
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         method:"POST",  
         dataType:"json",  
         data:{category_id:categoryId},
            success: function(data){ 
               if(data.status==1){
                  $('.select_sub_category').html('');
                  $('.select_sub_category').html(data.opt);
               }else if(data.status==0){
                  toastr.error(data.msg,'Error');
                  $('.select_sub_category').html('<option value="" >Select</option>');
                  $('.select_sub_category').html('');
                  $('.new_row').html('');
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
               } 
      }); 
   }


   
</script> 

