@extends('layouts.app')

@section('content')
<!--**********|| Value Proposition Section ||**********-->
<section class="w-100 clearfix AboutUs ValueProposition" id="razorpay">
  <div id="app">
      <main class="py-4">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 offset-3 col-md-offset-6">

                      @if($message = Session::get('error'))
                          <div class="alert alert-danger alert-dismissible fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                              <strong>Error!</strong> {{ $message }}
                          </div>
                      @endif

                      @if($message = Session::get('success'))
                          <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                              <strong>Success!</strong> {{ $message }}
                          </div>
                      @endif

                      <div class="card card-default">
                          <div class="card-header">
                              Laravel - Razorpay Payment Gateway Integration
                          </div>

                          <div class="card-body text-center">
                              <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                  @csrf
                                  <script src="https://checkout.razorpay.com/v1/checkout.js"
                                          data-key="{{ env('RAZORPAY_KEY') }}"
                                          data-amount="1000"
                                          data-buttontext="Pay 10 INR"
                                          data-name="ItSolutionStuff.com"
                                          data-description="Rozerpay"
                                          data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                          data-prefill.name="name"
                                          data-prefill.email="email"
                                          data-theme.color="#ff7529">
                                  </script>
                              </form>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </main>
  </div>
</section>
<!--**********|| Value Proposition Section ||**********-->
@endsection
