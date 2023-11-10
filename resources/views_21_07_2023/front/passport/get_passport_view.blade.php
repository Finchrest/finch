<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="modal-body p-md-5 p-4">
  <div class="FoodDetailsHere PassportDetailsHere CnsumerDetails">
    <div class="PassportDetails2 col-md-10 m-auto">
      <div class="CansumerForm w-100">
        <form onsubmit="passportSubmit(this); return false;">
          <div class="form-group mb-4">
            <label>Full Name</label>
            <input type="hidden" name="id" value="{{$passport->id}}">
            <input type="hidden" name="price" value="{{$passport->price}}">
            <input type="text" class="form-control" name="consumer_name" value="{{ @$user->name }}" placeholder="Full Name">
          </div>
          <div class="form-group mb-4">
            <label>Phone Number</label>
            <input type="number" class="form-control" name="phone" value="{{ @$user->phone }}" placeholder="Phone Number">
          </div>
          <div class="form-group mb-4">
            <label>Email</label>
            <input type="email" class="form-control" value="{{ @$user->email }}" name="email" placeholder="Email">
          </div>
          <div class="form-group mb-4">
            <input type="checkbox" id="vehicle1" name="termsCondition" required>
            <label for="vehicle1">TERMS AND CONDITION</label>
          </div>
          <div class="clGetYoursNow w-100">
          <button tpe="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Pay {{number_format($passport->price,2)}}</button>
      </div>
        </form>
      </div>
      <div class="PassportAccordian mt-5">
        <div id="accordion">
          <div class="card">
            <div class="card-header px-0" id="headingOne">
              <h5 class="mb-0">
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                TERMS OF USE <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                </a>
              </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body px-0">
                <ul class="fbFtrLists pl-3">
                  <li>
                    <a href="javascript:void(0);">For consumption in both the restaurants</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Valid on any available craft beers</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">12 month validity</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Min. consumption half ltr in one transaction</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">Max consumption 4 ltrs in 1 day</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">This redemption can not be clubbed with any other discounts, offers or vouchers</a>
                  </li>
                  <li>
                    <a href="javascript:void(0);">This program is non-transferrable and money paid is non refundable and this can not be partly or wholly uncashed</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header px-0" id="headingTwo">
              <h5 class="mb-0">
                <a href="javascript:void(0);" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                SEE ALL BENEFITS <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                </a>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
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
</div>

<script>
    
  function passportSubmit(e){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('passportSubmit')}}",  
      method:"POST",  
      dataType:"json",
      data:$(e).serialize(),  
      success: function(data){ 
        if(data.success==0){
          toastr.error(data.error,'Error');
        }else if(data.success==1){
          toastr.success(data.message,'Success');
          getPassportConfirmView(data.order_id,data.price,data.payment_id);
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

  function getPassportConfirmView(id,price,payment_id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('getPassportConfirmView')}}",  
      method:"POST",  
      dataType:"json",  
      data:{id:id,price:price},
      success: function(data){ 
        if(data.success==0){
          toastr.error 
        }else if(data.success==1){
          $('#ModalOne .modal-content').html('');    
          $('#ModalOne .modal-content').html(data.view);    
          // $('#ModalOne').modal('show');    
        }
      }
    }); 
  }

</script>