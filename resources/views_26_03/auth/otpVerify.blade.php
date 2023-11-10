<div class="modal-header">
    <h5 class="modal-title text-white" id="staticBackdropLabel">OTP Verify</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
     <div class="PassportDetailsHere CnsumerDetails">
        <div class="PassportDetails2 col-md-12">
            <div class="CansumerForm w-100">
                <form method="POST" onsubmit="otpSubmit(this); return false;">
                    @csrf
                    <div class="form-group">
                        <label class="text-white">OTP</label>
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="text" class="form-control" name="otp" value="{{$otp}}" placeholder="Enter OTP">
                    </div>
                    <div class="form-group text-center mb-0">
                    <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Verify</button>
                    <a class="btn btn-link mt-2" href="javascript:void(0)" onclick="resendOtp('{{$email}}'); return false;">Resend OTP?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .OrderModalInside .OrderShowModal .modal-content {
    width: 500px;
}
</style>