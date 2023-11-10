@extends('layouts.app')
@section('content')
<section class="insidepage-content-1 my-md-5 py-5 px-2 myOrderPage myAllOrderPage">
  <div class="container mt-md-5 myOrderContainer">
    <div class="HeadingText HeadingText2 text-center mb-3">
      <h3 class="mb-4">My Orders</h3>
    </div>
    <div class="YOurHistory myOrderTables">
      <div class="table-responsive" id="checkoutData">
        <table class="table table-border TableThree table-borderless checkout-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Quantity</th>
              <th>Sub Total</th>
              <th>Total Pay</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order){ ?>
            <tr id="oid_{{ $order['id'] }}">
              <td>{{ ucwords($order['name']) }}</td>
              <td>{{ $order['qty'] }}</td>
              <td>{{ number_format($order['sub_total'],2) }}</td>
              <td>{{ number_format($order['total_pay'],2) }}</td>
              <td><?php if($order['order_status'] == 1) {
                echo 'Accepted';
              } elseif($order['order_status'] == 2) {
                echo 'Cancelled';
              } else {
                echo 'Pending';
              } ?></td>
              <td><a href="javascript:void(0)" onclick="orderDetails(this,`{{ $order['id'] }}`); return false;"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a></td>
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
  <!-- <div class="modal-dialog d-table modal-lg h-100" role="document" style="min-width:90%;max-width:90%">
  <div class="d-table-cell align-middle w-100">
    <div class="modal-content">
    </div>
  </div>
  </div> -->
</div>
<!-- <div class="modal fade OrderShowModal" id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width:90%">
    <div class="modal-content">
    </div>
  </div>
</div> -->
@endsection
<script> 
  function orderDetails(e,id){
     $.ajaxSetup({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
     $.ajax({  
        url :"{{ route('orderDetails') }}",  
        method:"post",  
        dataType:'json',
        data:{id:id},
        success: function(data){ 
           if(data.success == 1){
              $('#productModal .modal-content').html(data.view);
              // $('.modal-content').css('background','#1e4b52');
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
  
</script>