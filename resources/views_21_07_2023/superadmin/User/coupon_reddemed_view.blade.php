<div class="modal-header">
  <h6 class="text-dark"> Coupon Redeemed </b></h6>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<section class="insidepage-content-1 myOrderPage">
<div class="YOurHistory myOrderTables">
<form  action="{{ route('admin.coupon.store') }}" onsubmit="form_submit(this);return false;" method="POST" >
<div class="table-responsive" id="">
  <input type="hidden" name="id" value="{{ $id }}">
  <input type="hidden" name="uid" value="{{ $uid }}">
  <table class="table table-border TableThree table-borderless checkout-table" style="min-width: 100% !important;">
        @foreach($allcoupans as $order)
          <tr>
            <td><input type="checkbox" name="coupon_redem[]" @if(in_array( $order['id'],$coupon_arr)) readonly  @endif @if(in_array( $order['id'],$coupon_arr)) checked @endif value="{{ $order['id'] }}">  {{ $order['title'] }}</td>
          </tr>
        @endforeach
    </table>
  </div>
  <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
               <button type="submit" class="btn btn-success">Save <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
  </form>
</div>
</div>

<style>
  .OrderShowModal .modal-content {
    width: 500px;
    margin: 0 auto;
  }
  input[type="checkbox"][readonly] {
  pointer-events: none;
}
</style>
<script>
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
				  $('#productModal').modal('hide');
				  $('#productModal .modal-content').html('');
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