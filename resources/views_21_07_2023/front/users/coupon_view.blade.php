<style>
.Coupon .modal-content {
    width: 500px;
    margin: 0 auto;
}
</style>
<div class="modal-header">
<h5 class="modal-title text-white" id="staticBackdropLabel">Passport/Coupon Code <span class="otp_code"></span></h5>
  <!-- <h2 class="text-white">Passport/Coupon Code <span class="otp_code"></span></h2> -->
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
<div class="PassportDetailsHere CnsumerDetails">
        <div class="PassportDetails2 col-md-12">
            <div class="CansumerForm w-100">
            <form action="" id="codeForm">
    @if($type == 2)                
        <div class="form-group">
            <label>Passport Code</label>
            <select class="form-control" name="code" id="" onchange="sendOtp(this,'codeForm',2); return false;">
              <option value="">--Select--</option>
              @foreach($passport_orders as $passport_order)
                <option value="{{$passport_order->passport_code}}">{{$passport_order->passport_code}}</option>
              @endforeach
            </select>
            <!-- <input type="text" class="form-control" name="code" placeholder="Enter your passport code here"> -->
            <input type="hidden" name="type" value="2">
        </div>
        <div class="form-group otp_div">
            <label>OTP</label>
            <input type="text" class="form-control" id="otp_code" name="otp" placeholder="Enter your otp here">
        </div>
        <div class="form-group mb-0 otp_div">
        <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3" onclick="otpVerify(this,'codeForm',2); return false;">Verify OTP</button>
       </div>
       <div class="form-group mb-0 no_otp d-none">
        <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3" onclick="sendOtp(this,'codeForm',2); return false;">Submit</button>
       </div>
       @else
       <div class="form-group">
            <label>Coupon Code</label>
            <input type="text" class="form-control" id="coupon" name="code" placeholder="Enter your coupon code here">
        </div>
        <div class="form-group mb-0">
        <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3" onclick="applyCode(this,'coupon',4); return false;">Apply</button>
       </div>
    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script>

  

</script>