<div class="modal-header">
    <h5 class="modal-title text-white" id="staticBackdropLabel">Login</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="PassportDetailsHere CnsumerDetails">
        <div class="PassportDetails2 col-md-12">
            <div class="CansumerForm w-100">
                <form method="POST" onsubmit="loginSubmit(this); return false;" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label>Email/Phone</label>
                        <input id="email" type="text" class="form-control" name="email" value="" placeholder="Email/Phone">
                    </div>
                    <div class="form-group mb-0">
                    <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Login</button>
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