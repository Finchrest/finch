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
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Sub Total</th>
                                    <th>Tax</th>
                                    <th>Total Price</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Created </th>
                                    <th>Action</th>
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
                    data: 'name'
                },
                {
                    data: 'location'
                },
                {
                    data: 'sub_total'
                },
                {
                    data: 'tax'
                },
                {
                    data: 'price'
                },
                {
                    data: 'volume'
                },
                {
                    data: 'status'
                },
                {
                    data: 'type'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'action'
                },
            ],
            "order": [
                [1, 'asc']
            ]
        });
    });
</script>
@endsection