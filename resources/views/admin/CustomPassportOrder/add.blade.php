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
                       <select class="form-control user" name="user_id" onchange="selectUser(this); return false;">
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
                       <div class="col-md-6"> 
                         <div class="form-group">
                            <label >Phone<sup class="text-danger">*</sup></label>
                            <input type="number" id="phone" class="form-control " name="phone"  placeholder="Phone" value="" >
                         </div>
                       </div>
                      <div class="col-md-6"> 
                         <div class="form-group">
                            <label class="d-block">Email<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Amount" value="">
                         </div>
                       </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="form-group">
                          <label class="d-block">Passport <sup class="text-danger">*</sup></label>
                         <select class="form-control passport" name="passport" onchange="selectPassport(this); return false;">
                            <option value="" >Select</option>
                            <?php foreach($passports as $passport) { ?>
                                  <option value="{{ $passport->id }}">{{ $passport->name }}</option>
                            <?php } ?>
                         </select>
                        </div>
                      </div>
              
                    </div>
                    <div class="row">
                      <div class="col-md-12 d-none"> 
                      @foreach($allcoupans as $order)
                      <input type="checkbox" name="coupon_redem[]"  value="{{ $order['id'] }}"> 
                      <label> {{ $order['title'] }} </label>
                    @endforeach
                      </div>
              
                    </div>
                      <div class="row">
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label class="d-block">Price<sup class="text-danger">*</sup></label>
                            <input type="text" id="price" class="form-control " name="price"  placeholder="Volume" value="" readonly>
                         </div>
                       </div>
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label class="d-block">Volume<sup class="text-danger">*</sup></label>
                            <input type="text" id="volume" class="form-control " name="volume"  placeholder="Volume" value="" readonly>
                         </div>
                       </div>
                       <div class="col-md-4"> 
                         <div class="form-group">
                            <label class="d-block">Date<sup class="text-danger">*</sup></label>
                            <input   class="form-control datepicker py-2"  name="date"  placeholder="yyyy-mm-dd" >
                         </div>
                       </div>
                       
                     </div>
                     <div class="form-group d-none">
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
      url :'{{route('admin.custom_passport_orders.getPassportVolume1')}}',  
      method:"get",  
      dataType:"json",  
      data:{id:id},
       success: function(data){ 
             // alert(data);
              if(data.success==1){
                $('#volume').val(data.vol);
                $('#price').val(data.price);
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
      url :'{{route('admin.custom_passport_orders.getUserdetail1')}}',  
      method:"get",  
      dataType:"json",  
      data:{id:id},
       success: function(data){ 
             // alert(data);
              if(data.success==1){
                $('#name').val(data.name);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
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
	
</script> 

