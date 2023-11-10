@extends('admin.layouts.app')

@section('content')
<!-- Page-body start -->
<div class="page-body">
    <div class="row">
        <!-- order-card start -->
        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Banners</h6>
                    <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Banner::all()->count() }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Users</h6>
                    <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>{{ App\Models\User::all()->count() }}</span></h2>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Hops</h6>
                    <h2 class="text-right"><i class="ti-tag f-left"></i><span>{{ App\Models\User::all()->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Malts</h6>
                    <h2 class="text-right"><i class="ti-reload f-left"></i><span>{{ App\Models\Malt::all()->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Offers</h6>
                    <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Offer::all()->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Places</h6>
                    <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Place::all()->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Categores</h6>
                    <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Category::all()->count() }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Products</h6>
                    <h2 class="text-right"><i class="ti-wallet f-left"></i><span>{{ App\Models\Product::all()->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <h6 class="m-b-20">Search User</h6>
            <div class="d-flex">
                <input type="text" class="form-control search_user allowno" name="search_user" palceholder="Search User">
                <a href="#!" class="btn btn-info" onclick="formSubmit()"><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>

        </div>


    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- Zero config.table start -->
            <div class="card">
                <h2 class="p-3">Today Orders</h2>
                <div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="dataTable1" class="table table-striped table-bordered nowrap table-sm">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
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
                                    <th>Order Status </th>
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
    });
    $(document).ready(function() {
        // user management
        window.dataTable = $('#dataTable1').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            //'searching': false,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': "{{ route('admin.list') }}",
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
                    data: 'order_for'
                },
                {
                    data: 'order_status'
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

    function formSubmit(e) {
        var search = $('.search_user').val();

        $(e).find('.st_loader').show();
        $.ajax({
            // url: $(e).attr('action'),
            url: "{{ route('admin.search') }}",
            data: {
                search_user: search,
            },
            success: function(data) {

                if (data.success == 1) {
                    $('#modal-default').modal('show');
                    $('#modal-default .modal-content').html(data.view);

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