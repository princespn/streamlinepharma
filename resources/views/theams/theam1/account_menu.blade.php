<ul>
            
                                        <li><a href="{{route('orderList')}}" title="About Us">Order</a></li>
                                        @if($account->isMembership==1)
                                            <li><a href="{{route('wallet')}}" title="About Us">Wallet</a></li>
                                        @endif
                                        <li><a href="{{route('changePassword')}}" title="Privacy Policy">Change Password</a></li>
            
                                        <li><a href="{{route('address')}}" title="Shipping Policy">Update Address</a></li>                      
                                        <li><a href="{{url('my_schemes')}}" title="My Schemes">My Schemes</a></li>  
                                        <li><a href="{{url('my_coupon')}}" title="My Schemes">My Coupon</a></li>                     
            
                                    </ul>