<style>
  .colorModel {
    color: #f8bf00 !important;
  }
</style>
<div class="modal-header border-0">
  <h5 class="modal-title colorModel" id="staticBackdropLabel">Choose Order Method</h5><br>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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
                <label class="text-white colorModel">Delivery</label>
                <input type="radio" <?php if (session('orderType') == 0) {
                                      echo 'checked';
                                    } ?> name="ordertype" onchange="checkOrderType(this.value);return false;" class="form-control orderType" value="0">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group text-center">
                <label class="text-white colorModel">Take Away</label>
                <input type="radio" <?php if (session('orderType') == 2) {
                                      echo 'checked';
                                    } ?> name="ordertype" onchange="checkOrderType(this.value);return false;" class="form-control orderType" value="2">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group text-center">
                <label class="text-white colorModel">Dine In</label>
                <input type="radio" <?php if (session('orderType') == 1) {
                                      echo 'checked';
                                    } ?> name="ordertype" onchange="checkOrderType(this.value);return false;" class="form-control orderType" value="1">
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
  function checkOrderType(id) {
    $('.succesBtn').removeClass('d-none');

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{route('get.passportselected.order')}}",
      method: "POST",
      dataType: "json",
      data: {
        'typ': id
      },
      success: function(data) {

        var surl = "{{ route('home') }}";
        window.location.href = surl;
        $('#infoModal').modal('hide');
      },
    });

  }
</script>