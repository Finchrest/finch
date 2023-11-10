@extends('superadmin.layouts.app')

@section('content')
<!-- Page-body start -->

<div class="page-header card">
    <div class="card-block caption-breadcrumb">
        <div class="breadcrumb-header">
            <h5>{{ $module }}s</h5>
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
                                    <th>Order Id</th>
                                    <th>Payment Id</th>
                                    <th>Remaining Amount</th>
                                    <th>Refund Amount</th>
                                    <th>Product Id</th>
                                    <th>Status</th>
                                    <th>Refund Details</th>
                                    <th>User Id</th>
                                    <th>Refund By </th>
                                    <th>Created</th>
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
                'url': "{{ $route->refund_orders }}",
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
                    data: 'order_id'
                },
                {
                    data: 'payment_id'
                },
                {
                    data: 'total_amount'
                },
                {
                    data: 'refund_amount'
                },
                {
                    data: 'product_id'
                },
                {
                    data: 'status'
                },
                {
                    data: 'refund_details'
                },
                {
                    data: 'user_id'
                },
                {
                    data: 'refund_by'
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

    /*function update_status(url, order_id, status) {
       $.ajax({
         headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
          url: url,
          method: "POST",
          dataType: "json",
          data: {
              order_id: order_id,
              status: status
          },
          success: function(data) {
             if (data.success == 1) {
                toastr.success(data.message, 'Success');
                dataTable.draw(false);

             } else if (data.success == 0) {
                toastr.error(data.message, 'Error');
               
             }
          }        
       });
    }*/
</script>
@endsection