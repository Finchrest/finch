<div class="modal-header">
    <h5 class="modal-title text-white" id="staticBackdropLabel">Pin Verify</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="PassportDetailsHere CnsumerDetails">
        <div class="PassportDetails2 col-md-12">
            <div class="CansumerForm w-100">
                <form method="POST" onsubmit="pinSubmit(this); return false;">
                    @csrf
                    <div class="form-group">
                        <label class="text-white">Login Pin</label>
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="text" class="form-control allowno" name="pin" value="" placeholder="Enter PIN" maxlength="4">
                    </div>
                    <div class="form-group text-center mb-0">
                        <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Verify</button>
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
<script>
    $(document).ready(function() {
        $(".allowno").keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                event.preventDefault();
            }
        });
    });
</script>