function close_modal() {
  $('#modal-default').modal('hide');
}
function add(url, id) {

  $('#modal-default .modal-content').html('');
  $.ajax({
    url: url,
    method: "GET",
    data: {},
    success: function (res) {
      $('#modal-default .modal-content').html(res);
      $('#modal-default').modal('show');
    }
  });
}

function edit_row(url, id) {
  $('#modal-default .modal-content').html('');
  url = url.replace(':id', id);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url,
    method: "GET",
    data: {},
    success: function (res) {
      $('#modal-default .modal-content').html(res);
      $('#modal-default').modal('show');
    }
  });
}


function delete_row(url, id) {
  url = url.replace(':id', id);

  if (confirm('Are you sure you want to delete this?')) {
    $.ajax({
      url: url,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "GET",
      data: {},
      dataType: "JSON",
      success: function (data) {
        toastr.success(data.message, 'Success');
        dataTable.draw(false);
      },

    });
  } else {
    return false;
  }
}


function upload_image(form, url, id, input) {
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
    success: function (res) {
      if (res.status == 0) {
        $(form).find('.' + id + '_loader').hide();
        toastr.error(res.msg, 'Error');
      } else {
        $(form).find('.' + id + '_loader').hide();
        $('#' + id + '_prev').attr('src', res.file_path);
        $('#' + id + '_prev').show();
        $('#' + input).val(res.file_id);
      }

    }
  });
}


function upload_multiple_image(form, url, id, input) {
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
    success: function (res) {
      if (res.status == 0) {
        $(form).find('.' + id + '_loader').hide();
        toastr.error(res.msg, 'Error');
      } else {
        $(form).find('.' + id + '_loader').hide();
        $('.images_view').html(res.file_view);
        $('#' + input).val(res.file_ids);
      }

    }
  });
}


function delete_multiple_image(url, e) {
  var id = $(e).attr('data-id');
  var ids = $('#file_ids').val();

  if (confirm('Are you sure you want to delete this?')) {
    $.ajax({
      url: url,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      data: { id: id, ids: ids },
      success: function (data) {
        $(e).parent().remove();
        $('#file_ids').val(data);
      },

    });
  } else {
    return false;
  }
}


function show_row(url, id) {
  $('#modal-default .modal-content').html('');
  url = url.replace(':id', id);
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url,
    method: "GET",
    data: {},
    success: function (res) {
      $('#modal-default .modal-content').html(res);
      $('#modal-default').modal('show');
    }
  });

}


function status_change(url, e, id) {

  var status = 0;
  if (confirm("Are you sure want to change status?")) {
    if ($(e).prop("checked") == true) {
      status = 1;
    }
    $.ajax({
      'headers': {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: url,
      method: "POST",
      dataType: "JSON",
      data: {
        id: id,
        status: status
      },
      success: function (res) {
        toastr.success('Status  successfully', 'Success');
      }
    });
  } else {
    if ($(e).prop("checked") == false) {
      $(e).prop('checked', true);

    } else {
      $(e).prop('checked', false);
    }
  }
}