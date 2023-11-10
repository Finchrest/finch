<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="modal-body p-md-5 p-4">
  <div class="FoodDetailsHere PassportDetailsHere CnsumerDetails">
    <div class="PassportDetails2 col-md-10 m-auto">
      <div class="CansumerForm w-100">
        <form onsubmit="topupSubmit(this); return false;">
          <div class="form-group mb-4">
            <label>Full Name</label>
            <input type="hidden" name="id" value="{{$passport->pass_id}}">
            <input type="hidden" name="price" value="{{$passport->price}}">
            <p class="text-white">{{$passport->pass_name}}</p>            
          </div>
          <div class="form-group mb-4">
            <label>Phone Number</label>
            <p class="text-white">{{$passport->pass_phone}}</p>           
          </div>
          <div class="form-group mb-4">
            <label>Email</label>
            <p class="text-white">{{$passport->pass_email}}</p>           
          </div>
          <div class="clGetYoursNow w-100">
          <button tpe="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Pay {{number_format($passport->price,2)}}</button>
      </div>
        </form>
      </div>
      <div class="PassportAccordian mt-5">
          <div class="card">
            <div class="card-header px-0" id="headingOne">
              <h5 class="mb-0">
                <a href="javascript:void(0);">
                What You Get
                </a>
              </h5>
            </div>
            <div>
              <div class="card-body px-0">
               <ul class="fbFtrLists pl-3">
                  <li>
                    <a href="javascript:void(0);">Beer worth Rs. 12000/-</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Complimentary bottles of house wine</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Complimentary desert cake on your Birthday</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Two complimentary brunch coupons for 2 persons</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Two complimentary couple entries for paid gigs at the Finch</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">15% discount on take away and delivery of Foods & Beer</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Exclusive invites to the beer league event</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Exclusive invites for testing sessions</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">One free invite for Mixology / Food Workshop</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Complimentary tour of our brewery</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">20% Top-up on referreals</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">10% redeemable points on food spends</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<script>
    
  function topupSubmit(e){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('topupSubmit')}}",  
      method:"POST",  
      dataType:"json",
      data:$(e).serialize(),  
      success: function(data){ 
        if(data.success==0){
          toastr.error(data.error,'Error');
        }else if(data.success==1){
          toastr.success(data.message,'Success');
          getTopupConfirmView(data.order_id,data.price,data.payment_id);
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

  function getTopupConfirmView(id,price,payment_id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('getTopupConfirmView')}}",  
      method:"POST",  
      dataType:"json",  
      data:{id:id,price:price},
      success: function(data){ 
        if(data.success==0){
          toastr.error 
        }else if(data.success==1){
          $('#ModalOne .modal-content').html('');    
          $('#ModalOne .modal-content').html(data.view);    
          $('#ModalOne').modal('show');    
        }
      }
    }); 
  }

</script>