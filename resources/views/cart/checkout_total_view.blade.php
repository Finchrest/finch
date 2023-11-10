<?php $subTotal = $total_tax = $total_vat =  $final_total = 0;

foreach ($product_arr as $product) {
   if (empty($product['freeProduct'])) {
      $product_price = $product['product_price'];
   } else {
      $product_price = 0;
   }

   if (!empty($product['product_price'])) {
      $subTotal += $product['qty'] * $product_price;
      if ($product['product_type'] == 1) {
         $total_vat += $product['qty'] * ($product_price * $product['product_tax'] / 100);
      } else {
         $total_tax += $product['qty'] * ($product_price * $product['product_tax'] / 100);
      }

      // $final_total += $product['qty'] * $product_price + $total_vat;

      // echo "<pre>";
      // print_r($final_total);
      // die;
   } else {
      $subTotal += $product['qty'] * $product['price'];
   }
}
?>
<tr>
   <td class="border-0">SubTotal</td>
   <td class="text-right border-0"><b> <i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_sub_total">{{ number_format($subTotal,2) }}</span></b></td>
   <input type="hidden" id="sub_Total" name="sub_Total" value="{{Cart::subtotal()}}">
   <input type="hidden" id="codeType" name="code_type" value="passport">
   <input type="hidden" id="codeNum" name="code_num" value="">
   <input type="hidden" id="codeAmt" name="code_amt" value="">
</tr>
<tr>
   <td class="position-relative">Tax <a href="javascript:void(0)" class="HoverToolTip position-relative"><i class="fa fa-info-circle" aria-hidden="true"></i>
         <p class="position-absolute">According to goverment tax are include in all meals products.</p>
      </a></td>
   <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i> <b><span class="total_tax"> {{ number_format($total_tax,2) }}</span></b></td>
</tr>
<tr>
   <td class="position-relative">Vat <a href="javascript:void(0)" class="HoverToolTip position-relative"><i class="fa fa-info-circle" aria-hidden="true"></i>
         <p class="position-absolute">According to goverment vat are include in all liquor products.</p>
      </a></td>
   <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i> <b><span class="total_vat"> {{ intval($total_vat) }}</span></b></td>
</tr>
<tr>
   <td>Passport Discount </td>
   <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i> <b><span class="passport_discount"> 0.00</span></b></td>
</tr>
<tr>
   <td>Coupon Discount </td>
   <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i><b><span class="coupon_discount"> 0.00</span></b></td>
</tr>
<tr>
   <td>Delivery Charges</td>
   <td class="text-right"><i class='fa fa-inr' aria-hidden='true'></i><b><span class="delivery_charge"> {{ number_format($dCharges,2) }}</span></b></td>
</tr>
<tr>
   <td> Grand total</td>
   <td class="text-right orange-text"><b><i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_total">{{ number_format($total,2) }} </span></b>
      <input type="hidden" name="subtotal" id="final_total" value="{{ number_format($total,2) }}">
   </td>
</tr>