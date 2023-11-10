@extends('superadmin.layouts.app')
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
              <h5>General Setting</h5>
            </div>
          </div>
          <form id="general_setting" role="form" action="" method="post" onsubmit="update_data(this);return false;">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Site Title<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="settings[site_title]" value="{{ $settings['site_title'] }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Admin Email<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="settings[admin_email]" value="{{ $settings['admin_email'] }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label>Meta Keywords<sup class="text-danger">*</sup></label>
                    <textarea class="form-control" name="settings[meta_keywords]">{{ $settings['meta_keywords'] }}</textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label>Meta Description<sup class="text-danger">*</sup></label>
                    <textarea class="form-control" name="settings[meta_description]">{{ $settings['meta_description'] }}</textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label>Instagram Access Token<sup class="text-danger">*</sup></label>
                    <textarea class="form-control" name="settings[insta_access_token]">{{ $settings['insta_access_token'] }}</textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label>Passport Minimum Amount<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="settings[passport_minimum_amount]" value="{{ $settings['passport_minimum_amount'] }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label>Top Up benefits<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="settings[top_up_benifit]" value="{{ $settings['top_up_benifit'] }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Site Logo<sup class="text-danger">*</sup></label>
                    <input type="file" class="form-controlt logo_upload" name="file" onchange="upload_site_logo('general_setting')" />
                    <input type="hidden" name="settings[site_logo]" id="file_id" value="{{ $settings['site_logo'] }}" />
                    <?php if ($site_image == '') { ?>
                      <img src="{{  asset('administrator/images/nouser0.jpg') }}" id="site_icon" class="img-thumbnail img-load-prev" alt="" width="150px" height="150px" style="background:#000">
                    <?php } else { ?>
                      <img src="{{  asset('front-assets/images/site_logo/'.$site_image->file) }}" id="site_icon" class="img-thumbnail img-load-prev" alt="" width="150px" height="150px" style="background:#000">
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label>Order Bell Sound<sup class="text-danger">*</sup></label>
                    <input type="file" class="form-controlt logo_upload_bell" name="filesound" onchange="upload_bell_sound('general_setting')" />
                    <input type="hidden" name="settings[site_sound]" id="file_bell_id" value="{{ $settings['site_sound'] }}" />
                    <?php if ($site_sound == '') { ?>
                      <audio controls>
                        <source src="{{  asset('admin-assets/music/bell.mp3') }}" type="audio/mpeg">
                      </audio>
                    <?php } else { ?>
                      <div class="soundR">
                        <audio controls>

                          <source src="{{  asset('admin-assets/music/'.$site_sound->file) }}" class="site_bell" type="audio/mpeg">

                        </audio>
                      </div>
                    <?php } ?>
                  </div>
                </div>



              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
            </div>
          </form>
        </div>

      </div>


    </div>
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

  function update_data(e) {
    $('#general_setting .st_loader').show();
    $.ajax({
      url: "{{ route('superadmin.settings.general_setting') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: "POST",
      dataType: "json",
      data: $("#general_setting").serialize(),
      success: function(data) {
        if (data.success == 1) {
          toastr.success(data.message, 'Success');
          $(e).find('.st_loader').hide();
          $('#general_setting').trigger("reset");

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
        $('#general_setting .st_loader').hide();
      }
    });
  }

  function upload_site_logo(id) {

    $.ajax({
      type: "POST",
      url: "{{ route('superadmin.settings.upload_site_logo') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      data: new FormData($("#" + id)[0]),
      success: function(res) {

        $(".logo_upload").val('');
        if (res.status == 0) {
          toastr.error(res.msg, 'Error');
          $(".logo_upload").val('');
        } else {

          $('#site_icon').attr('src', res.file_path);
          $('#file_id').val(res.file_id);

        }

      }
    });
  }

  function upload_bell_sound(id) {

    $.ajax({
      type: "POST",
      url: "{{ route('superadmin.settings.upload_bell_sound') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      data: new FormData($("#" + id)[0]),
      success: function(res) {

        $(".logo_upload_bell").val('');
        if (res.status == 0) {
          toastr.error(res.msg, 'Error');
          $(".logo_upload_bell").val('');
        } else {

          $('.soundR').html('<audio controls><source src="' + res.file_path + '"  class="site_bell"  type="audio/mpeg"></audio>');
          $('#file_bell_id').val(res.file_id);

        }

      }
    });
  }

  function update_password(e) {
    $('#update_password .st_loader').show();
    $.ajax({
      url: "{{ route('superadmin.settings.update_password') }}",
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