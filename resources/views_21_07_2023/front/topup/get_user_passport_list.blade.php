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
                <span class="span1"><a href="javascript:void(0)" class="text-warning" onclick="copy_code(); return false;" title="Copy Passport Code">{{$order['passport_code']}} &nbsp;<i class="fa fa-clone" aria-hidden="true"></i></a></span>
                <input type="text" value="{{$order['passport_code']}}" name="passport_code" id="passport_code_copy" class="passport_code_input">
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
            <td><a href="javascript:void(0)" onclick="passportDetails(this,`{{ $order['id'] }}`); return false;"><i class="fa fa-eye text-warning" aria-hidden="true"></i></a><br>
            <a href="javascript:void(0)" class="btn text-dark btn-warning btn-sm py-1" onclick="getTopupViewcustomer(this,`{{ $order['id'] }}`); return false;"><small>TopUp</small></a></td>
            </tr>
            <?php } ?>