?>
<div class="modal-header">
    <h5 class="modal-title text-white" id="staticBackdropLabel">Update profile</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="PassportDetailsHere CnsumerDetails">
        <div class="PassportDetails2 col-md-12">
            <div class="CansumerForm w-100">
                <form method="POST" onsubmit="updateUser(this); return false;">
                    @csrf
                    <div class="form-group">
                        <label class="text-white">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{@$name}}" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label class="text-white">Email</label>
                        <input type="email" class="form-control" name="email" value="{{@$email}}" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label class="text-white">Mobile</label>
                        <input type="number" class="form-control" name="phone" value="{{@$phone}}" placeholder="Mobile Number">
                    </div>
                    <div class="form-group">
                        <label class="text-white">Age</label>
                        <input type="number" class="form-control" name="age" value="{{@$age}}" placeholder="Age">
                    </div>
                    <div class="form-group">
                        <label class="text-white">Login Pin</label>
                        <input type="text" class="form-control allowno" name="login_pin" value="{{@$login_pin}}" placeholder="Login Pin" maxlength="4">
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Update Profile <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".allowno").keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                event.preventDefault();
            }
        });
    });

    function updateUser(e) {
        $(e).find('.btn').attr('disabled', 'true');
        $(e).find('.st_loader').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('updateUser')}}",
            method: "POST",
            dataType: "json",
            data: $(e).serialize(),
            success: function(data) {
                if (data.success == 1) {
                    toastr.success(data.message, 'Success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(data.message, 'Error');
                    $(e).find('.btn').removeAttr('disabled');
                    $(e).find('.st_loader').hide();
                }
            },
            error: function(data) {
                if (typeof data.responseJSON.status !== 'undefined') {
                    toastr.error(data.responseJSON.error, 'Error');
                } else {
                    $.each(data.responseJSON.errors, function(key, value) {
                        toastr.error(value, 'Error');
                    });
                }
                $(e).find('.btn').removeAttr('disabled');
                $(e).find('.st_loader').hide();
            }
        });
    }
</script>