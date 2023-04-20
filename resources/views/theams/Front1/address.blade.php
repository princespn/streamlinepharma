@extends('theams/Front1/app') 
@section('title','Profile') 
@section('MainSection')
<!--End header-->
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> My Account
         </div>
      </div>
   </div>
   <div class="page-content pt-150 pb-150">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 m-auto">
               <div class="row">
                  <div class="col-md-3">
                     <div class="dashboard-menu">
                        <ul class="nav flex-column" role="tablist">
                           <li class="nav-item">
                              <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>My coupons</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="my-schemes-tab" data-bs-toggle="tab" href="#my-schemes" role="tab" aria-controls="my-schemes" aria-selected="true"><i class="fi-rs-marker mr-10"></i>my schemes</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" href="page-login.html"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="tab-content account dashboard-content pl-50">
                        <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                           <div class="card">
                              <div class="card-header">
                                 <h3 class="mb-0">Hello Rosie!</h3>
                              </div>
                              <div class="card-body">
                                 <p>
                                    From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                    manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                           <div class="card">
                              <div class="card-header">
                                 <h3 class="mb-0">Your Orders {{count($data)}}</h3>
                              </div>
                              <div class="card-body">
                                 <div class="table-responsive">
                                    @foreach($data as $order)
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th>
                                                <span style="display:block">{{$order->name}}</span>
                                                <span style="display:block">{{$order->phone}}</span>
                                                <span style="display:block">{{$order->email}}</span>
                                                <span style="display:block">{{$order->landmark}},{{$order->address}},{{$order->zipCode}}</span>
                                                <span style="display:block">{{$order->variation4}}</span> 
                                             </th>
                                             <th>
                                                <span style="display:block">
                                                {{$order->order_id}}
                                                </span>
                                                <span style="display:block">{{$order->transactionId}}</span>
                                                <span style="display:block">{{ date('d-m-Y h:m a', strtotime($order->created_at))  }}</span>
                                             </th>
                                          </tr>
                                       </thead>
                                       <hr/>
                                       <tbody>
                                          @foreach($order->products as $product)
                                          <tr>
                                             <td class='product-col'>
                                                <figure class="product-image-container">
                                                   <img src="{{ $product->thumbnail }}" style="height: 100px;">
                                                </figure>
                                                <div>
                                                   <h5 class="product-title">
                                                      {{ $product->title }}
                                                   </h5>
                                                   <span class="product-qty"></span>
                                                   <span class="product-qty"></span>
                                                   <span class="product-qty"></span>
                                                   <span class="product-qty"></span>
                                                   <span class="product-qty"></span>
                                                   <span class="product-qty"></span>
                                                </div>
                                             </td>
                                             <td class='price-col'>
                                                <span class="product-title">Price : Rs. {{ $product->selling_price }}</span><br/>
                                                <span class="product-qty">Qty : {{ $product->qty }}</span><br/>
                                                <span class="product-qty">Sub Total : Rs. {{ $product->selling_price }}</span><br/>
                                                <span class="product-qty">Tax (0 %) : Rs. {{ $product->product_tax }}</span><br/>
                                                <span class="product-qty">Shipping : Rs. {{ $product->shipping_charges }}</span>
                                             </td>
                                          </tr>
                                          @endforeach                                 
                                       </tbody>
                                       <tfoot>
                                          <tr>
                                             <th colspan='2' class='text-center alert alert-success'>Order Status : {{ $constant_order_status[$order->status] }}</th>
                                          </tr>
                                          @if($order->status < 2)
                                          <tr>
                                             <th colspan='2' class='text-center alert alert-danger'>
                                                <a href="{{ url('UserOrderCancel/'.$order->order_id) }}" class='btn btn-danger'>Cancel Order</a>
                                             </th>
                                          </tr>
                                          @endif
                                       </tfoot>
                                    </table>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                           <div class="card">
                              <div class="card-header">
                                 @if(Session::get('register')&&$membership)
                                 <h3 class="mb-0">{{ $membership->name }} - <small>Billed - {{ $membership->charge_recurring }}</small></h3>
                                 @endif
                              </div>
                              <div class="card-body contact-from-area">
                                 <h3 style="margin-left: 15px;"></h3>
                                 <table class='table table-bordered table-striped'>
                                    <thead>
                                       <tr>
                                          <th style='text-align: center;background-color: #f2f2f2;' colspan='8'>Coupon History</th>
                                       </tr>
                                       <tr>
                                          <th>Scheme Name</th>
                                          <th>Template</th>
                                          <th>Coupon</th>
                                          <th>Used by</th>
                                          <th>Used Time</th>
                                          <th>Product Name</th>
                                          <th>Price</th>
                                          <th>Refferal Benifit / Refree Benifit</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($dataCoupon as $k=>$valueCoupon) 
                                       <tr>
                                          @if($k==0)
                                          <td rowspan="{{count($dataCoupon)+1}}">{{$valueCoupon->scheme_name}}
                                             <small>Valid on : {{$valueCoupon->validity_date}}</small>
                                          </td>
                                          @endif
                                          <td>{{$otherdata->template($valueCoupon->template)}}</td>
                                          <td>{{$valueCoupon->coupon}}</td>
                                          @if($valueCoupon->uesttime != null)
                                          <td>{{$valueCoupon->username}}</td>
                                          <td>{{$valueCoupon->uesttime}}</td>
                                          <td>{{$valueCoupon->title}}</td>
                                          <td>{{($valueCoupon->selling_price-$valueCoupon->refferal_benifit)}}</td>
                                          <td>{{$valueCoupon->refferal_benifit}} / {{$valueCoupon->refree_benifit}}</td>
                                          @else
                                          <td colspan="5">Unused</td>
                                          @endif
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                           <div class="row">
                              @if(isset($allAddresses) && $allAddresses->count()>0)
                              @foreach ($allAddresses as $add)
                              <div class="col-lg-6">
                                 <div class="card mb-3 mb-lg-0">
                                    <div class="card-header">
                                       <h3 class="mb-0"> Address</h3>
                                    </div>
                                    <div class="card-body">
                                       <address>
                                          {{$add->name}} ,<br />{{$add->phone}} ,<br />{{$add->landmark}} ,<br />{{$add->address}},<br /> {{$add->zipCode}}<br/>
                                       </address>
                                       <p>New York</p>
                                       <a href="?address={{$add->id}}" class="btn-small">Edit</a>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                              @endif
                           </div>
                        </div>
                        <div class="tab-pane fade" id="my-schemes" role="tabpanel" aria-labelledby=" my-schemes-tab">
                           <div class="row">
                              <div class="card-header">
                                 <h3 class="mb-0">My Scheme Name - <small></small></h3>
                              </div>
                              <div class="card-body contact-from-area">
                                 <h3 style="margin-left: 15px;"></h3>
                                 <table class='table table-bordered table-striped'>
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                          <th>Scheme Name</th>
                                          <th>Validity</th>
                                          <th>Cashback</th>
                                          <th>Share</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($scheme))
                                       @foreach($scheme as $key=>$row)
                                       @php $url = url('detail/'.$row->offering_product.'?scheme='.urlencode(base64_encode($row->id))).'&r=urlencode(base64_decode($register_id))'; @endphp
                                       <tr>
                                          <td>{{ ($key+1) }}</td>
                                          <td>{{ $row->scheme_name }}</td>
                                          <td>{{ $row->scheme_validity }}</td>
                                          <td>{{ $row->referral_wallet_benefits }}</td>
                                          <td>
                                             <a  href="https://wa.me/?text={{ $row->description.' '.$url }}" data-action="share/whatsapp/share"  class="link-whatsapp"  target='_blank'><i class="fa fa-whatsapp"> </i> </a>
                                             <a href="https://www.facebook.com/sharer.php?u={{ $url }}"   class="link-facebook" target='_blank'><i class="fa fa-facebook"> </i> </a> 
                                             <script type="IN/Share" data-url="$url"></script>
                                             <a href="http://twitter.com/share?text={{ urlencode($row->description.' '.$url) }}"   class="link-linkedin" target='_blank'><i class="fa fa-twitter"> </i> </a>
                                             <br>
                                             <span style='color:red;font-family:bold'>Link : </span>{{ $url }}
                                          </td>
                                       </tr>
                                       @endforeach
                                       @else
                                       <tr>
                                          <td colspan='5'>No Scheme Found for your account.</td>
                                       </tr>
                                       @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                           <div class="card">
                              <div class="card-header">
                                 <h5>Account Details</h5>
                              </div>
                              <div class="card-body">
                                 <p>Already have an account? <a href="page-login.html">Log in instead!</a></p>
                                 <form method="post" name="enq">
                                    <div class="row">
                                       <div class="form-group col-md-6">
                                          <label>First Name <span class="required">*</span></label>
                                          <input required="" class="form-control" name="name" type="text" />
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label>Last Name <span class="required">*</span></label>
                                          <input required="" class="form-control" name="phone" />
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label>Display Name <span class="required">*</span></label>
                                          <input required="" class="form-control" name="dname" type="text" />
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label>Email Address <span class="required">*</span></label>
                                          <input required="" class="form-control" name="email" type="email" />
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label>Current Password <span class="required">*</span></label>
                                          <input required="" class="form-control" name="password" type="password" />
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label>New Password <span class="required">*</span></label>
                                          <input required="" class="form-control" name="npassword" type="password" />
                                       </div>
                                       <div class="form-group col-md-12">
                                          <label>Confirm Password <span class="required">*</span></label>
                                          <input required="" class="form-control" name="cpassword" type="password" />
                                       </div>
                                       <div class="col-md-12">
                                          <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                                       </div>
                                    </div>
                                 </form>
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
</main>
@endsection