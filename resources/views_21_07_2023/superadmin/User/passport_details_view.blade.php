<div class="modal-header">
  <h6 class="text-white">Passport - <b>#{{$passport_code}}</b></h6>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<section class="insidepage-content-1 myOrderPage">
<div class="YOurHistory myOrderTables">
<div class="table-responsive" id="">
  <table class="table table-border TableThree table-borderless checkout-table" style="min-width: 100% !important;">
      @if($orders)
        @foreach($orders as $order)
          <tr>
            <td style="width:33%">{{ $order['order_date'] }}</td>
            <td style="width:33%"><i class="fa fa-inr" aria-hidden="true"></i> {{ number_format($order['amount'],2) }}</td>
            <td style="width:33%">{{$order['order_type']}}</td>
          </tr>
        @endforeach
      @else
        <div class="text-danger text-center font-weight-bold">No history found on this passport!!</div>
      @endif
    </table>
  </div>
</div>
</div>

<style>
  .OrderShowModal .modal-content {
    width: 500px;
    margin: 0 auto;
  }
</style>