
<div class="modal-header">
  <h6 class="text-white">Product Details</h6>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body myorderModal">
<section class="insidepage-content-1 myOrderPage">
<div class="YOurHistory myOrderTables">
  <div class="table-responsive" id="checkoutData">
  <table class="table table-border TableThree table-borderless checkout-table" style="min-width: 100% !important;">
        <thead>
          <tr>
            <th class="widthSet2 text-left">Product</th>
            <th class="width_set">Status</th>
            <th class="width_set">Product Type</th>
            <th class="width_set">Total</th>
            
          </tr>
        </thead>
        <tbody>
          <?php foreach($order['items'] as $order){ 
 
              if($order['product']['for_passport'] == 1){
                $productType = "Free Product";
              }else{
                $productType = "Paid Product";
              }
            ?>
            <tr id="oid_{{ $order['id'] }}">
              <td class="widthSet2 text-left">
                <img src="{{ $order['product']['image'] }}" width="50px" class="img-fluid mr-3"> 
                <span>{{ $order['product']['title'] }}</span>
                <?php if ($order['option_name']) { ?>
                  <br><br><div class="my-order-attr">{{ $order['attr_name'] }} : {{ $order['option_name'] }}</div>
                <?php } ?>    
                <?php if(!empty($order['product']['type_name']) ){
                ?>            
            <p class="mt-2 mb-1">Type : {{ $order['product']['type_name'] }}</p>
            <?php   } ?> 
            </td>
            <td>
                <?php if ($order['is_cancelled'] == 1) { 
                  echo 'Cancelled';
                } else {
                  echo 'Approved';
                } ?>
              </td>     <td>
              {{ $productType}}
              </td>
              <td class="width_set">
              <p class="mb-1 text-left">
               <span class="span1">Qty</span>
                : <span class="span2">{{ $order['qty'] }} * {{ number_format($order['price'],2) }}</span>
            </p>
            <p class="mb-1 text-left">
               <span class="span1">Total</span>
                : <span class="span2">{{ number_format($order['sub_total'],2) }}</span>
            </p></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
</div>
  </section>
</div>

<script>

  

</script>