<ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link @if($order_menu=='dashboard') active @endif" id="dashboard-tab" href="{{ url('dashboard') }}"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link @if($order_menu=='wallet') active @endif" id="orders-tab"  href="{{ url('wallet') }}"><i class="fi-rs-shopping-bag mr-10"></i>Wallet</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @if($order_menu=='orders') active @endif" id="orders-tab"  href="{{ url('orders') }}"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link @if($order_menu=='address') active @endif" id="address-tab"  href="{{ url('my-address') }}"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @if($order_menu=='my-schemes') active @endif" id="my-schemes-tab"  href="{{ url('my-schemes') }}"><i class="fi-rs-marker mr-10"></i>My Scheme</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @if($order_menu=='account') active @endif" id="account-detail-tab" href="{{ url('account-detail') }}"><i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('logout') }}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul>