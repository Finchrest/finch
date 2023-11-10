@extends('superadmin.layouts.app')

@section('content')
<!-- Page-body start -->

<div class="page-header card">
  <div class="card-block caption-breadcrumb">
    <div class="breadcrumb-header">
      <h5>{{ ucwords($module) }}s</h5>
    </div>
    <div class="page-header-breadcrumb">
      <a href="#!" class="btn btn-info" onclick="add('{{ $route->add }}')"><i class="fa fa-plus"></i>Add {{ $module }}</a>
    </div>

  </div>
</div>
<!-- Page-header end -->


<!-- Page-body start -->
<div class="page-body">
  <div class="row">
    <div class="col-sm-12">
      <!-- Zero config.table start -->
      <div class="card">

        <div class="card-block">
          <div class="dt-responsive table-responsive">
            <table id="dataTable" class="table table-striped table-bordered nowrap table-sm">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>PassPort Code</th>
                  <th>User</th>
                  <th>Amount </th>
                  <th>Order Date </th>
                </tr>
              </thead>
              <tbody>

              </tbody>

            </table>
          </div>
        </div>
      </div>
      <!-- Zero config.table end -->

    </div>
  </div>

</div>
<!-- Page-body end -->
@endsection

@section('page-js-script')
<script>
  $(document).ready(function() {
    // user management
    window.dataTable = $('#dataTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      //'searching': false,
      'ajax': {
        'headers': {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        'url': "{{ $route->list }}",
        'data': function(data) {

        }
      },
      'lengthMenu': [10, 20, 50, 100, 200, 500],
      'columns': [{
          data: 'sno',
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {
          data: 'passport_code'
        },
        {
          data: 'user'
        },
        {
          data: 'price'
        },
        {
          data: 'order_date'
        },

      ],
      "order": [
        [1, 'asc']
      ]
    });
  });

  function form_submit(e) {
    $(e).find('.st_loader').show();
    $.ajax({
      url: $(e).attr('action'),
      method: "POST",
      dataType: "json",
      data: $(e).serialize(),
      success: function(data) {
        // alert(data);
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
</script>
@endsection