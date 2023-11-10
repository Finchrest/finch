<form action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST">
  <input type="hidden" name="id" value="">
  <div class="modal-header">
    <h4 class="modal-title">Add {{ $module }}</h4>
    <button type="button" class="close" onclick="close_modal()">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body py-3">

    @csrf

    <div class="row">

      <div class="col-md-12">
        <div class="form-group">
          <label>Title<sup class="text-danger">*</sup></label>
          <input type="text" class="form-control " name="title" placeholder="Enter Product Title" value="">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Sub Title</label>
          <input type="text" class="form-control " name="sub_title" placeholder="Enter Product Sub Title" value="">
        </div>
      </div>
    </div>
    <input type="hidden" name="for_passport" value="1">

    <div class="row">


      <div class="col-md-6">
        <div class="form-group ">
          <label>Status</label>
          <select name="status" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group ">
          <label>Veg/Nonveg</label>
          <select name="is_veg" class="form-control">
            <option value="0">Veg</option>
            <option value="1">Nonveg</option>
          </select>
        </div>
      </div>

    </div>

    <div class="col-md-12">
      <div class="form-group mb-0">
        <label>Product Image <small>(jpg, png, jpeg)</small><sup class="text-danger">*</sup></label>
        <div class="input-group ">
          <div class="col-md-6">
            <div class="custom-file">
              <input type="hidden" name="image_path" value="upload/products/">
              <input type="hidden" name="image_name" value="image">
              <input type="file" class="custom-file" name="image" onchange="upload_image($(form),'{{ $route->upload }}','image','file_id')" accept=".jpg,.jpeg,.png">
              <input type="hidden" name="file_id" id="file_id" value="">
              <i class="image_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
            </div>
          </div>
          <div class="col-md-6">
            <img src="" id="image_prev" class="img-thumbnail " alt="" width="100" height="100" style="display:none">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 badge_icon">
      <div class="form-group mb-0">
        <label>Badge Icon <small>(jpg, png, jpeg)</small><sup class="text-danger">*</sup></label>
        <div class="input-group ">
          <div class="col-md-6">
            <div class="custom-file">
              <input type="hidden" name="badge_path" value="upload/products/">
              <input type="hidden" name="badge_name" value="badge">
              <input type="file" class="custom-file" name="badge" onchange="upload_image_2($(form),'{{ $route->upload }}','badge','file_id_2','image_prev_2')" accept=".jpg,.jpeg,.png,.JPG,.PNG,.JPEG">
              <input type="hidden" name="file_id_2" id="file_id_2" value="">
              <i class="image_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i>
            </div>
          </div>
          <div class="col-md-6">
            <img src="" id="image_prev_2" class="img-thumbnail " alt="" width="100" height="100" style="display:none">
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" onclick="close_modal()">Cancel</button>
    <button type="submit" class="btn btn-success">Save <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
  </div>

</form>


<script>
  $(document).ready(function() {

    $('.select_attr').on('change', function() {
      var attr_id = $('.select_attr option:selected').val();
      var options = $('.select_attr option:selected').data('options');
      var options_ids = $('.select_attr option:selected').data('option_ids');
      var atts = '';
      if (options && options_ids) {
        var optionsArr = options.split(',');
        var optionsIds = options_ids.split(',');
        //optionsArr.forEach(function (value, i) {
        for (let i = 0; i < optionsArr.length; i++) {
          atts += '<div class="row"><div class="col-md-3"><div class="form-group "><label>Option Name</label><input type="text" name="select_attr_options[]" class="form-control select_attr_options" value="' + optionsArr[i] + '" readonly><input type="hidden" name="attr_options_id[]" class="form-control attr_options_id" value="' + optionsIds[i] + '" readonly></div></div><div class="col-md-3"><div class="form-group "><label>Price</label><input type="text" name="attr_regular_price[]" class="form-control attr_regular_price" value="0" ></div></div><div class="col-md-3"><div class="form-group "><label>Tax</label><input type="text" name="attr_tax_price[]" class="form-control attr_tax_price" value="0"><span class="input-group-addon attr_tax_percentage">%</span></div></div><div class="col-md-3"><div class="form-group "><label>Total Price</label><input type="text" name="attr_total_price[]" class="form-control attr_total_price" value="0" readonly></div></div></div>';
        }
        $('#show_product_attr').html(atts);
        $('.price_row').hide();
        $('#is_product_attr').val(attr_id);
      } else {
        $('#show_product_attr').html('');
        $('.price_row').show();
        $('#is_product_attr').val(0);
      }

    });

    $(document).on('change', '.attr_regular_price', function() {
      var attr_regular_price = $(this).val();
      var attr_tax_price = $(this).closest('.row').find('.attr_tax_price').val();
      var attr_final_price = parseFloat(attr_regular_price) + parseFloat((attr_regular_price * attr_tax_price) / 100);
      $(this).closest('.row').find('.attr_total_price').val(attr_final_price);
    });

    $(document).on('change', '.attr_tax_price', function() {
      var attr_regular_price = $(this).closest('.row').find('.attr_regular_price').val();
      var attr_tax_price = $(this).val();
      var attr_final_price = parseFloat(attr_regular_price) + parseFloat((attr_regular_price * attr_tax_price) / 100);
      $(this).closest('.row').find('.attr_total_price').val(attr_final_price);
    });

    $(".allowno").keypress(function(e) {
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        event.preventDefault();
      }
    });
    $('.allowno').on('paste', function(e) {
      if (e.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
        e.preventDefault();
      }
    });

    $(".select_2").select2();

    $(".select_hop").select2({
      placeholder: "Select",
    });

    $(".select_malt").select2({
      placeholder: "Select Malts",
    });
    $(".select_category").select2({
      placeholder: "Select Category",
    });
    $(".select_sub_category").select2({
      placeholder: "Select Category",
    });

    $('#summernote').summernote({
      height: 200, // set editor height
      focus: true,
      popover: {
        image: [],
        link: [],
        air: []
      },
    });

  });

  function set_type(e) {
    var type = $(e).val();
    if (type == 2) {
      $('.drink, .badge_icon, #image_prev_2').hide();
      $('.drink, #file_id_2').val('');
      $('#file_id_2').prev("[type='file']").val('');
      $('#image_prev_2').attr('src', '');
    } else {
      $('.drink, .badge_icon').show();
    }
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
          $('#modal-default').modal('hide');
          $('#modal-default .modal-content').html('');
          dataTable.draw(false);

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

  function setPrice(e, price_id, tax_id) {
    var priceVal = $('#' + price_id).val();
    var taxVal = $('#' + tax_id).val();
    var total = priceVal;

    if (taxVal != '') {
      var total = parseInt(priceVal) + parseInt((parseInt(priceVal) * parseInt(taxVal) / 100));
    }
    $('#totalPrice').val(total);
  }

  function setSubCategory(e) {
    var categoryId = $(e).val();
    $.ajax({
      url: "{{route ('sub_categories.setSubCategory') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      dataType: "json",
      data: {
        category_id: categoryId
      },
      success: function(data) {
        if (data.status == 1) {
          $('.select_sub_category').html('');
          $('.select_sub_category').html(data.opt);
        } else if (data.status == 0) {
          toastr.error(data.msg, 'Error');
          $('.select_sub_category').html('<option value="" >Select</option>');
          $('.select_sub_category').html('');
          $('.new_row').html('');
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
      }
    });
  }

  function upload_image_2(form, url, id, input, id_2) {
    $(form).find('.' + id + '_loader').show();
    $.ajax({
      type: "POST",
      url: url + '?type=' + id,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      data: new FormData(form[0]),
      success: function(res) {
        if (res.status == 0) {
          $(form).find('.' + id + '_loader').hide();
          toastr.error(res.msg, 'Error');
        } else {
          $(form).find('.' + id + '_loader').hide();
          $('#' + id_2).attr('src', res.file_path);
          $('#' + id_2).show();
          $('#' + input).val(res.file_id);
        }

      }
    });
  }


  function getOptionValue(selectElement) {
    var selectedValue = $(selectElement).val();
    if (selectedValue == 1) {
      $('.freeProductValue').hide();
    } else if (selectedValue == 0) {
      $('.freeProductValue').show();
    }
  }
</script>