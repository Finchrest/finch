<style>
  .colorModel {
    color: #f8bf00 !important;
  }
</style>
<div class="modal-header border-0 pb-0">
  <h5 class="modal-title colorModel" id="staticBackdropLabel">Choose Order Method</h5><br>
</div>
<div class="modal-body">
  <p class="text-white mb-0">Choose an order type within Delivery, Take Away And Dine In</p>

  <section class="w-100  AboutUs mt-5" id="AboutUs">
    <div class="mt-3">
      <div class="fbLocate w-100 ">
        <form action="{{ route('order.type.save') }}" onsubmit="form_submit(this);return false;" method="POST">



          <div class="row">
            <div class="col-4">
              <div class="form-group text-center">
                <label class="colorModel">Delivery</label>
                <input type="radio" name="ordertype" onchange="checkOrderType(this.value);return false;" class="form-control orderType" value="0">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group text-center">
                <label class="colorModel">Take Away</label>
                <input type="radio" name="ordertype" onchange="checkOrderType(this.value);return false;" class="form-control orderType" value="2">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group text-center">
                <label class="colorModel">Dine In</label>
                <input type="radio" name="ordertype" onchange="checkOrderType(this.value);return false;" class="form-control orderType" value="1">
              </div>
            </div>

          </div>
          <div class="row PassportView">

          </div>
      </div>

      </form>

    </div>
</div>

</section>
</div>
<style>
  .OrderModalInside .OrderShowModal .modal-content {
    width: 500px;
  }
</style>

<script>
  // $('.orderType').

  function checkOrderType(id) {

    $('.succesBtn').removeClass('d-none');
    var uid = $('#user_id').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('get.passport.order')}}",
      method: "POST",
      dataType: "json",
      data: {
        'typ': id,
        'uid': uid
      },
      success: function(data) {
        toastr.success('Order Type Selected Successfully');
        var surl = "{{ route('home') }}";
        window.location.href = surl;
        $('#infoModal').modal('hide');
      },
    });
  }

  function form_submit(e) {
    $(e).find('.st_loader').show();
    $.ajax({
      url: $(e).attr('action'),
      method: "POST",
      dataType: "json",
      data: $(e).serialize(),
      success: function(data) {
        if (data.success == 1) {
          toastr.success(data.message, 'Success');
          $(e).find('.st_loader').hide();
          $(e)[0].reset();
          var surl = "{{ route('home_passport_select') }}";
          window.location.href = surl;

        } else if (data.success == 0) {
          toastr.error(data.message, 'Error');
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
        $(e).find('.st_loader').hide();
      }
    });
  }
</script>