@extends('restaurant.layouts.login')

@section('content')
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                       <form class="md-float-material" method="POST" id="loginforms" onsubmit="loginSubmit(this);return false;" action="">
                        @csrf
                            <div class="text-center">
                                <img src="{{ asset('admin-assets/images/logo.png') }}" alt="logo.png">
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Sign In</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Your Email Address" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password"  autocomplete="current-password">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="#" class="text-right f-w-600 text-inverse"> Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in <i class="st_loader fa-btn-loader fa fa-refresh fa-spin fa-1x fa-fw" style="display:none;"></i></button>
                                    </div>
                                </div>
                               

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
@endsection
@section('page-js-script')
<script>

    function loginSubmit(e){

        $(e).find('button').attr('disabled',true);
        $(e).find('.st_loader').show();
        $.ajax({  
          url :"{{ route('restaurant.login') }}",  
          method:"POST",  
          dataType:"json", 
          data:$(e).serialize(),
          success: function(res){ 
            $(e).find('.st_loader').hide();
            $(e).find('button').attr('disabled',false);
            
            if(res.status == 0){
                var err = JSON.parse(res.msg);
                var er = '';
                $.each(err, function(k, v) { 
                    er += v+'<br>'; 
                }); 
                toastr.error(er,'Error');
                $('#loginforms .st_loader').hide();
            } else if(res.status == 1) {
                $(e)[0].reset();
                toastr.success('Login Success','Success');
                var surl = "{{ url('restaurant') }}";
                window.setTimeout(function() { window.location = surl; }, 500);
            }
          },
          error: function(data){ 
            if(typeof data.responseJSON.status !== 'undefined'){
              toastr.error(data.responseJSON.error,'Error');
            }else{
              $.each(data.responseJSON.errors, function( key, value ) {
                  toastr.error(value,'Error');
              });
            }
            $(e).find('.st_loader').hide();
            $(e).find('button').attr('disabled',false);
          } 
           
        }); 
    }
</script>
@endsection
