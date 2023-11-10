@extends('restaurant.layouts.app')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->

    
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-block caption-breadcrumb">
            <div class="breadcrumb-header">
              <h5>Change Password</h5>
            </div>
          </div>
          <form id="update_password" role="form" action="" method="post" onsubmit="update_password(this);return false;">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputName1">Old Password<sup class="text-danger">*</sup></label>
                    <input type="password" class="form-control" name="old_password" value="" placeholder="Old Password">

                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">New Password<sup class="text-danger">*</sup></label>
                    <input type="password" class="form-control" name="new_password" value="" placeholder="New Password">

                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Confirm Password<sup class="text-danger">*</sup></label>
                    <input type="password" class="form-control" name="confirm_password" value="" placeholder="Confirm Password">

                  </div>

                  <!-- /.card-body -->



                </div>


              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
            </div>
          </form>
        </div>

      </div>


    </div>
    <!-- /.row -->
    <!-- Main row -->

    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->



<script>
 
  function update_password(e) {
    $('#update_password .st_loader').show();
    $.ajax({
      url: "{{ route('restaurant.settings.update_password') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      dataType: "json",
      data: $("#update_password").serialize(),
      success: function(data) {
        $('#update_password .st_loader').hide();
        if (data.success == 1) {
          toastr.success(data.message, 'Success');
        } else if (data.success == 0) {
          toastr.error(data.message, 'Error');
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
        $('#update_password .st_loader').hide();
      }
    });
  }
</script>
@endsection