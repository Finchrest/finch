<form  action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST" >
<input type="hidden" name="id" value="{{ $info->id }}">
    <div class="modal-header">
               <h4 class="modal-title">Edit {{ $module }}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
       <div class="modal-body py-3">
       
            @csrf
      
      <div class="row">
                  <div class="col-md-12">
                     <div class="form-group ">
                        <label>Title<sup class="text-danger">*</sup></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter {{ $module }}  Name"  value="{{ $info->name }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Passport Id<sup class="text-danger">*</sup></label>
                        <input type="text" name="passport_id" class="form-control" placeholder="Passport Id"  value="{{ $info->passport_id }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group ">
                        <label>Per Day Use<sup class="text-danger">*</sup></label>
                        <div class="input-group">
                              <input type="text" name="per_day_use" class="form-control allowno" placeholder="Enter Per Day Use" value="{{ $info->per_day_use }}">
                              <span class="input-group-addon " id="basic-addon3">₹</span>
                        </div>
                     </div>
                  </div>
          <div class="col-md-4">
                     <div class="form-group ">
                        <label>Sub Total<sup class="text-danger">*</sup></label>
                        <input type="text" id="sub_total" name="sub_total" class="form-control allowno" placeholder="Enter Subtotal" value="{{ $info->sub_total }}" oninput="setPrice(this,'sub_total','tax'); return false;" >
                     </div>
        </div> 
          <div class="col-md-4">
                     <div class="form-group ">
                        <label>Tax<sup class="text-danger">*</sup></label>
            <div class="input-group">
                <input type="text" id="tax" name="tax" class="form-control allowno" placeholder="Enter Price" value="{{ $info->tax }}" oninput="setPrice(this,'sub_total','tax'); return false;">
                <span class="input-group-addon " id="basic-addon3">%</span>
            </div>
          </div>
            
        </div>    
                    <div class="col-md-4">
                     <div class="form-group ">
                        <label>Total Price<sup class="text-danger">*</sup></label>
                        <input type="text" id="totalPrice" name="price" class="form-control allowno" placeholder="Enter Price" value="{{ $info->price }}">
                     </div>
                  </div> 
                    <div class="col-md-6">
                     <div class="form-group ">
                        <label>Value<sup class="text-danger">*</sup></label>
                        <input type="text" name="volume" class="form-control allowno" placeholder="Enter Value" value="{{ $info->volume }}">
                     </div>
                  </div>
                 <div class="col-md-6">
                     <div class="form-group ">
                        <label>Is New<sup class="text-danger">*</sup></label>
                        <select name="is_new" class="form-control">
                           <option value="0" {{ $info->is_old == 0 ? "selected" : "" }} >New</option>
                           <option value="1" {{ $info->is_old == 1 ? "selected" : "" }} >Old</option>
            </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                  <div class="form-group">
                     <label>Short Description<sup class="text-danger">*</sup></label>
                     <textarea class="form-control" name="sub_description" rows="3" placeholder="Enter {{ $module }} Description" maxlength="200">{{ $info->sub_description }}</textarea>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label>Places Description<sup class="text-danger">*</sup></label>
                     <textarea id="summernote" class="form-control" name="description" rows="3" placeholder="Enter {{ $module }} Description">{{ $info->description }}</textarea>
                  </div>
               </div>
               <div class="col-md-12 paid">
                  <div class="form-group select2_base">
                     <label class="d-block">Select Location<sup class="text-danger">*</sup></label>
                     <input type="hidden" id="locationId" value="{{$info->location}}">
                     <select class="form-control select_2 select_location " name="location" >
                        <option value="" >Select</option>
                        <?php foreach($locations as $location) { ?>
                              <option <?php if($info->location == $location->id){ echo 'selected'; } ?> value="{{ $location->id }}">{{ $location->name }}</option>
                        <?php } ?>
                     </select>
                  </div>
               </div> 
             
            </div> 
         
            <div class="row">
                 
                  <div class="col-md-12">
                     <div class="form-group ">
                        <label>Status<sup class="text-danger">*</sup></label>
                        <select name="status" class="form-control">
                     <option value="1" {{ $info->status == 1 ? "selected" : "" }} >Active</option>
                           <option value="0" {{ $info->status == 0 ? "selected" : "" }}>Inactive</option>
            </select>
                     </div>
                  </div>
          
               <div class="col-md-12">
                <div class="form-group mb-0">
                  <label>Image <small>(jpg, png, jpeg)</small><sup class="text-danger">*</sup></label>
                        <div class="input-group ">
                           <div class="col-md-6">
                              <div class="custom-file">
                              <input type="hidden" name="image_path" value="upload/passport/">   
                              <input type="hidden" name="image_name" value="image"> 
                              <input type="file" class="custom-file" name="image" onchange="upload_image($(form),'{{ $route->upload }}','image','file_id')" accept=".jpg,.jpeg,.png">
                              <input type="hidden" name="file_id" id="file_id" value="{{ $info->file_id }}">
                              <i class="image_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
                           </div>
                           </div>
                           <div class="col-md-6">
                              <?php if($info->FileId){ ?>
                               <img src="{{  asset($info->FileId->file) }}" id="image_prev" class="img-thumbnail " alt="" width="100" height="100" >
                              <?php }else{ ?> 
                                 <img src="" id="image_prev" class="img-thumbnail " alt="" width="100" height="100" style="display:none">
                              <?php } ?> 
                           </div>
                        </div>
                        
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
  $('.select_location').select2({
       placeholder:"Select Location"
     });


   $('#summernote').summernote({
    height: 200,                 // set editor height
  focus: true ,
   popover: {
          image: [],
          link: [],
          air: []
        },                 
  });
  
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
  
  function setPrice(e,price_id,tax_id){
    var priceVal = $('#'+price_id).val();
    var taxVal = $('#'+tax_id).val();
    var total = priceVal;
    
    if(taxVal != ''){
      var total = parseInt(priceVal) + parseInt((parseInt(priceVal) * parseInt(taxVal)/100));     
    }
    $('#totalPrice').val(total);
  }

</script> 

