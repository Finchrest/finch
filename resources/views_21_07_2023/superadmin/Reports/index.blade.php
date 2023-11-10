@extends('superadmin.layouts.app')
@section('content')
<!-- Page-body start -->
<div class="page-header card">
  <div class="card-block caption-breadcrumb">
    <div class="breadcrumb-header">
      <h5>All Restaurant Report</h5>
    </div>
    <!-- <div class="page-header-breadcrumb">
      <a href="#!" class="btn btn-info" onclick="add('')"><i class="fa fa-plus"></i>Add </a>
      </div> -->
  </div>
</div>
<!-- Page-header end -->
<!-- Page-body start -->
<div class="page-body allReportPage">
  <div class="row">
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card-col">
      <a class="card-link report-view-btn ajax_load_url" href="{{ route('superadmin.reports.totalSalesReports') }}">
        <div class="card">
          <div class="card-body">
            <div class="d-flex rowFlex">
              <div class="cardIcon">
                <span class="card-icon-avg">
                  <img src="{{  asset('admin-assets/images/reports/icon1.png') }}" class="img-fluid">
                </span>
              </div>
              <div class="cardCotent">
                <h5 class="card-item-title m-0"><b>Total Sales</b></h5>
                <p class="card-item-des">Consolidated sales of all your restaurants.</p>
                <div class="mt-auto">
                  <div class="btn card-item-btn report-view-btn btn btn-info btn-sm">View</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card-col">
      <a class="card-link report-view-btn ajax_load_url" href="{{ route('superadmin.reports.totalOrderReports') }}">
        <div class="card">
          <div class="card-body">
            <div class="d-flex rowFlex">
              <div class="cardIcon">
                <span class="card-icon-avg">
                  <img src="{{  asset('admin-assets/images/reports/icon1.png') }}" class="img-fluid">
                </span>
              </div>
              <div class="cardCotent">
                <h5 class="card-item-title m-0"><b>Total Orders</b></h5>
                <p class="card-item-des">Consolidated sales of all your restaurants.</p>
                <div class="mt-auto">
                  <div class="btn card-item-btn report-view-btn btn btn-info btn-sm">View</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card-col">
      <a class="card-link report-view-btn ajax_load_url" href="{{ route('superadmin.reports.topProductsReports') }}">
        <div class="card">
          <div class="card-body">
            <div class="d-flex rowFlex">
              <div class="cardIcon">
                <span class="card-icon-avg">
                  <img src="{{  asset('admin-assets/images/reports/icon1.png') }}" class="img-fluid">
                </span>
              </div>
              <div class="cardCotent">
                <h5 class="card-item-title m-0"><b>Top products</b></h5>
                <p class="card-item-des">Consolidated sales of all your restaurants.</p>
                <div class="mt-auto">
                  <div class="btn card-item-btn report-view-btn btn btn-info btn-sm">View</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card-col">
      <a class="card-link report-view-btn ajax_load_url" href="{{ route('superadmin.reports.totalAvrageOrderReports') }}">
        <div class="card">
          <div class="card-body">
            <div class="d-flex rowFlex">
              <div class="cardIcon">
                <span class="card-icon-avg">
                  <img src="{{  asset('admin-assets/images/reports/icon1.png') }}" class="img-fluid">
                </span>
              </div>
              <div class="cardCotent">
                <h5 class="card-item-title m-0"><b>Average Order Value</b></h5>
                <p class="card-item-des">Consolidated sales of all your restaurants.</p>
                <div class="mt-auto">
                  <div class="btn card-item-btn report-view-btn btn btn-info btn-sm">View</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card-col">
      <a class="card-link report-view-btn ajax_load_url" href="{{ route('superadmin.reports.totalRejectedReports') }}">
        <div class="card">
          <div class="card-body">
            <div class="d-flex rowFlex">
              <div class="cardIcon">
                <span class="card-icon-avg">
                  <img src="{{  asset('admin-assets/images/reports/icon1.png') }}" class="img-fluid">
                </span>
              </div>
              <div class="cardCotent">
                <h5 class="card-item-title m-0"><b>Total Rejected orders</b></h5>
                <p class="card-item-des">Consolidated sales of all your restaurants.</p>
                <div class="mt-auto">
                  <div class="btn card-item-btn report-view-btn btn btn-info btn-sm">View</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card-col">
      <a class="card-link report-view-btn ajax_load_url" href="{{ route('superadmin.reports.repeatCustomersReports') }}">
        <div class="card">
          <div class="card-body">
            <div class="d-flex rowFlex">
              <div class="cardIcon">
                <span class="card-icon-avg">
                  <img src="{{  asset('admin-assets/images/reports/icon1.png') }}" class="img-fluid">
                </span>
              </div>
              <div class="cardCotent">
                <h5 class="card-item-title m-0"><b>Loyal/Repeat Customers</b></h5>
                <p class="card-item-des">Consolidated sales of all your restaurants.</p>
                <div class="mt-auto">
                  <div class="btn card-item-btn report-view-btn btn btn-info btn-sm">View</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card-col">
      <a class="card-link report-view-btn ajax_load_url" href="{{ route('superadmin.reports.abandonedOrderReports') }}">
        <div class="card">
          <div class="card-body">
            <div class="d-flex rowFlex">
              <div class="cardIcon">
                <span class="card-icon-avg">
                  <img src="{{  asset('admin-assets/images/reports/icon1.png') }}" class="img-fluid">
                </span>
              </div>
              <div class="cardCotent">
                <h5 class="card-item-title m-0"><b>Abandoned order details</b></h5>
                <p class="card-item-des">Consolidated sales of all your restaurants.</p>
                <div class="mt-auto">
                  <div class="btn card-item-btn report-view-btn btn btn-info btn-sm">View</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
<!-- Page-body end -->
@endsection
@section('page-js-script')
<script></script>
@endsection