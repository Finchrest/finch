@extends('admin.layouts.app')

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
                                    <th>Action</th>
                                    <th>Order Id</th>
                                    <th>Restaurant</th>
                                    <th>Customer</th>
                                    <th>Shipping Address</th>
                                    <th>Quantity</th>
                                    <th>Amount </th>
                                    <th>Order Date </th>
                                    <th>Payment date </th>
                                    <th>Status </th>
                                    <th>Order For</th>
                                    <!-- <th>Order Status </th> -->
                                    <th>Created </th>
                                    <th>Order Type </th>
                                 
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
                    data: 'order_id'
                },
                {
                    data: 'restaurant'
                },
                {
                    data: 'user'
                },
                {
                    data: 'shipping_address'
                },
                {
                    data: 'qty'
                },
                {
                    data: 'total'
                },
                {
                    data: 'order_date'
                },
                {
                    data: 'payment_date'
                },
                {
                    data: 'status'
                },
            
                {
                    data: 'order_status'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'orderType'
                },
             
            ],
            "order": [
                [1, 'asc']
            ]
        });
    });

    function update_status(url, order_id, status) {
        if (confirm('Are you sure you want to update this?')) {
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
        } else {
            return false;
        }
    }
</script>
@endsection