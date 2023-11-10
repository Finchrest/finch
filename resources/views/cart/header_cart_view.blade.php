<style>
.head_car {
    max-height: 226px;
    overflow-y: auto;
}
.tableCartData td {
    padding: 5px !important;
    text-align: center !important;
    vertical-align: middle !important;
    border-top: 0 !important;
    border-bottom: 1px solid #e4e4e4 !important;
}

.tableCartData td img.dropdown-img-header {
    max-height: 50px !important;
    width: auto !important;
}
</style>
@if($product_arr)
  <div class="head_car">
    <table class="table table-stripped tableCartData m-0">
      @foreach($product_arr as $product)                        
        <tr>
          <td>
            <img src="{{ $product['image'] }}" class="dropdown-img-header" width="40" alt="">
          </td>
          <td class="" style="color:black;">
            <div class="drop-itm">
              <h6 style="font-size:12px;" class="m-0"><b>{{ $product['name'] }}</b></h6>
            </div>
            <!--drop-itm-->
          </td>
          <td style="color:black;font-size:11px;"><b><i class='fa fa-inr' aria-hidden='true'></i> {{ $product['price'] }} * {{ $product['qty'] }} qty</b></td>
        </tr>
      @endforeach
    </table>
  </div>
  <div class="submitBtn text-center pt-2">
    <a href="{{ route('checkout') }}" class="btn fbBtn1 btn-warning" style="background-color: #f8bf00 !important;">CheckOut</a>
  </div>
@else
  <div class="submitBtn text-center pt-2 text-danger">No items in cart!!</div>
@endif