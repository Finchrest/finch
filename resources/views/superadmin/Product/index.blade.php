@extends('superadmin.layouts.app')

@section('content')
<!-- Page-body start -->

<div class="page-header card">
  <div class="card-block caption-breadcrumb">
    <div class="breadcrumb-header">
      <h5>{{ $module }}s</h5>
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
                  <th>Action</th>
                  <th>Title</th>
                  <th>Sub Title</th>
                  <th>Place</th>
                  <th>Type</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Price</th>
                  <th>Tax</th>
                  <th>Total Price</th>
                  <th>Status</th>
                  <th>Created </th>
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
          data: 'action'
        },
        {
          data: 'title'
        },
        {
          data: 'sub_title'
        },
        {
          data: 'place'
        },
        {
          data: 'type'
        },
        {
          data: 'category'
        },
        {
          data: 'sub_category'
        },
        {
          data: 'price'
        },
        {
          data: 'tax'
        },
        {
          data: 'total_price'
        },
        {
          data: 'status'
        },
        {
          data: 'created_at'
        },
      ],
      "order": [
        [1, 'asc']
      ]
    });
  });

  function setLocation(e) {
    $.ajax({
      url: "{{route ('product_set_location') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      dataType: "json",
      data: {
        location_id: $(e).val()
      },
      success: function(data) {
        if (data.status == 1) {
          $('.select_place').html('');
          $('.select_place').html(data.opt);
        } else if (data.status == 0) {
          toastr.error(data.msg, 'Error');
          $('.select_place').html('<option value="" >Select</option>');
          $('.select_product').html('');
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


  function productDuplicate(e, id) {
    $.ajax({
      url: "{{route ('product_duplicate') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      dataType: "json",
      data: {
        'id': id
      },
      success: function(res) {
        if (res.status == 1) {
          toastr.success(res.msg, 'Success');
          dataTable.draw(false);
        }
      }
    });
  }
</script>
@endsection