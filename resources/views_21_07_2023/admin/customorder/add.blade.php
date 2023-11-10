<form  action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST" >
<input type="hidden" name="id" value="">
    <div class="modal-header">
               <h4 class="modal-title">Add {{ ucwords($module) }}</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
       <div class="modal-body py-3">
       
            @csrf
			
			<div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>User<sup class="text-danger">*</sup></label>
                       <select class="form-control select_2 user" name="user_id" onchange="selectUser(this); return false;">
                          <option value="" >Select</option>
                          <?php foreach($users as $user) { ?>
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                          <?php } ?>
                       </select>
                     </div>
                   </div>
                  <div class="col-md-12">
                   <div class="row">
                       <div class="col-md-4" style="display: none;"> 
                         <div class="form-group">
                            <input type="hidden" class="form-control" id="name" name="name" placeholder="Enter Used Amount" value="">
                         </div>
                       </div>
                       <div class="col-md-4"> 
                         <div class="form-group">
                            <label >Phone<sup class="text-danger">*</sup></label>
                            <input type="number" id="phone" class="form-control " name="phone"  placeholder="Phone" value="" >
                         </div>
                       </div>
                        <div class="col-md-4"> 
                         <div class="form-group">
                            <label class="d-block">Address<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address Here" value="">
                         </div>
                       </div>
                       <div class="col-md-4"> 
                         <div class="form-group">
                            <label class="d-block">City<sup class="text-danger">*</sup></label>
                            <input type="text" id="city" class="form-control " name="city"  placeholder="Enter City" value="">
                         </div>
                       </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="form-group">
                        <label class="d-block">Select Passport<sup class="text-danger">*</sup></label>
                         <select class="form-control  select_2 passport" name="passport_code" onchange="selectPassport(this); return false;" >
                            <option value="" >Select</option>
                            
                         </select>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label class="d-block">Volume<sup class="text-danger">*</sup></label>
                            <input type="text" id="volume" class="form-control " name="volume"  placeholder="Volume" value="" readonly>
                         </div>
                       </div>
                        <div class="col-md-4"> 
                         <div class="form-group">
                            <label class="d-block">Used<sup class="text-danger">*</sup></label>
                            <input type="number" class="form-control" id="used" name="used" placeholder="Enter Used Amount" value="" oninput="setAmount(this,'remaining','remainingHidden'); return false;">
                         </div>
                       </div>
                          <div class="col-md-4"> 
                         <div class="form-group">
                            <label class="d-block">Remaining<sup class="text-danger">*</sup></label>
                            <input type="text" id="remaining" class="form-control " name="remaining"  placeholder="Enter Remaining Amount" value="" readonly>
                            <input type="hidden" id="remainingHidden" value="">
                         </div>
                       </div>
                       <div class="col-md-6"> 
                         <div class="form-group">
                            <label class="d-block">Date<sup class="text-danger">*</sup></label>
                            <input   class="form-control datepicker py-2" id="date" name="date"  placeholder="yyyy-mm-dd" >
                         </div>
                       </div>
                       
                     </div>
                     <div class="form-group">
                        <label>Remarks <sup class="text-danger">*</sup></label>
                            <textarea  name="remarks" class="form-control"></textarea> 
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

 // $('.datepicker').datepicker();

   $(function () {
      $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: true,
        autoclose: true,
        todayHighlight: true,
        startDate: "today",
        minViewMode: 0,
      });
    });

    $(".user").select2({
    placeholder: "Select User",
  });

    $(".passport").select2({
    placeholder: "Select Passport",
  });

  $('#volume').on('change', function() {
      var volume = this.value;
  });

  // $('#used').on('input', function() {
  //       alert(this.value);
  // });

  $('#used').on('input', function() {

      var volume = $('#volume').val();
      var used = this.value;

      var remaining  = volume - used;

      // alert(remaining);

      $('#remain').val(remaining);
  });


  function selectPassport(e)
  {
    var id = $(e).val();
    $.ajax({  
      url :'{{route('admin.customorders.getPassportVolume')}}',  
      method:"get",  
      dataType:"json",  
      data:{passport_id:id},
       success: function(data){ 
             // alert(data);
              if(data.success==1){
                $('#volume').val(data.vol);
                $('#used').val(data.used);
                $('#remaining').val(data.remaining);
                $('#remainingHidden').val(data.remaining);
                $('#date').val(data.order_date);
                $('#name').val(data.name);
              }else if(data.success==0){
                toastr.error(data.message,'Error');
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


  function selectUser(e)
  {
    var id = $(e).val();
    $.ajax({  
      url :'{{route('admin.customorders.getUserdetail')}}',  
      method:"get",  
      dataType:"json",  
      data:{id:id},
      success: function(data){ 
              if(data.status==1){
                $('#name').val(data.name);
                $('#phone').val(data.phone);
                $('.passport').html('');
                $('.passport').html(data.opt);
              }else if(data.status==0){
                toastr.error(data.msg,'Error');
                $('.passport').html('<option value="" >Select</option>');
                $('.select_product').html('');
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

	function setAmount(e,id,id2){
		console.log($(e).val());
		console.log($('#'+id2).val());
		var val = $('#'+id2).val() - $(e).val();
		
		$('#'+id).val(val);
		// if(val < 0){
			// $('#'+id).val(0);
		// }else{
			// $('#'+id).val(val);
		// }
	}
	
</script> 

