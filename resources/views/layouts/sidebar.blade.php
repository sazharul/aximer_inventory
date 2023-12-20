<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="#" data-bs-original-title="" title="">
                <img class="img-fluid for-white" style="height: 45px;" src="{{ asset('assets/images/logo/logo_medisource.png') }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="#">
                <img class="img-fluid main-logo main-white" src="{{ asset('assets/images/logo/logo_medisource.png') }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset('assets/images/logo/logo_medisource.png') }}"
                     alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="/">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('slider.index')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Slider</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('customer.index')}}">
                            <i class="ri-store-3-line"></i>
                            <span>Customer</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('supplier.index')}}">
                            <i class="ri-store-3-line"></i>
                            <span>Supplier</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('investor.index')}}">
                            <i class="ri-store-3-line"></i>
                            <span>Investor</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('product.index') }}">Prodcts</a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}">Categories</a>
                            </li>
                            {{--                            <li>--}}
                            {{--                                <a href="{{ route('company.index') }}">Company</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Purchase</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('purchase.index') }}">Manage Purchase</a>
                            </li>
                            <li>
                                <a href="{{ route('purchase-invoice.index') }}">Purchase Invoice</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Sale</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('sale.index') }}">Manage Sale</a>
                            </li>
                            <li>
                                <a href="{{ route('sale-invoice.index') }}">Sale Invoice</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Expense</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('expense-category.index') }}">Expense Category</a>
                            </li>
                            <li>
                                <a href="{{ route('expense.index') }}">Expense</a>
                            </li>

                        </ul>
                    </li>


                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Stock</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ route('stock.index') }}">Manage Stock</a>
                            </li>
                            <li>
                                <a href="{{ route('product_stock') }}">Stock Report</a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Report</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('expense_report') }}">Expense Report</a></li>
                            <li><a href="{{ route('stock.index') }}">Customer Outstanding</a></li>
                            <li><a href="{{ route('stock.index') }}">Profit & Lose</a></li>
                            <li><a href="{{ route('stock.index') }}">Supplier Statement</a></li>
                            <li><a href="{{ route('stock.index') }}">Purchase Report</a></li>
                        </ul>
                    </li>


                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('district.index')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>District</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('area.index')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Area</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('flash_sale')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Flash Sale</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Orders</span>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="sidebar-submenu">--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('pending_order_list') }}">Pending Order</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('approved_order_list') }}">Approved Order</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('delivered_order_list') }}">Delivered Order</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('cancel_order_list') }}">Cancel Order</a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('delivery_invoice')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Delivery Invoice</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('sold_product')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Sold product</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="sidebar-link sidebar-title link-nav" href="{{route('privacy-policy.index')}}">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>Privacy Policy</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}

                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">--}}
                    {{--                            <i class="ri-store-3-line"></i>--}}
                    {{--                            <span>User List</span>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="sidebar-submenu">--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('user_list') }}">Pending User</a>--}}
                    {{--                            </li>--}}
                    {{--                            <li>--}}
                    {{--                                <a href="{{ route('approved_user_list') }}">Approved User</a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->
