@extends('layouts.app')

@section('content')
  <!--**********|| Header ||**********-->
  <section class="clearfix AllPages">
      <div class="container p-5">
        <ul class="text-white">
          <li class="p-2">
            <a href="index.html" target="_blank">Home Page (1)</a>
          </li>
          <li class="p-2">
            <a href="orders.html" target="_blank">Order Page (2,3,6)</a>
          </li>
          <li class="p-2">
            <a href="information.html" target="_blank">Information List (4)</a>
          </li>
          <li class="p-2">
            <a href="information_details.html" target="_blank">Information Details (5)</a>
          </li>
          <li class="p-2">
            <a href="product.html" target="_blank">product (7 , 8)</a>
          </li>
          <li class="p-2">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalOne">Modal 1</a>
          </li>
          <li class="p-2">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalTwo">Modal 2</a>
          </li>
          <li class="p-2">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalThree">Modal 3</a>
          </li>
        </ul>
      </div>



      <!--**********|| Modal One ||**********-->
      <div class="AllModalHere w-100 clearifx">
        <!--*****|| Modal One ||*****-->
        <div class="modal PassportModal1 OrderShowModal" id="ModalOne">
          <div class="modal-dialog">
            <div class="modal-content bg-blue">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-body p-md-5 p-4">
                <div class="FoodDetailsHere PassportDetailsHere">
                  <div class="HeadingText HeadingText2 text-center">
                    <h3 class="">What is Lorem Ipsum?</h3>
                    <p class="mb-0">Lorem Ipsum is simply.</p>
                  </div>
                  <div class="PassportDetails col-md-10 m-auto" style="background-image: url(images/bottom_pattern.png);">
                    <div class="fbFtrLinks w-100">
                      <ul class="list-unstyled fbFtrLists">
                        <li>
                          <a href="javascript:void(0);">Lorem Ipsum is simply.</a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">Lorem Ipsum is simply.</a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">Lorem Ipsum is simply.</a>
                        </li>
                        <li>
                          <a href="javascript:void(0);">Lorem Ipsum is simply.</a>
                        </li>
                      </ul>
                    </div>
                    <div class="clGetYoursNow w-100 pt-5 text-center">
                      <a href="javascript:void(0);" class="btn m-0 onOrder onOrder2 w-100 p-2">Get Your Passport</a>
                    </div>
                    <div class="PassportAccordian mt-5">
                      <div id="accordion">
                        <div class="card">
                          <div class="card-header px-0" id="headingOne">
                            <h5 class="mb-0">
                              <a href="javascript:void(0);" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Collapsible Group Item #1 <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body px-0">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header px-0" id="headingTwo">
                            <h5 class="mb-0">
                              <a href="javascript:void(0);" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Collapsible Group Item #2 <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body px-0">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header px-0" id="headingThree">
                            <h5 class="mb-0">
                              <a href="javascript:void(0);" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Collapsible Group Item #3 <i class="fa fa-caret-down float-right" aria-hidden="true"></i>
                              </a>
                            </h5>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body px-0">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--*****|| Modal One ||*****-->

        <!--*****|| Modal Two ||*****-->
        <div class="modal PassportModal1 OrderShowModal" id="ModalTwo">
          <div class="modal-dialog">
            <div class="modal-content bg-blue">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-body p-md-5 p-4">
                <div class="FoodDetailsHere PassportDetailsHere CnsumerDetails">
                  <div class="PassportDetails2 col-md-10 m-auto">
                    <div class="CansumerForm w-100">
                     <form>
                       <div class="form-group mb-4">
                         <label>Consumer Name</label>
                         <input type="text" class="form-control" name="consumer_name" placeholder="Press to add Your Name">
                       </div>
                       <div class="form-group mb-4">
                         <label>Phone Number</label>
                         <input type="text" class="form-control" name="consumer_name" placeholder="Press to add Your Name">
                       </div>
                       <div class="form-group mb-4">
                         <label>Email ID</label>
                         <input type="email" class="form-control" name="consumer_name" placeholder="Press to add Your Name">
                       </div>
                       <div class="clGetYoursNow w-100">
                      <button tpe="submit" class="btn m-0 onOrder onOrder2 w-100 p-3">Pay 8000</button>
                    </div>
                     </form>
                    </div>
                    <div class="PassportAccordian mt-5">
                        <div class="card">
                          <div class="card-header px-0" id="headingOne">
                            <h5 class="mb-0">
                              <a href="javascript:void(0);">
                              What You Get
                              </a>
                            </h5>
                          </div>
                          <div>
                            <div class="card-body px-0">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--*****|| Modal Two ||*****-->

        <!--*****|| Modal Three ||*****-->
        <div class="modal PassportModal1 OrderShowModal" id="ModalThree">
          <div class="modal-dialog">
            <div class="modal-content bg-blue">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="modal-body p-md-5 p-4">
                <div class="FoodDetailsHere PassportDetailsHere UserDetails">
                  <div class="PassportDetails3 col-md-10 m-auto p-0">
                    <h4 class="text-center">Hi User Name</h4>
                    <div class="CansumerFormTable w-100 text-white">
                      <table class="table TableOne">
                        <tr>
                          <td>123-123-1234</td>
                          <td class="text-right">Lorem ipsum..</td>
                        </tr>
                        <tr>
                          <td>Loremipsum@yopmail.com</td>
                          <td class="text-right"><b><i class="fa fa-inr" aria-hidden="true"></i> 1234.00</b></td>
                        </tr>
                      </table>

                      <div class="TableBorderBox mt-5">
                     <form>
                      <table class="table table-border TableTwo m-0">
                       <tr>
                         <th>Add Date:</th>
                         <th><a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i> <span>Press To Sign</span></a></th>
                       </tr>
                       <tr>
                         <th>Lorem ipsum:</th>
                         <th><i class="fa fa-inr" aria-hidden="true"></i> 1234.00</th>
                       </tr>
                       <tr>
                         <th>Lorem ipsum:</th>
                         <th><i class="fa fa-inr" aria-hidden="true"></i> 1234.00</th>
                       </tr>
                       <tr>
                         <th>Sign of Customer</th>
                         <th><a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i> <span>Press To Sign</span></a></th>
                       </tr>
                       <tr>
                         <th>Sign of Customer</th>
                         <th><a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i> <span>Press To Sign</span></a></th>
                       </tr>
                    </table>
                     </form>
                     </div>


                     <div class="YOurHistory pt-5">
                     <h6>Your History</h6>
                     <table class="table table-border TableThree">
                       <tr>
                         <td>21/09/2021</td>
                         <td>1234</td>
                         <td>1234</td>
                         <td><a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                         <td><a href="javascript:void(0);"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                       </tr>
                     </table>
                     </div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--*****|| Modal Three ||*****-->


      </div>
      <!--**********|| Modal One ||**********-->
    </section>
@endsection
