<style>
  .cnf_pay{
    border-radius:18px;
    background-color: #0a2240;
  }
</style>
<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="modal-body p-md-5 p-4">
  <div class="FoodDetailsHere PassportDetailsHere UserDetails">
    <div class="PassportDetails3 col-md-10 m-auto p-0">
      <h4 class="text-center">Hi, {{ucwords($passportConfirmOrder->pass_name)}}</h4>
      <div class="CansumerFormTable w-100 text-white">
        <form onsubmit="topupConfirmSubmit(this); return false;">
          <div class="TableBorderBox mt-5">
            <table class="table table-border TableTwo m-0">
              <tr>
                <th>Email:</th>
                <th>{{$passportConfirmOrder->email}}</th>
              </tr>
              <tr>
                <th>Phone:</th>
                <th>{{$passportConfirmOrder->phone}}</th>
              </tr>
              <tr>
                <th>Price:</th>
                <th><i class="fa fa-inr" aria-hidden="true"></i> {{number_format($passportConfirmOrder->pass_price,2)}}</th>
              </tr>
              <tr>
                <th>Date:</th>
                <th>{{date('d M, Y',strtotime($passportConfirmOrder->order_date))}}</th>
              </tr>
            </table>
            <input type="hidden" name="id" value="{{$passportConfirmOrder->id}}">
            <input type="hidden" name="payment_id" value="{{$payment_id}}">
            <input type="hidden" name="name" value="{{$passportConfirmOrder->name}}">
            <input type="hidden" name="email" value="{{$passportConfirmOrder->email}}">
            <input type="hidden" name="phone" value="{{$passportConfirmOrder->phone}}">
            <input type="hidden" name="subtotal" value="{{$passportConfirmOrder->pass_price}}">
            <input type="hidden" name="cur_symbol" value="INR">

          </div>
          <button type="submit" class="btn btn-warning float-right mt-3 text-white cnf_pay">Confirm Pay</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    
  function topupConfirmSubmit(e){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('topupConfirmSubmit')}}",  
      method:"POST",  
      dataType:"json",
      data:$(e).serialize(),  
      success: function(data){ 
        if(data.success==0){
          toastr.error(data.error,'Error');
        }else if(data.success==1){
          toastr.success(data.message,'Success');
          // getPassportSummaryView(data.id);
          razorpay_payment_view(data.id);
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
    
  function razorpay_payment_view(port_id){
    var options = {
      "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
      "amount": $("[name='subtotal']").val()*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
      "currency": $("[name='cur_symbol']").val(),
      "name": "Finch Brew",
      "description": "Passport Transaction",
      "image": "http://brew_beers.local.com/front-assets/images/logo.svg",
      "partial_payment": 1, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
      'custom_branding':true,
      "handler": function (response){
          // return false;
          
          $.ajax({  
            url :"{{ route('topup.topup_payment_submit') }}",  
            method:"POST",  
            dataType:"json",  
            data:{id:port_id,pay_id:response.razorpay_payment_id,res:response,status:1},
            success:function(res){  
            if(res.status == 0){
              var err = JSON.parse(res.msg);
              var er = '';
              $.each(err, function(k, v) { 
              er += v+'<br>'; 
              }); 
              toastr.error(er,'Error');
              $('#copatiblity_form_data .submitBtn').removeAttr('disabled');
            }else if(res.status == 1){
              toastr.success(res.msg,'Success');  
              getTopupSummaryView(res.id);
              getpassportlist(); 
            }
          }
        }); 
      },
      "prefill": {
          "name": $("[name='name']").val(),
          "email": $("[name='email']").val(),
          "contact": $("[name='phone']").val(),
          "order_id": 123132
      },
      "notes": {
          "address": "Razorpay Corporate Office"
      },
      "theme": {
          "color": "#3399cc"
      }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
      console.log('failed - '+response);
      // return false;

      $.ajax({  
        url :"{{ route('topup.topup_payment_submit') }}",  
        method:"POST",  
        dataType:"json",  
        data:{id:port_id,pay_id:response.error.metadata.payment_id,res:response,status:2},
        success:function(res){  
        if(res.status == 0){
          var err = JSON.parse(res.msg);
          var er = '';
          $.each(err, function(k, v) { 
          er += v+'<br>'; 
          }); 
          toastr.error(er,'Error');
          $('#copatiblity_form_data .submitBtn').removeAttr('disabled');
          window.location.href.split('#')[0]
        }else if(res.status == 2){
          toastr.error(res.msg,'Error');
          location.reload();
        }
      }
    }); 
      // alert(response.error.code);
            
    });
    rzp1.open();
    event.preventDefault();
  }

  function getTopupSummaryView(id){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('getTopupSummaryView')}}",  
      method:"POST",  
      dataType:"json",  
      data:{id:id},
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

  
  function getpassportlist(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('getpassportlist')}}",  
      method:"POST",  
      dataType:"json",  
      data:{},
      success: function(data){ 
        $('#getUserdata').html(data.view);
      }
    }); 
  }

</script>