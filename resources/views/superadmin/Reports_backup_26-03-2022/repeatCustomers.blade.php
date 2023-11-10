@extends('admin.layouts.app')
@section('content')
<!-- Page-body start -->
<div class="page-header card">
  <div class="card-block caption-breadcrumb">
    <div class="breadcrumb-header">
      <h5>Total Repeat Customers</h5>
    </div>
  </div>
</div>
<!-- Page-header end -->
<!-- Page-body start -->
<div class="page-header card">
  <div class="card-block">
  <form>
  <div class="customFilters">
    <div class="orderDate w25">
      <div class="form-group m-0">
        <label for="selectDate">Order Date</label>
        <input type="text" class="form-control" name="customDate" id="selectDate" value="" placeholder="Select Range">
      </div>
    </div>
    <div class="orderStatus w25">
      <div class="form-group m-0">
        <label for="selectStatus">Order Status</label>
        <select class="form-control select_2" name="orderStatus" id="selectStatus">
          <option value="1">All</option>
          <option value="2">Cancelled</option>
          <option value="3">Complimentary</option>
          <option value="4">Success</option>
        </select>
      </div>
    </div>
    <div class="orderRestaurants w25">
      <div class="form-group m-0">
        <label for="selectRestaurants">Restaurants</label>
        <select class="form-control select_2" name="orderRestaurants" id="selectRestaurants">
          <option value="1">All</option>
          <option value="2">Cancelled</option>
          <option value="3">Complimentary</option>
          <option value="4">Success</option>
        </select>
      </div>
    </div>
    <div class="orderSubmit w25 text-center">
      <button type="submit" class="btn btn-info w-100">Search</button>
    </div>
  </div>
  </form>
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
                  <th>Restaurant</th>
                  <th>Customer</th>
                  <th>Shipping Address</th>
                  <th>Quantity</th>
                  <th>Amount </th>
                  <th>Order Date </th>
                  <th>Payment date </th>
                  <th>Status </th>
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
  $(document).ready(function(){
    // $(".select_2").select2();
    $(".select_2").select2({
    placeholder: "Selcet",
  });
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
             'url': "{{ route('admin.reports.repeatCustomerList') }}",
             'type':'post',
             'data': function(data){
                   
             }
          },
          'lengthMenu': [10, 20, 50, 100, 200, 500],
          'columns': [
             {
                 data: 'sno',
                 render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
                }
              }, 
             { data: 'order_id' }, 
             { data: 'restaurant' }, 
             { data: 'user' }, 
             { data: 'shipping_address' }, 
             { data: 'qty' }, 
             { data: 'total' }, 
             { data: 'order_date' }, 
             { data: 'payment_date' }, 
             {data :'status'},
             { data: 'created_at' },
           ],
          "order": [[1, 'asc' ]]
        });
  });
  
  function update_status(url, order_id, status) {
   if(confirm('Are you sure you want to update this?')) {
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
  

  $(function() {
    var start = moment();
    var end = moment();
    function cb(start, end) {
        $('#selectDate').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#selectDate').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
    cb(start, end);
});
  
</script>
@endsection