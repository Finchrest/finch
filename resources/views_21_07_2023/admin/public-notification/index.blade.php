@extends('admin.layouts.app')
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
              <h5>Public Notification</h5>
            </div>
          </div>
          <form action="{{ $route->store }}" onsubmit="form_submit(this);return false;" method="POST">
            @csrf
            <div class="card-body">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group ">
                    <label>Title<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="title" value="">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group ">
                    <label>Msg<sup class="text-danger">*</sup></label>
                    <textarea class="form-control" name="msg"></textarea>
                  </div>
                </div>

                <div class="col-md-12 paid">
                    <div class="form-group select2">
                       <label class="d-block">Select User Type<sup class="text-danger">*</sup></label>
                       <select class="form-control select_category " name="user_type" onchange="setSelectUser(this); return false;">
                          <option value="">Select</option>
                          
                             <option value="0">All</option>
                             <option value="1">Selected</option>
            
                       </select>
                    </div>
                 </div>


                 <div class="col-md-12 paid" style="display:none" id="selectUser">
                    <div class="form-group">
                       <label class="d-block">Select Users<sup class="text-danger"></sup></label>
                       <select class="form-control selectUser" multiple name="user_ids[]">
                          <option value="">Select</option>
                          <?php foreach ($users as $user) { ?>
                             <option value="{{ $user->id }}">{{ $user->name }}</option>
                          <?php } ?>
                       </select>
                    </div>
                 </div>
                
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Send <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
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
@endsection

@section('page-js-script')
<script>
  $(document).ready(function() {

    $(".selectUser").select2({
         placeholder: "Select Users",
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

            if (data.success == 1) {

               toastr.success(data.message, 'Success');
               $(e).find('.st_loader').hide();
            //    $(e)[0].reset();

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

   function setSelectUser (e) {
      var sel = $(e).val();

      if(sel == 1){

        $('#selectUser').show();

      }else{

        $('#selectUser').hide();


      }
   }

</script>
@endsection