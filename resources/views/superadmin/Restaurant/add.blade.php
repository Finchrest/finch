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
      <div class="col-md-6">
        <div class="form-group ">
          <label>Title<sup class="text-danger">*</sup></label>
          <input type="text" name="name" class="form-control" placeholder="Enter Title  Name" >
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label>Email<sup class="text-danger">*</sup></label>
          <input type="text" name="email" class="form-control" placeholder="Enter Email" >
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label>Password<sup class="text-danger">*</sup></label>
          <input type="text" name="password" class="form-control" placeholder="Enter Password" >
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label>Slogan 1</label>
          <input type="text" name="slogan_1" class="form-control" placeholder="Slogan 1">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label>Slogan 2</label>
          <input type="text" name="slogan_2" class="form-control" placeholder="Slogan 2">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label>Status<sup class="text-danger">*</sup></label>
          <select name="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="address" class="form-control" value="" placeholder="Enter Your Address">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Contact Number 1</label>
          <input type="text" name="phone_1" class="form-control" value="" placeholder="Contact Number 1">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Contact Number 2</label>
          <input type="text" name="phone_2" class="form-control" value="" placeholder="Contact Number 2">
        </div>
      </div>
      <div class="col-md-12 paid">
        <div class="form-group select2_base">
          <label class="d-block">Select Location<sup class="text-danger">*</sup></label>
          <select class="form-control select_location " name="location">
            <option value="" >Select</option>
            <?php foreach($locations as $location) { ?>
            <option value="{{ $location->id }}">{{ $location->name }}</option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Short Description<sup class="text-danger">*</sup></label>
          <textarea class="form-control" name="sub_description" rows="3" placeholder="Enter Places Description" maxlength="200"></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Places Description<sup class="text-danger">*</sup></label>
          <textarea id="summernote" class="form-control" name="description" rows="3" placeholder="Enter Places Description"></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group mb-0">
          <label>Icon <small>(jpg, png, jpeg)</small><sup class="text-danger">*</sup></label>
          <div class="input-group ">
            <div class="col-md-6">
              <div class="custom-file">
                <input type="hidden" name="icon_path" value="upload/places/icons/">   
                <input type="hidden" name="icon_name" value="icon"> 
                <input type="file" class="custom-file" name="icon" onchange="upload_image($(form),'{{ $route->upload }}','icon','icon_id')" accept=".jpg,.jpeg,.png">
                <input type="hidden" name="icon_id" id="icon_id" value="">
                <i class="icon_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
              </div>
            </div>
            <div class="col-md-6">
              <img src="" id="icon_prev" class="img-thumbnail " alt="" width="100" height="100" style="display:none"> 
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group mb-0">
          <label>Image <small>(jpg, png, jpeg)</small><sup class="text-danger">*</sup></label>
          <div class="input-group ">
            <div class="col-md-6">
              <div class="custom-file">
                <input type="hidden" name="image_path" value="upload/places/">   
                <input type="hidden" name="image_name" value="image"> 
                <input type="file" class="custom-file" name="image" onchange="upload_image($(form),'{{ $route->upload }}','image','file_id')" accept=".jpg,.jpeg,.png">
                <input type="hidden" name="file_id" id="file_id" value="">
                <i class="image_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
              </div>
            </div>
            <div class="col-md-6">
              <img src="" id="image_prev" class="img-thumbnail " alt="" width="100" height="100" style="display:none"> 
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group mb-0">
          <label>Images <small>(jpg, png, jpeg)</small><sup class="text-danger">*</sup></label>
          <div class="input-group ">
            <div class="col-md-6">
              <div class="custom-file">
                <input type="hidden" name="images_path" value="upload/places/multiple/">   
                <input type="hidden" name="images_name" value="images"> 
                <input type="file" class="custom-file" name="images[]" onchange="upload_multiple_image($(form),'{{ $route->multiple_upload }}','images','file_ids')" accept=".jpg,.jpeg,.png" multiple> 
                <input type="hidden" name="file_ids" id="file_ids" value="">
                <i class="images_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
              </div>
            </div>
            <div class="col-md-6">
              <div class="images_view"></div>
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
    $(".select_location").select2({
   placeholder: "Select Location",
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