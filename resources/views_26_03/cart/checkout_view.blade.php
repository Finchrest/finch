<style type="text/css">
.OrderShowModal .modal-content {
    width: 700px;
    margin: 0 auto;
}
</style>
<div class="modal-header" style="justify-content: center;">
    <div class="HeadingText HeadingText2 text-center">
        <h3 class="mb-3">Delivery Address</h3>
        <p>Delivery will be dispatched in 20-30 minutes</p>
    </div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container">
        <div class="fbFinchInfoDetails">
            <div class="FinchMegaInfo w-100">
                <div class="FbFinchBrefCafe w-100 border-0 py-5">
                            <div class="CansumerForm w-100">
                                <form onsubmit="cartProcess(this); return false;">
                                    <div class="form-group mb-4">
                                        <label>Consumer Name</label>
                                        <input type="text" class="form-control" name="consumer_name" placeholder="Your Name" value="{{auth()->user()->name}}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Mobile Number" value="{{auth()->user()->phone}}">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="" placeholder="Address">
                                    </div>
                                        <div class="form-group mb-4">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" value="" placeholder="City">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>State</label>
                                            <input type="text" class="form-control" name="state" value="" placeholder="State">
                                            <input type="hidden" name="amount" value="{{@$amt}}">
                                            <input type="hidden" name="codeType" value="{{@$codeType}}">
                                            <input type="hidden" name="codeNum" value="{{@$codeNum}}">
                                            <input type="hidden" name="codeAmt" value="{{@$codeAmt}}">
                                        </div>
                                    <div class="clGetYoursNow w-100" style="padding: 0px !important;">
                                        <button tpe="submit" class="btn m-0 onOrder onOrder2 w-100 p-3"><b ><i class='fa fa-inr' aria-hidden='true'></i> <span class="cat_total">{{@$amt}} </span></b> Continue To Payment</button>
                                    </div>
                                </form>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>