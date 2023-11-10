@extends('layouts.app')
@section('content')
<style>
  .passport_code_input {
		opacity: 0;
	}
</style>
<section class="insidepage-content-1 my-md-5 py-5 px-2 myOrderPage myPassportPage">
  <div class="container mt-md-5 myOrderContainer">
    <div class="HeadingText HeadingText2 text-center mb-3">
      <h3 class="mb-4">My Passports</h3>
    </div>
    <div class="YOurHistory myOrderTables">
      <div class="table-responsive" id="checkoutData">
        <table class="table table-border TableThree table-borderless checkout-table">
          <thead>
            <tr>
            <th class="text-left">Name</th>
            <th class="text-left">Details</th>
            <th class="text-left">Amount Details</th>
            <th class="text-left">Passport Code</th>
            <th class="text-left">Validity Details</th>
            <th>Action</th>
            </tr>
          </thead>
          <tbody id="getUserdata">
          <?php foreach($orders as $order){ ?>
            <tr id="oid_{{ $order['id'] }}">
            <td class="text-left">{{ ucwords($order['name']) }}</td>
            <td class="text-left">
            <p class="mb-1 text-left"><span class="span2">{{ $order['phone'] }}</span></p>
            <p class="mb-1 text-left"><span class="span2">{{ $order['email'] }}</span></p>
            </td>
            <td class="text-left">
            <p class="mb-1 text-left">
               <span class="span1">Price</span>
                : <span class="span2">{{ number_format($order['price'],2) }}</span>
            </p>
            <p class="mb-1 text-left">
               <span class="span1">Value</span>
                : <span class="span2">{{ number_format($order['volume_amount'],2) }}</span>
            </p>
            <p class="mb-1 text-left">
               <span class="span1">Used</span>
               :<span class="span2">{{ number_format($order['used_amount'],2) }}</span>
            </p>
            <p class="mb-1 text-left">
               <span class="span1">Remaining</span>
                : <span class="span2">{{ number_format($order['remaining_amount'],2) }}</span>
            </p> 
         </td>
            <td>
              <p class="mb-1 text-left">
              <?php if($order['status'] == 1){ ?>
                <span class="span1"><a href="javascript:void(0)" class="text-warning" onclick="copy_code(); return false;" title="Copy Passport Code">{{$order['passport_code']}} &nbsp;<i class="fa fa-clone" aria-hidden="true"></i></a></span>
                <input type="text" value="{{$order['passport_code']}}" name="passport_code" id="passport_code_copy" class="passport_code_input">
                <?php }else{ ?>
                  <span class="span1"><a href="javascript:void(0)" class="text-warning">{{$order['passport_code']}} &nbsp;</a></span>
                <input type="text" value="{{$order['passport_code']}}" name="passport_code" id="passport_code_copy" class="passport_code_input">
                <?php } ?>
              </p>
            </td>
            <td class="text-left">
              <p class="mb-1 text-left">
                <span class="span1">Start</span>
                  : <span class="span2">@if($order['start_date']){{ date('d M, Y',strtotime($order['start_date'])) }}@else{{'NA'}}@endif</span>
              </p>
              <p class="mb-1 text-left">
                <span class="span1">End</span>
                  : <span class="span2">@if($order['end_date']){{ date('d M, Y',strtotime($order['end_date'])) }}@else{{'NA'}}@endif</span>
              </p>
            </td>
            <td>
          <?php if($order['status'] == 1){ ?>
            <a href="javascript:void(0)" onclick="passportDetails(this,`{{ $order['id'] }}`); return false;"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a><br>
            <a href="javascript:void(0)" class="btn text-dark btn-warning btn-sm py-1" onclick="getTopupViewcustomer(this,`{{ $order['id'] }}`); return false;"><small>TopUp</small></a>
            <?php }else{ ?>
              <a href="javascript:void(0)" onclick="passportDetails(this,`{{ $order['id'] }}`); return false;"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a><br>
              <a href="javascript:void(0)" class="btn text-dark btn-danger btn-sm py-1"><small>Expired</small></a>
            <?php } ?>
            </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<div class="modal fade OrderShowModal" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog h-100" style="min-width:90%;max-width:90%">
      <div class="d-table h-100 w-100">
        <div class="d-table-cell align-middle w-100">
          <div class="modal-content">
            
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
<script> 
  function passportDetails(e,id){
     $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
     $.ajax({  
        url :"{{ route('passportDetails') }}",  
        method:"post",  
        dataType:'json',
        data:{id:id},
        success: function(data){ 
           if(data.success == 1){
              $('#productModal .modal-content').html(data.view);
            //   $('.modal-content').css('background','#1e4b52');
              $('#productModal').modal('show');
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

  function copy_code() {
	  var copyText = document.getElementById("passport_code_copy");
	  copyText.select();
	  copyText.setSelectionRange(0, 99999)
	  document.execCommand("copy");
	  toastr.success('Code Copied','Success');
	}

  function getTopupViewcustomer(e,id){
   
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({  
      url :"{{route('getTopUpViewcustomer')}}",  
      method:"POST",  
      dataType:"json",
      data:{'order_id':id},  
      success: function(data){ 
        if(data.success==0){
          toastr.error(data.message,'Error');
        }else if(data.success==1){
          $('#ModalOne .modal-content').html('');    
          $('#ModalOne .modal-content').html(data.view); 
          $('#ModalOne').modal('show');   
        }
      }
    }); 
  }

  function getTopupView(e,id) {
  
      if (user_id == 'no') {
        toastr.error('Please login first!!', 'Error');
        showLoginPage();
        return false;
      }
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: "{{route('showTopUpPage')}}",
        method: "POST",
        dataType: "json",
        data:{'order_id':id},
        success: function(data) {
          if (data.success == 0) {
            toastr.error(data.message, 'Error');
            showLoginPage();
          } else if (data.success == 1) {
            $('#ModalOne .modal-content').html(data.view);
            $('#ModalOne').modal('show');
          }
        }
      });
    }
  
</script>