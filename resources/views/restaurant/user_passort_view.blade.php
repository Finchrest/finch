<section class="insidepage-content-1 my-md-5 py-5 px-2 myOrderPage myPassportPage bg-primary">
  <div class="container mt-md-5 myOrderContainer">
    <div class="HeadingText HeadingText2 text-center mb-3">
      <h3 class="mb-4">My Passports</h3>
    </div>
    <div class="YOurHistory myOrderTables">
      <div class="table-responsive" id="checkoutData">
        <table class="table table-border TableThree table-borderless checkout-table">
          <thead>
            <tr>
            <th class="text-left text-white">Name</th>
            <th class="text-left text-white">Detail</th>
            <th class="text-left text-white">Amount Details</th>
            <th class="text-white">Validity Details</th>
            </tr>
          </thead>
          <tbody id="getUserdata">
            <tr id="">
            <td class="text-left text-white">{{ ucwords($passport->passName) }}</td>
            <td class="text-left text-white">
            <p class="mb-1 text-left">
               <!-- <span class="span1">Value</span> -->
                <span class="span2">Phone :{{ $passport->phone }}</span><br>
                <span class="span2">Email :{{ $passport->email }}</span><br>
            </p>
            </td>
            <td class="text-left text-white">
            <p class="mb-1 text-left">
               <!-- <span class="span1">Price</span> -->
                <span class="span2">Price:{{ number_format($passport->price,2) }}</span><br>
                <span class="span2">Value:{{ number_format($passport->volume_amount,2) }}</span><br>
                <span class="span2">Used:{{ number_format($passport->used_amount,2) }}</span><br>
                <span class="span2">Remaining:{{ number_format($passport->remaining_amount,2) }}</span><br>
            </p>
            </td>
            <td class="text-left">
              <p class="mb-1 text-left">
                <span class="span1">Start</span>
                  : <span class="span2">@if($passport->start_date){{ date('d M, Y',strtotime($passport->start_date)) }}@else{{'NA'}}@endif</span>
              </p>
              <p class="mb-1 text-left">
                <span class="span1">End</span>
                  : <span class="span2">@if($passport->end_date){{ date('d M, Y',strtotime($passport->end_date)) }}@else{{'NA'}}@endif</span>
              </p>
              <p class="mb-1 text-left">
              <a href="javascript:void(0)" class="btn text-dark btn-warning btn-sm py-1" onclick="getpassportItem(this,`{{ $passport->passport_id }}`,`{{ $passport->passport_code }}`); return false;"><small>Add Item</small></a>
              <p class="mb-1 text-left">
            </td>
          
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>
</section>