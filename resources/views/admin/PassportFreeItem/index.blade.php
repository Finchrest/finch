@extends('admin.layouts.app')

@section('content')
<!-- Page-body start -->


<div class="page-header card">
    <div class="card-block caption-breadcrumb">
        <div class="breadcrumb-header">
            <h5>{{ $module }}s</h5>
        </div>
        <div class="page-header-breadcrumb">
            <a href="#!" class="btn btn-info" onclick="add('{{ $route->add }}','{{ $passport_id }}',)"><i class="fa fa-plus"></i>Add {{ $module }}</a>
        </div>
    </div>
</div>
<div class="page-header card">
    <div class="card-block caption-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Passport Name :- {{$passportData->name}} <br> Passport Price :- {{$passportData->sub_total}}</h5>
        </div>
        <div class="page-header-breadcrumb">
            <a href="{{ route('admin.passports') }}" class="btn btn-info">Back to Passport List</a>
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
                                    <th>Passport Name</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
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
                    data.passport_id = '{{ $passport_id }}';
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
                    data: 'passport_id'
                },
                {
                    data: 'product_id'
                },
                {
                    data: 'status'
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

    function add(url, id) {

        $('#modal-default .modal-content').html('');
        $.ajax({
            url: url,
            method: "GET",
            data: {
                'passport_id': id,
            },
            success: function(res) {
                $('#modal-default .modal-content').html(res);
                $('#modal-default').modal('show');
            }
        });
    }
</script>
@endsection