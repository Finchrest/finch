<div class="modal-header">
   <h4 class="modal-title">Add User</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>
<div class="modal-body">
   <div class="container">
      <div class="fbFinchInfoDetails">
         <div class="FinchMegaInfo w-100">
            <div class="FbFinchBrefCafe w-100 border-0">
               <div class="CansumerForm w-100">
                  <form action="{{ $route->address_store }}" onsubmit="form_submit(this);return false;" method="POST">
                     <div>
                        <div class="newAddress">

                           @csrf

                           <div class="form-group ">
                              <label>Pincode<sup class="text-danger">*</sup></label>
                              <input type="text" class="form-control pincode" name="pincode" placeholder="Pin Code">
                           </div>
                           <input type="hidden" value="{{ $user_id }}" name="user_id" class="user_id">
                           <div class="form-group mb-4">
                              <label>Address Title</label>
                              <input type="text" class="form-control" name="address_type" placeholder="Address Type" value="">
                           </div>
                           <div class="form-group mb-4">
                              <label>Phone Number</label>
                              <input type="text" class="form-control phone" name="phone" placeholder="Mobile Number">
                           </div>

                           <div class="form-group mb-4">
                              <label>Address</label>
                              <input type="text" class="form-control address" name="address" value="" placeholder="Address">
                           </div>
                           <div class="form-group mb-4">
                              <label>City</label>
                              <input type="text" class="form-control city" name="city" value="" placeholder="City">
                           </div>
                           <div class="form-group mb-4">
                              <label>State</label>
                              <input type="text" class="form-control state" name="state" value="" placeholder="State">
                           </div>
                        </div>
                        <div class="clGetYoursNow w-100" style="padding: 0px !important;">
                           <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Submit</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>
<script>
   function form_submit(e) {
      $(e).find('.st_loader').show();
      $.ajax({
         url: $(e).attr('action'),
         method: "POST",
         dataType: "json",
         data: $(e).serialize(),
         success: function(data) {
            if (data.success == 1) {
               toastr.success(data.message, 'Success');
               $(e).find('.st_loader').hide();
               $(e)[0].reset();
               $('#modal-default').modal('hide');
               $('#modal-default .modal-content').html('');
               location.reload();

            } else if (data.success == 0) {
               toastr.error(data.message, 'Error');
               $(e).find('.st_loader').hide();
            }
         },
         error: function(data) {
            if (typeof data.responseJSON.status !== 'undefined') {
               toastr.error(data.responseJSON.error, 'Error');
            } else {
               $.each(data.responseJSON.errors, function(key, value) {
                  toastr.error(value, 'Error');
               });
            }
            $(e).find('.st_loader').hide();
         }
      });
   }
</script>